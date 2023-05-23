# Mediumart momo (WIP)

![Build Status](https://github.com/mediumart/momo/actions/workflows/ci.yml/badge.svg)

![Phpstan](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)

![License](https://poser.pugx.org/stripe/stripe-php/license.svg)

An MTN Mobile Money php client.

## Requirements

PHP >=8.0

## Installation

You can install via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require  mediumart/momo
```

## Sandbox

The client `env` configuration default to `live`. If you want to practice in the sandbox environment before going live, you probably want to enable it before resolving any client instance.

```php
use Mediumart\MobileMoney\MobileMoney;

MobileMoney::setCurrentEnvironment('sandbox');
```

Alternatively, you can also configure a specific service instance to run in the sandbox by providing a `'sandbox'` argument upon getting the instance.

```php
$collection =  MobileMoney::collection('sandbox');
```

Connect to your [Momo developer Dashboard](https://momodeveloper.mtn.com/developer), subscribe to a product : `collection`, `disbursement`, or `remittance`. Go to your profile and grab the corresponding subscription key (should be `primary key` or `secondary key`).
Then create a new sandbox user for your subscription key.

```php
use Mediumart\MobileMoney\Sandbox\UsersProvisioning;

$user =  UsersProvisioning::sandboxUserFor('<your product subscription key>');
```

This will return a fresh new `SandboxUser` instance, that is a value object with two properties: `id` and `apiKey`.

```php
$id = $user->id;

$apikey = $user->apiKey;
```

Use it to get a new access token for a service (`collection`, `disbursement`, or `remittance`).

```php
$collection = MobileMoney::collection();

$token = $collection->createAccessToken('<your_subscription_key>', $id, $apikey);
```

## Usage

Mtn Mobile Money API supported services are: `collection`, `disbursement`, and `remittance`.
Resolve services clients instances using the `MobileMoney` facade.

```php
use Mediumart\MobileMoney\MobileMoney;

$collection =  MobileMoney::collection();
$disbursement =  MobileMoney::disbursement();
$remittance =  MobileMoney::remittance();
```

Then this is the list of methods you 'll have access to :

#### shared Api (`collection`, `disbursement`, and `remittance`)

-   `createAccessToken`
-   `validateAccountHolderStatus`
-   `getAccountBalance`
-   `getBasicUserinfo`
-   `requestToPayDeliveryNotification`

#### transferApi (`disbursement`, `remittance`)

-   `transfer`
-   `getTransferStatus`

#### collection

-   `requestToPay`
-   `requestToPayTransactionStatus`
-   `requestToWithdrawV1`
-   `requestToWithdrawV2`
-   `requestToWithdrawV1TransactionStatus`

#### disbursement

-   `depositV1`
-   `depositV2`
-   `getDepositStatus`
-   `refundV1`
-   `refundV2`
-   `getRefundStatus`
