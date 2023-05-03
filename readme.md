# Mediumart momo

[![Build Status](https://github.com/mediumart/momo/actions/workflows/ci.yml/badge.svg)](https://github.com/stripe/stripe-php/actions?query=branch%3Amaster)
[![License](https://poser.pugx.org/stripe/stripe-php/license.svg)](https://packagist.org/packages/stripe/stripe-php)

An MTN Mobile Money php client.

## Requirements

PHP >=8.0

## Installation

You can install via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require mediumart/momo
```

## Sandbox

The client `env` configuration default to `live`. If you want to practice in the sandbox environment before going live, you probably want to enable it before resolving any client instance.

```php
use Mediumart\MobileMoney\MobileMoney;

MobileMoney::setCurrentEnvironment('sandbox');
```

Alternatively, you can also configure a specific service instance to run in the sandbox by providing a `'sandbox'` argument upon getting the instance.

```php
$collection = MobileMoney::collection('sandbox');
```

Connect to your [Momo developer Dashboard](https://momodeveloper.mtn.com/developer), subscribe to a product : `collection`, `disbursement`, or `remittance`. Go to your profile and grab the corresponding subscription key (should be `primary key` or `secondary key`).

Then create a new sandbox user for your subscription key.

```php
use Mediumart\MobileMoney\Sandbox\UsersProvisioning;

$user = UsersProvisioning::sandboxUserFor('<your product subscription key>');
```

This will return a fresh new `ApiUser` instance that is a value object with two properties: `id` and `apiKey`, that you can use to get a new access token for a product.

```php
$id = $user->id;

$apikey = $user->apiKey;
```

## Usage

Mtn Mobile Money API supported services are: `collection`, `disbursement`, and `remittance`.
Resolve services clients instances using the `MobileMoney` facade.

```php
use Mediumart\MobileMoney\MobileMoney;

$collection = MobileMoney::collection();

$disbursement = MobileMoney::disbursement();

$remittance = MobileMoney::remittance();
```
