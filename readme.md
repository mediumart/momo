# Mediumart momo

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

This will get you a fresh `Mediumart\ModileMoney\User` instance, a value object with 3 properties (all lowercase):

```php

$id = $user->id;

$apikey = $user->apikey;

$subscriptionkey = $user->subscriptionkey;
```

Use them to get a new access token for the corresponding service (`collection`, `disbursement`, or `remittance`).

```php
$collection = MobileMoney::collection();

$token = $collection->createAccessToken($subscriptionkey, $id, $apikey);
```

The same `Mediumart\ModileMoney\User` class can be used to store similar values in your `live` environment.

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

-   `bcAuthorize`
-   `createAccessToken`
-   `createOauth2Token`
-   `validateAccountHolderStatus`
-   `getAccountBalance`
-   `getBasicUserinfo`
-   `getUserInfoWithConsent`
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
-   `cancelInvoice`
-   `createInvoice`
-   `getInvoiceStatus`
-   `createPayments`
-   `getPaymentStatus`
-   `preApproval`
-   `getPreApprovalStatus`

#### disbursement

-   `depositV1`
-   `depositV2`
-   `getDepositStatus`
-   `refundV1`
-   `refundV2`
-   `getRefundStatus`

#### remittance

-   `cashTransfer`
-   `getCashTransferStatus`

For now, to know which parameters are required for each method, [**please look at the code**](https://github.com/mediumart/momo/tree/master/src) . A complete API docs may be released soon.

## License

Mediumart momo is an open-sourced software licensed under the [MIT license](https://github.com/mediumart/momo/blob/master/LICENSE.txt).
