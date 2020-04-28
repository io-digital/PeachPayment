<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use IoDigital\PeachPayment\Http\Controllers\WebhookController;

Route::post(Config::get('peachpayment.webhook_url'), [WebhookController::class, 'index'])->name('peachpayment.index');
