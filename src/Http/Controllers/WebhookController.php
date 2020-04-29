<?php

namespace IoDigital\PeachPayment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use IoDigital\PeachPayment\Models\PaymentEvent;

class WebhookController extends Controller
{
    protected $model;

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
