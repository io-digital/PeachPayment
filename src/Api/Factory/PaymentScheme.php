<?php

namespace IoDigital\PeachPayment\Api\Factory;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use IoDigital\PeachPayment\Api\CardBuilder;
use IoDigital\PeachPayment\Api\Setting;
use IoDigital\PeachPayment\Models\PaymentCard;

abstract class PaymentScheme
{
    protected $client;
    protected $settings;
    protected const DEBIT = 'DB';
    protected const REFUND = 'RF';
    protected const CAPTURE = 'CP';
    protected const REVERSAL = 'RV';
    protected const PREAUTHORISATION = 'PA';
    public const INITIAL_PAYMENT = 'INITIAL';
    public const REPEATED_PAYMENT = 'REPEATED';

    public function __construct(Setting $settings)
    {

        $this->settings = $settings;
        $this->client = new Client([
            'base_uri' => $this->getApiUri(),
            'verify' => $this->verifySsl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->settings->getAuthorisationHeader(),
            ],
            'http_errors' => false,
        ]);
    }

    //abstract protected function registerCard(CardBuilder $card);

    //abstract protected function registerCardDuringPayment(CardBuilder $card);

    abstract protected function repeatedPayment(PaymentCard $card, object $owner, int $amount, string $customerName, $invoiceId, string $type);

    abstract protected function oneClickPayment(PaymentCard $card, int $amount);

    abstract protected function paymentStatus(string $paymentId);

    /**
     * Get API uri.
     *
     * @param bool $version
     * @return string
     */
    protected function getApiUri(bool $version = true): string
    {
        $uri = $this->settings->getApiUriLive();

        /*
         * testMode=EXTERNAL causes test transactions to be forwarded to the
         * processor's test system for 'end-to-end' testing
         *
         * testMode=INTERNAL causes transactions to be sent to our simulators,
         * which is useful when switching to the live endpoint for connectivity testing.
         * */
        if (Config::get('app.env') !== 'production') {
            $uri = $this->settings->getApiUriTest();
        }

        return $version
            ? $uri . $this->settings->getApiUriVersion()
            : $uri;
    }

    /**
     * This should be true in production environments.
     *
     * @return bool
     */
    protected function verifySsl(): bool
    {
        return Config::get('app.env') === 'production';
    }

    /**
     * Class error logger.
     *
     * @param string $function
     * @param $error
     */
    protected function logErrors(string $function, $error)
    {
        Log::error("PaymentClient - $function");
        Log::error('Message - ' . $error->getMessage());
        Log::error('File - ' . $error->getFile());
        Log::error('Line - ' . $error->getLine());
        Log::error('Request: ' . str($error->getRequest()));
        Log::error('Response: ' . str($error->getResponse()));
    }

    /**
     * A helper logger for general use cases.
     *
     * @param string $code
     * @param string $description
     * @param string $function
     */
    public function generalLog(string $code, string $description, string $function): void
    {
        Log::error('PEACHPAYMENT Origin - ' . $function);
        Log::error('PEACHPAYMENT Result Code - ' . $code);
        Log::error('PEACHPAYMENT Result Description - ' . $description);
    }
}
