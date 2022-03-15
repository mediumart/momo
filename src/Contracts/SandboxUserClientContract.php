<?php
namespace Mediumart\Momo\Contracts;

use Psr\Http\Message\ResponseInterface;

interface SandboxUserClientContract
{
    /**
     * Create a Momo Api user.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiUser(string $referenceId, string $body):ResponseInterface;

    /**
     * Create an Api key for the referenced user.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $referenceId):ResponseInterface;
    
    /**
     * Get an Api user infos.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getApiUser(string $referenceId):ResponseInterface;
}