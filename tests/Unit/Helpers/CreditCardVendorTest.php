<?php

namespace IoDigital\PeachPayment\Tests\Unit\Helpers;

use IoDigital\PeachPayment\Helpers\CreditCardVendor;
use IoDigital\PeachPayment\Tests\TestCase;

class CreditCardVendorTest extends TestCase
{
    /** @test */
    public function it_can_detect_master_cards()
    {
        $cards = [
            '5350920030553774',
            '5135166604058145',
            '5598053524638299',
            '5453551242936527',
            '5257890564592684',
            '5414485676557194',
        ];

        foreach ($cards as $card) {
            $this->assertEquals('MASTER', CreditCardVendor::detect($card));
        }
    }

    /** @test */
    public function it_can_detect_visa_cards()
    {
        $cards = [
            '4402614609457423',
            '4813339659583448',
            '4150111295206473',
            '4023147694347463',
            '4380754179115971',
            '4885878273296179',
        ];

        foreach ($cards as $card) {
            $this->assertEquals('VISA', CreditCardVendor::detect($card));
        }
    }

    /** @test */
    public function it_can_return_false_on_wrong_values()
    {
        $values = [
            'lorem',
            'ipsum',
            'dolor',
        ];

        foreach ($values as $value) {
            $this->assertFalse(CreditCardVendor::detect($value));
        }
    }
}
