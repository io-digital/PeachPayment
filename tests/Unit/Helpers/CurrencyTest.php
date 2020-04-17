<?php

namespace IoDigital\PeachPayment\Tests\Unit\Helpers;

use IoDigital\PeachPayment\Helpers\Currency;
use IoDigital\PeachPayment\Tests\TestCase;

class CurrencyTest extends TestCase
{
    public function test_payment_friendly_number_returns_string()
    {
        $value = Currency::paymentFriendlyNumber(2000);

        $this->assertIsString($value);
    }

    public function test_payment_friendly_number_breaks_on_wrong_input_type()
    {
        $this->expectException(\TypeError::class);
        trigger_error(Currency::paymentFriendlyNumber('lorem'));
    }

    public function test_payment_friendly_number_returns_expected_format()
    {
        $values = [
            '20.00' => Currency::paymentFriendlyNumber(2000),
            '49.99' => Currency::paymentFriendlyNumber(4999),
            '149.99' => Currency::paymentFriendlyNumber(14999),
            '57.68' => Currency::paymentFriendlyNumber(5768),
        ];

        foreach ($values as $key => $value) {
            $this->assertEquals($key, $value);
        }
    }

    public function test_get_friendly_number_returns_string()
    {
        $value = Currency::getFriendly(2000);

        $this->assertIsString($value);
    }

    public function test_get_friendly_number_breaks_on_wrong_input_type()
    {
        $this->expectException(\TypeError::class);
        trigger_error(Currency::getFriendly('lorem'));
    }

    public function test_get_friendly_number_returns_expected_format()
    {
        $values = [
            '20.00' => Currency::getFriendly(2000),
            '49.99' => Currency::getFriendly(4999),
            '149.99' => Currency::getFriendly(14999),
            '57.68' => Currency::getFriendly(5768),
            '2,000.00' => Currency::getFriendly(200000),
            '1,499.57' => Currency::getFriendly(149957),
        ];

        foreach ($values as $key => $value) {
            $this->assertEquals($key, $value);
        }
    }
}
