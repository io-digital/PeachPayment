<?php

namespace IoDigital\PeachPayment;

use IoDigital\PeachPayment\Api\PaymentMethods\CopyAndPay;
use IoDigital\PeachPayment\Api\PaymentMethods\ServerToServer;
use IoDigital\PeachPayment\Api\Setting;

class PeachPayment
{
    public function initServerToServer(Setting $settings = null)
    {
        return new ServerToServer($settings);
    }

    public function initCopyAndPay(Setting $settings = null)
    {
        return new CopyAndPay($settings);
    }
}
