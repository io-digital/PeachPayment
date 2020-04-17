<?php

namespace IoDigital\PeachPayment\Tests\Unit;

use IoDigital\PeachPayment\Api\CardBuilder;
use IoDigital\PeachPayment\Tests\TestCase;

class CardBuilderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * */
    public function it_can_create_a_card_object()
    {
        $card = new CardBuilder();

        $this->assertIsObject($card);
    }

    /**
     * @test
     * */
    public function it_can_return_false_when_not_valid()
    {
        $card = new CardBuilder();

        $this->assertFalse($card->isValid());
    }

    /**
     * @test
     * */
    public function it_can_return_true_when_valid()
    {
        $card = new CardBuilder();

        $card->setPaymentBrand('VISA');
        $card->setCardNumber('4711100000000000');
        $card->setCardHolder('Jane Jones');
        $card->setExpiryMonth('05');
        $card->setExpiryYear('2021');
        $card->setCvv('123');

        $this->assertTrue($card->isValid());
    }

    /**
     * @test
     * */
    public function it_can_return_false_when_incomplete()
    {
        $card = new CardBuilder();

        $card->setPaymentBrand('VISA');
        $card->setCardNumber('4711100000000000');
        $card->setCardHolder('Jane Jones');
        $card->setExpiryYear('2021');
        $card->setCvv('123');

        $this->assertFalse($card->isValid());
    }
}
