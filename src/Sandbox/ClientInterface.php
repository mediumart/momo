<?php
namespace Mediumart\Momo\Sandbox;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * Create a Momo Api user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiUser(string $referenceId, string $subscriptionKey):ResponseInterface;

    /**
     * Create an Api key for the referenced user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $referenceId, string $subscriptionKey):ResponseInterface;
    
    /**
     * Get an Api user infos.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getApiUser(string $referenceId, string $subscriptionKey):ResponseInterface;
}