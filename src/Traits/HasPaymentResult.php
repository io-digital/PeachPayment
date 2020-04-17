<?php

namespace IoDigital\PeachPayment\Traits;

use IoDigital\PeachPayment\Models\PaymentResult;

trait HasPaymentResult
{
    public function results()
    {
        return $this->morphMany(PaymentResult::class, 'owner');
    }
}
