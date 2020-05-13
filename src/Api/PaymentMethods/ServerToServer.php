<?php

namespace IoDigital\PeachPayment\Api\PaymentMethods;

use GuzzleHttp\Exception\ClientException;
use IoDigital\PeachPayment\Api\CardBuilder;
use IoDigital\PeachPayment\Api\Factory\PaymentScheme;
use IoDigital\PeachPayment\Api\Response;
use IoDigital\PeachPayment\Api\Setting;
use IoDigital\PeachPayment\Helpers\Currency;
use IoDigital\PeachPayment\Models\PaymentCard;

class ServerToServer extends PaymentScheme
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
     * Do a standalone card registration.
     *
     * @param CardBuilder $card
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function registerCard(CardBuilder $card)
    {
        if (!$card->isValid()) {
            return new \Exception('Payment card details incomplete');
        }

        return $this->client->request('POST', 'registrations', [
            'form_params' => [
                'entityId'         => $this->settings->getEntityIdOnceOff(),
                'paymentBrand'     => strtoupper($card->getPaymentBrand()),
                'card.number'      => $card->getCardNumber(),
                'card.holder'      => $card->getCardHolder(),
                'card.expiryMonth' => $card->getExpiryMonth(),
                'card.expiryYear'  => $card->getExpiryYear(),
                'card.cvv'         => $card->getCvv(),
            ],
        ])->getBody()->getContents();
    }

    /**
     * Registers a new payment card during a payment.
     *
     * @param CardBuilder $card
     * @param int         $amount
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function registerCardDuringPayment(CardBuilder $card, int $amount)
    {
        if (!$card->isValid()) {
            return new \Exception('Payment card details incomplete');
        }

        return $this->client->request('POST', 'payments', [
            'form_params' => [
                'entityId'                => $this->settings->getEntityIdOnceRecurring(),
                'amount'                  => Currency::paymentFriendlyNumber($amount),
                'currency'                => 'ZAR',
                'paymentType'             => self::DEBIT,
                'paymentBrand'            => strtoupper($card->getPaymentBrand()),
                'card.number'             => $card->getCardNumber(),
                'card.holder'             => $card->getCardHolder(),
                'card.expiryMonth'        => $card->getExpiryMonth(),
                'card.expiryYear'         => $card->getExpiryYear(),
                'card.cvv'                => $card->getCvv(),
                //'recurringType'           => 'INITIAL',
                'createRegistration'      => true,
            ],
        ])->getBody()->getContents();
    }

    /**
     * Performs a repeated payment with the stored card.
     *
     * $type defaults to REPEATED_PAYMENT but on first
     * use should use INITIAL_PAYMENT.
     *
     * @param PaymentCard $card
     * @param             $owner
     * @param int         $amount
     * @param string      $type
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function repeatedPayment(PaymentCard $card, $owner, int $amount, string $type = PaymentScheme::REPEATED_PAYMENT)
    {
        try {
            $response = $this->client->request(
                'POST',
                "registrations/{$card->registration_id}/payments",
                [
                    'form_params' => [
                        'entityId'                => $this->settings->getEntityIdOnceRecurring(),
                        'amount'                  => Currency::paymentFriendlyNumber($amount),
                        'currency'                => 'ZAR',
                        'paymentType'             => self::DEBIT,
                        'recurringType'           => $type,
                        'merchantTransactionId'   => class_basename($owner) . '-' . $owner->id,
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
     *
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
                        'recurringType'           => 'REPEATED',
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
     * @param string $paymentId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function paymentStatus(string $paymentId)
    {
        try {
            return $this->client->request('GET', "payments/$paymentId", [
                'form_params' => [
                    'entityId' => $this->settings->getEntityIdOnceRecurring(),
                ],
            ])->getBody()->getContents();
        } catch (ClientException $e) {
            $this->logErrors('paymentStatus', $e);

            return response()->json([
                'error' => 'There was a problem performing this request.',
            ]);
        }
    }

    /**
     * Delete the stored payment card.
     *
     * @param string $registrationId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function deleteCard(string $registrationId)
    {
        try {
            return $this->client->request(
                'DELETE',
                "registrations/$registrationId?entityId=".$this->settings->getEntityIdOnceOff(),
                [
                    'form_params' => [
                        'entityId' => config('peachpayments.once_off_entity_id'),
                    ],
                ]
            )->getBody()->getContents();
        } catch (ClientException $e) {
            $this->logErrors('deleteCard', $e);

            return response()->json([
                'error' => 'There was a problem performing this request.',
            ]);
        }
    }
}
