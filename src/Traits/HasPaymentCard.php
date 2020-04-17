<?php

namespace IoDigital\PeachPayment\Traits;

use IoDigital\PeachPayment\Models\PaymentCard;

trait HasPaymentCard
{
    public function cards()
    {
        return $this->morphMany(PaymentCard::class, 'owner');
    }
}
