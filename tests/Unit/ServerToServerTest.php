<?php

namespace IoDigital\PeachPayment\Tests\Unit;

use IoDigital\PeachPayment\Api\CardBuilder;
use IoDigital\PeachPayment\Api\Response;
use IoDigital\PeachPayment\Api\Setting;
use IoDigital\PeachPayment\PeachPayment;
use IoDigital\PeachPayment\Tests\TestCase;
use VCR\VCR;

class ServerToServerTest extends TestCase
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
     * @vcr server_to_server_can_register_card.yml
     *
     */
    public function it_can_register_a_card()
    {
        VCR::insertCassette('server_to_server_can_register_card');

        $paymentClient = new PeachPayment();
        $client = $paymentClient->initServerToServer($this->settings);

        $card = new CardBuilder();
        $card->setPaymentBrand('VISA');
        $card->setCardNumber('4200000000000000');
        $card->setCardHolder('Jane Jones');
        $card->setExpiryMonth('05');
        $card->setExpiryYear('2021');
        $card->setCvv('123');

        $response = $client->registerCard($card);

        $responseData = json_decode($response, true);
        $responseCheck = new Response();

        $this->assertTrue($responseCheck->isSuccessfulResponse($responseData['result']['code']));

        VCR::turnOff();
    }

    /**
     * @test
     * @vcr server_to_server_can_register_card_during_payment.yml
     *
     * */
    public function it_can_register_a_card_during_payment()
    {
        VCR::insertCassette('server_to_server_can_register_card_during_payment');

        $paymentClient = new PeachPayment();
        $this->settings->setEntityIdOnceRecurring('8a8294174e735d0c014e78cf26461790');
        $client = $paymentClient->initServerToServer($this->settings);

        $card = new CardBuilder();
        $card->setPaymentBrand('VISA');
        $card->setCardNumber('4711100000000000');
        $card->setCardHolder('Jane Jones');
        $card->setExpiryMonth('05');
        $card->setExpiryYear('2021');
        $card->setCvv('123');

        $response = $client->registerCardDuringPayment($card, 2000);

        $responseData = json_decode($response, true);
        $responseCheck = new Response();

        $this->assertTrue($responseCheck->isSuccessfulResponse($responseData['result']['code']));

        VCR::turnOff();
    }

    /**
     * @test
     * @vcr server_to_server_can_do_one_click_payment.yml
     * */
    public function it_can_do_a_one_click_payment()
    {
        VCR::insertCassette('server_to_server_can_do_one_click_payment');

        $paymentClient = new PeachPayment();
        $client = $paymentClient->initServerToServer($this->settings);

        $card = new CardBuilder();
        $card->setPaymentBrand('VISA');
        $card->setCardNumber('4711100000000000');
        $card->setCardHolder('Jane Jones');
        $card->setExpiryMonth('05');
        $card->setExpiryYear('2021');
        $card->setCvv('123');

        $response = $client->registerCard($card);

        $responseData = json_decode($response, true);
        $responseCheck = new Response();
        $registrationId = $responseData['id'];

        $this->assertTrue($responseCheck->isSuccessfulResponse($responseData['result']['code']));

        $this->settings->setEntityIdOnceRecurring('8a8294174e735d0c014e78cf26461790');

        $response = $client->oneClickPayment($registrationId, 2000);
        $responseData = json_decode($response, true);
        $this->assertTrue($responseCheck->isSuccessfulResponse($responseData['result']['code']));

        VCR::turnOff();
    }
}
