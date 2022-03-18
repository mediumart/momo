<?php
namespace Mediumart\Momo;

abstract class BaseClient
{
    /**
     * base url path.
     * 
     * @var string
     */
    protected $baseUrl;

    /**
     * Http Client.
     * 
     * @var \GuzzleHttp\Client
     */
    protected $client;
    
    /**
     * Subscription key.
     * 
     * @var string
     */
    protected $subscriptionKey;

    /**
     * Target Evironment.
     * 
     * @var string
     */
    protected $targetEnvironment;

    /**
     * Construct.
     */
    public function __construct(
        \GuzzleHttp\Client $client, 
        string $subscriptionKey,
        string $targetEnvironment = 'sandbox'
        )
    {
        $this->client = $client;
        $this->subscriptionKey = $subscriptionKey;
        $this->targetEnvironment = $targetEnvironment;
    }
}
