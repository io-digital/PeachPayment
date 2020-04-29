<?php

namespace IoDigital\PeachPayment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use IoDigital\PeachPayment\Events\PaymentNotification;
use IoDigital\PeachPayment\Events\RegistrationNotification;
use IoDigital\PeachPayment\Events\RiskNotification;
use IoDigital\PeachPayment\Models\PaymentEvent;

class WebhookController extends Controller
{
    protected $model;
    private const PAYMENT_NOTIFICATION = 'PAYMENT';
    private const REGISTRATION_NOTIFICATION = 'REGISTRATION';
    private const RISK_NOTIFICATION = 'RISK';

    public function __construct(PaymentEvent $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $event = new PaymentEvent();
        $body = $this->decryptMessage($request);
        $payload = $body['payload'];

        $excludedValues = Config::get('peachpayment.webhook_excluded');

        foreach ($excludedValues as $exclude) {
            unset($payload[$exclude]);
        }

        $event->type = $body['type'];
        $event->action = $body['action'];
        $event->payload = $payload;
        $event->save();

        switch (strtoupper($body['type'])) {
            case self::PAYMENT_NOTIFICATION:
                event(new PaymentNotification($event));
                break;
            case self::REGISTRATION_NOTIFICATION:
                event(new RegistrationNotification($event));
                break;
            case self::RISK_NOTIFICATION:
                event(new RiskNotification($event));
                break;
        }

        return response([], Response::HTTP_OK);
    }

    private function decryptMessage(Request $request)
    {
        $keyFromConfiguration = Config::get('peachpayment.webhook_secret_key');
        $ivFromHeader = $request->header('X-Initialization-Vector');
        $authTagFromHeader = $request->header('X-Authentication-Tag');

        $key = hex2bin($keyFromConfiguration);
        $iv = hex2bin($ivFromHeader);
        $authTag = hex2bin($authTagFromHeader);
        $cipherText = hex2bin($request->getContent());

        $result = openssl_decrypt($cipherText, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $authTag)

        return json_decode($result, true);
    }
}
