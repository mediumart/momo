<?php
namespace Mediumart\Momo\Http;

abstract class HttpClient
{
    /**
     * base url path.
     * 
     * @var string
     */
    protected $baseUrl = 'https://sandbox.momodeveloper.mtn.com';

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
