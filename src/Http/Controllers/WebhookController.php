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
        $payload = $request->get('payload');

        $excludedValues = Config::get('peachpayment.webhook_excluded');

        foreach ($excludedValues as $exclude) {
            unset($payload[$exclude]);
        }

        $event->type = $request->get('type');
        $event->action = $request->get('action');
        $event->payload = $payload;
        $event->save();

        return response([], Response::HTTP_OK);
    }
}
