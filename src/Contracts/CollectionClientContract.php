<?php
namespace Mediumart\Momo\Contracts;

use Psr\Http\Message\ResponseInterface;

interface CollectionClientContract
{
    /**
     * Create a token.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createToken(string $userReferenceId, string $apiKey):ResponseInterface;

    /**
     * Request a payment from a consumer (Payer).
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPay(
        string $token, 
        string $requestReferenceId,
        array $payloadData, 
        string $callbackUrl=null):ResponseInterface;
}