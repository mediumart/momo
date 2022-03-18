<?php
namespace Mediumart\Momo\Sandbox;

use GuzzleHttp\Client as GuzzleHttpClient;
use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
    /**
     * Base url.
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
     * Construct.
     * 
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(GuzzleHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create a sandbox api user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiUser(string $referenceId, string $subscriptionKey):ResponseInterface
    {
        return $this->client->request('POST', $this->baseUrl.'/v1_0/apiuser', [
            'headers' => [
                'X-Reference-Id' => $referenceId,
                'Ocp-Apim-Subscription-Key' => $subscriptionKey
            ],
            'body' => '{"providerCallbackHost": "isaacesso.com"}'
        ]);
    }

    /**
     * Create an api key for the referenced user.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $referenceId, string $subscriptionKey):ResponseInterface
    {
        return $this->client->request('POST', 
            $this->baseUrl.'/v1_0/apiuser/'.$referenceId.'/apikey', [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * Get an api user infos.
     * 
     * @param string $referenceId
     * @param string $subscriptionKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getApiUser(string $referenceId, string $subscriptionKey):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseUrl.'/v1_0/apiuser/'.$referenceId, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
