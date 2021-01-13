<?php

namespace IoDigital\PeachPayment\Api\PaymentMethods;

use GuzzleHttp\Exception\ClientException;
use IoDigital\PeachPayment\Api\Factory\PaymentScheme;
use IoDigital\PeachPayment\Api\Response;
use IoDigital\PeachPayment\Api\Setting;
use IoDigital\PeachPayment\Helpers\Currency;
use IoDigital\PeachPayment\Models\PaymentCard;

class CopyAndPay extends PaymentScheme
{
    public function __construct(Setting $settings = null)
    {
        if ($settings !== null) {
            parent::__construct($settings);
        } else {
            parent::__construct(new Setting());
        }
    }

    /**
     * You need to prepare the checkout in order
     * to get an ID required for the form.
     *
     * @param int $amount
     * @return string|bool
     */
    public function prepareCheckout(int $amount)
    {
        $response = $this->client->request('POST', 'checkouts', [
            'form_params' => [
                'entityId'           => $this->settings->getEntityIdOnceOff(),
                'amount'             => Currency::paymentFriendlyNumber($amount),
                'currency'           => 'ZAR',
                'paymentType'        => self::DEBIT,
            ],
        ])->getBody()->getContents();

        $result = json_decode($response, true);
        $responseCheck = new Response();

        if ($responseCheck->isSuccessfulResponse($result['result']['code'])) {
            return $result['id'];
        }

        return false;
    }

    /**
     * Do a standalone card registration.
     *
     * Sends request to get the checkoutId
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function registerCard()
    {
        $response = $this->client->request('POST', 'checkouts', [
            'form_params' => [
                'entityId'           => $this->settings->getEntityIdOnceOff(),
                'createRegistration' => 'true',
            ],
        ])->getBody()->getContents();

        $result = json_decode($response, true);
        $responseCheck = new Response();

        if ($responseCheck->isSuccessfulResponse($result['result']['code'])) {
            return $result['id'];
        }

        return false;
    }

    /**
     * The $checkoutId is retrieved from prepareCheckoutForRegistration()
     *
     * This function is used to retrieve the result of the card
     * registration process.
     *
     * Returns the registrationId used for one click payments.
     *
     * @param $checkoutId
     * @return bool|string
     */
    public function getCheckoutRegistrationResult($path, $owner)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->getApiUri(false) . $path)->getBody()->getContents();

        $result = json_decode($response, true);
        $responseCheck = new Response();

        if ($responseCheck->isSuccessfulResponse($result['result']['code'])) {
            PaymentCard::create([
                'result' => $result,
                'owner' => $owner
            ]);

            return $result;
        }

        $this->generalLog($result['result']['code'], $result['result']['description'], 'getCheckoutRegistration');

        return false;
    }

    /**
     * Registers a new payment card during a payment.
     *
     * the response will include a registrationId (token)
     * and useful card information that you can store for
     * future 'one-click payment' requests.
     *
     * @param int  $amount
     * @param bool $preAuth
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function registerCardDuringPayment(int $amount, $preAuth = false)
    {
        $response = $this->client->request('POST', 'checkouts', [
            'form_params' => [
                'entityId'           => $this->settings->getEntityIdOnceOff(),
                'amount'             => Currency::paymentFriendlyNumber($amount),
                'currency'           => 'ZAR',
                'paymentType'        => $preAuth === true ? self::PREAUTHORISATION : self::DEBIT,
                'createRegistration' => true,
            ],
        ])->getBody()->getContents();

        $result = json_decode($response, true);
        $responseCheck = new Response();

        if ($responseCheck->isSuccessfulResponse($result['result']['code'])) {
            return $result['id'];
        }

        return false;
    }

    /**
     * Performs a repeated payment with the stored card.
     *
     * $type defaults to REPEATED_PAYMENT but on first
     * use should use INITIAL_PAYMENT.
     *
     *
     * @param PaymentCard $card
     * @param             $owner
     * @param int         $amount
     * @param string      $customerName
     * @param string      $invoiceId
     * @param string      $type
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function repeatedPayment(PaymentCard $card, $owner, int $amount, string $customerName = null, $invoiceId = null, string $type = PaymentScheme::REPEATED_PAYMENT)
    {
        try {
            return $this->client->request(
                'POST',
                "registrations/{$card->registration_id}/payments",
                [
                    'form_params' => [
                        'entityId'                => $this->settings->getEntityIdOnceRecurring(),
                        'amount'                  => Currency::paymentFriendlyNumber($amount),
                        'currency'                => 'ZAR',
                        'paymentType'             => self::DEBIT,
                        'recurringType'           => $type,
                    ],
                ]
            )->getBody()->getContents();

            $result = json_decode($response, true);
            $card->saveResult($result, $owner);

            $responseCheck = new Response();

            if ($responseCheck->isSuccessfulResponse($result['result']['code'])) {
                return $result['id'];
            }

            return false;
        } catch (ClientException $e) {
            $this->logErrors('repeatedPayment', $e);

            return response()->json([
                'error' => 'There was a problem performing this request.',
            ]);
        }
    }

    /**
     * Perform a one click payment with a stored card.
     *
     * @param PaymentCard $card
     * @param int         $amount
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function oneClickPayment(PaymentCard $card, int $amount)
    {
        try {
            return $this->client->request(
                'POST',
                "registrations/{$card->registration_id}/payments",
                [
                    'form_params' => [
                        'entityId'                => $this->settings->getEntityIdOnceRecurring(),
                        'amount'                  => Currency::paymentFriendlyNumber($amount),
                        'currency'                => 'ZAR',
                        'paymentType'             => self::DEBIT,
                        'registrations[0].id'     => $card->registration_id,
                    ],
                ]
            )->getBody()->getContents();
        } catch (ClientException $e) {
            $this->logErrors('oneClickPayment', $e);

            return response()->json([
                'error' => 'There was a problem performing this request.',
            ]);
        }
    }

    /**
     * Get the status of a payment.
     *
     * @param string $checkoutId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function paymentStatus(string $checkoutId)
    {
        try {
            return $this->client->request(
                'GET',
                "checkouts/$checkoutId/payments",
                [
                'form_params' => [
                    'entityId' => $this->settings->getEntityIdOnceRecurring(),
                ],
            ]
            )->getBody()->getContents();
        } catch (ClientException $e) {
            $this->logErrors('paymentStatus', $e);

            return response()->json([
                'error' => 'There was a problem performing this request.',
            ]);
        }
    }
}
