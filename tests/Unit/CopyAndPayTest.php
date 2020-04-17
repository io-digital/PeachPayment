<?php

namespace IoDigital\PeachPayment\Tests\Unit;

use IoDigital\PeachPayment\Api\Setting;
use IoDigital\PeachPayment\PeachPayment;
use IoDigital\PeachPayment\Tests\TestCase;
use VCR\VCR;

class CopyAndPayTest extends TestCase
{
    protected $settings;

    public function setUp(): void
    {
        parent::setUp();
        VCR::turnOn();
        $this->settings = new Setting();

        // Apply settings from Peach Payment integration guides
        $this->settings
            ->setEntityIdOnceOff('8a8294174e735d0c014e78cf26461790')
            ->setAuthorisationHeader('OGE4Mjk0MTc0ZTczNWQwYzAxNGU3OGNmMjY2YjE3OTR8cXl5ZkhDTjgzZQ==');
    }

    /**
     * @test
     * @vcr copy_and_pay_can_prepare_checkout.yml
     */
    public function it_can_prepare_the_checkout()
    {
        VCR::insertCassette('copy_and_pay_can_prepare_checkout');

        $paymentClient = new PeachPayment();
        $payment = $paymentClient->initCopyAndPay($this->settings);

        $response = $payment->prepareCheckout(2000);

        $this->assertIsString($response);
        VCR::turnOff();
    }

    /**
     * @test
     * @vcr copy_and_pay_can_prepare_checkout_fails_on_incorrect_auth.yml
     */
    public function it_fails_on_incorrect_authentication()
    {
        VCR::insertCassette('copy_and_pay_can_prepare_checkout_fails_on_incorrect_auth');

        $paymentClient = new PeachPayment();
        $this->settings->setAuthorisationHeader('lorem ipsum');

        $payment = $paymentClient->initCopyAndPay($this->settings);

        $response = $payment->prepareCheckout(2000);

        $this->assertFalse($response);
        VCR::turnOff();
    }

    /**
     * @test
     * @vcr copy_and_pay_can_register_a_card.yml
     */
    public function it_can_register_a_card_for_tokenization()
    {
        VCR::insertCassette('copy_and_pay_can_register_a_card');
        $paymentClient = new PeachPayment();
        $payment = $paymentClient = $paymentClient->initCopyAndPay($this->settings);

        $response = $payment->registerCard();

        $this->assertIsString($response);
        VCR::turnOff();
    }

    /**
     * @test
     */
    /*public function it_can_create_the_payment_form()
    {

    }*/

    /**
     * @test
     */
    /*public function it_can_get_the_payment_status()
    {

    }*/
}
