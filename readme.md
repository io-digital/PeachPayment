# PeachPayment

**This is a work in progress.**

## Installation

Via Composer

``` bash
$ composer require iodigital/peachpayment
```

This package uses auto discovery but can be added to your `config/app.php` providers
by adding `\IoDigital\PeachPayment\PeachPaymentServiceProvider::class,`

You can publish the assets with the following:
`php artisan vendor:publish --tag=peachpayment-config`
`php artisan vendor:publish --tag=peachpayment-migrations`

### Config file
The configuration file provides you with the ability of adding your production
and test Peach Payment credentials. The package does a check against your app
environment.

The variables that can be used are:
- `PEACH_PAYMENTS_USER_ID`
- `PEACH_PAYMENTS_PASSWORD`
- `PEACH_PAYMENTS_AUTHORIZATION_HEADER`
- `PEACH_PAYMENTS_ENTITY_ID_ONCE_OFF`
- `PEACH_PAYMENTS_ENTITY_ID_RECURRING`
- `PEACH_PAYMENTS_TEST_MODE`
- `PEACH_PAYMENTS_NOTIFICATION_URL`
- `PEACH_PAYMENTS_WEBHOOK_SECRET_KEY`

### Migrations

#### `payment_cards`
This table can be used in conjunction with Server to Server functionality.

#### `payment_results`
This table can be used to store the results of transactions.

#### `payment_events`
This table can be used to store the event data received from webhooks.

## Usage

This package provides the ability of using Server to Server and COPYandPay.
Fairly simple to get either one going:

```php
$client = (new PeachPayment())->initServerToServer();
// or
$client = (new PeachPayment())->initCopyAndPay();
```

As explained further below, you can also override your Peach Payment
credentials on the fly:

```php
$client = (new PeachPayment())->initServerToServer($settings);
```
Where `$settings` is a fluent class.

Methods available to Server to Server:
```php
registerCard(CardBuilder $card);
registerCardDuringPayment(CardBuilder $card);
repeatedPayment(PaymentCard $card, $owner, int $amount, string $type = PaymentScheme::REPEATED_PAYMENT);
oneClickPayment(PaymentCard $card, int $amount);
paymentStatus(string $paymentId);
deleteCard(string $registrationId);

// Available options for $type in repeatedPayment()
PaymentScheme::INITIAL_PAYMENT;
PaymentScheme::REPEATED_PAYMENT;
```

Methods available to COPYandPAY:
```php
prepareCheckout(int $amount);
getCheckoutRegistrationResult($checkoutId);
registerCard();
registerCardDuringPayment(int $amount);
repeatedPayment(PaymentCard $card, $owner, int $amount, string $type = PaymentScheme::REPEATED_PAYMENT);
paymentStatus(string $checkoutId);
```

To determine the result of a transaction with Peach Payment, you can
use the Response class:

```php
$response = new \IoDigital\PeachPayment\Api\Response();
$response->isSuccessfulResponse($resultCode); // true|false
$response->isValidationError($resultCode); // true|false
```

Saving the response is also available:
`$response->save($result, $paymentCard);`

### Webhooks

The following change needs to be made in your `app/Http/Middleware/VerifyCsrfToken.php` file:

```php
protected $except = [
        config('peachpayment.webhook_url')
    ];
```

### Helpers
#### Setting.php
This class allows you to inject or modify your Peach Payment credentials
on a per usage basis. By default, it uses the variables given in the config file
and you only have to override the variables needed.

Usage is fairly straightforward:
```php
$settings = new Setting();
$settings->setUser('lorem')
         ->setPassword('ipsum')
         ->setEntityIdOnceOff('dolor');

$pay = (PeachPayment())->initServerToServer($settings);
```
This should provide flexibility in certain edge cases.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

