<?php

namespace IoDigital\PeachPayment\Facades;

use Illuminate\Support\Facades\Facade;

class PeachPayment extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'peachpayment';
    }
}
