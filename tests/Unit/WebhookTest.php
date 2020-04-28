<?php

namespace IoDigital\PeachPayment\Tests\Unit;

use IoDigital\PeachPayment\Tests\TestCase;

class WebhookTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_receive_an_event()
    {
        $response = $this->postJson(route('peachpayment.index'));

        $response->assertOk();
    }
}
