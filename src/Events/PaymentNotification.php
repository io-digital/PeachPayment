<?php

namespace IoDigital\PeachPayment\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use IoDigital\PeachPayment\Models\PaymentEvent;

class PaymentNotification
{
    use Dispatchable, SerializesModels;

    public $model;

    public function __construct(PaymentEvent $event)
    {
        $this->model = $event;
    }
}
