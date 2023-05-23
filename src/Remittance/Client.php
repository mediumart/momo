<?php
namespace Mediumart\MobileMoney\Remittance;

use Mediumart\MobileMoney\BaseClient;
use Mediumart\MobileMoney\TransferApi;
use Psr\Http\Message\ResponseInterface;

/**
 * @method ResponseInterface transfer(string $subscriptionKey, string $requestId, string $token, string $targetEnv, array $payload, string $callbackUrl = null)
 * @method ResponseInterface getTransferStatus(string $subscriptionKey, string $requestId, string $token, string $targetEnv)
 */
class Client extends BaseClient
{
    use TransferApi;
}
