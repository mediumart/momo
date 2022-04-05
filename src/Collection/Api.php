<?php
namespace Mediumart\MobileMoney\Collection;

use Psr\Http\Message\ResponseInterface;

interface Api
{
    /**
     * Create an access token.
     * 
     * @param string $subscriptionKey
     * @param string $userReferenceId
     * @param string $apiKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createToken(
        string $subscriptionKey, 
        string $userReferenceId, 
        string $apiKey):ResponseInterface;

    /**
     * Request a payment from a consumer (Payer).
     * 
     * @param string $subscriptionKey
     * @param string $token
     * @param string $requestId
     * @param string $targetEnv
     * @param array $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPay(
        string $subscriptionKey,
        string $token, 
        string $requestId,
        string $targetEnv,
        array $payload, 
        string $callbackUrl=null):ResponseInterface;
}