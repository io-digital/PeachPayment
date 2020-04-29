<?php

namespace IoDigital\PeachPayment\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use IoDigital\PeachPayment\Tests\TestCase;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    /**
     * @test
     */
    public function it_can_receive_an_event()
    {
        $response = $this->postJson(route('peachpayment.index'), []);

        $response->assertOk();
    }
}
