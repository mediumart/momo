<?php
namespace Mediumart\MobileMoney\Sandbox;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * Create a sandbox api user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiUser(string $referenceId, string $subscriptionKey):ResponseInterface;

    /**
     * Create an api key for the referenced user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $referenceId, string $subscriptionKey):ResponseInterface;
    
    /**
     * Get an api user infos.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getApiUser(string $referenceId, string $subscriptionKey):ResponseInterface;
}
