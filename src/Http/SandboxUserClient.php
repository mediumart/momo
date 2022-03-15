<?php
namespace Mediumart\Momo\Http;

use Mediumart\Momo\Http\HttpClient;
use Psr\Http\Message\ResponseInterface;
use Mediumart\Momo\Contracts\SandboxUserClientContract;

class SandboxUserClient extends HttpClient implements SandboxUserClientContract
{
    /**
     * Create a Momo Api user.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiUser(string $referenceId, string $body):ResponseInterface
    {
        return $this->client->request('POST', $this->baseUrl.'/v1_0/apiuser', [
            'headers' => [
                'X-Reference-Id' => $referenceId,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
            ],
            'body' => $body 
        ]);
    }

    /**
     * Create an Api key for the referenced user.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $referenceId):ResponseInterface
    {
        return $this->client->request('POST', 
            $this->baseUrl.'/v1_0/apiuser/'.$referenceId.'/apikey', [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ]
            ]
        );
    }

    /**
     * Get an Api user infos.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getApiUser(string $referenceId):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseUrl.'/v1_0/apiuser/'.$referenceId, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ]
            ]
        );
    }
}
