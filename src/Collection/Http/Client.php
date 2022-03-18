<?php
namespace Mediumart\Momo\Collection\Http;

use Psr\Http\Message\ResponseInterface;
use Mediumart\Momo\BaseClient;

class Client extends BaseClient implements ClientContract
{
    /**
     * Create a token.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createToken(string $userReferenceId, string $apiKey):ResponseInterface
    {
        return $this->client->request(
            'POST', 
            $this->baseUrl.'/collection/token/', 
            [
                'headers' => [
                    'Authorization' => 'Basic '.\base64_encode($userReferenceId.':'.$apiKey),
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ]
            ]
        );
    }

    /**
     * Request a payment from a consumer (Payer).
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPay(
        string $token,
        string $requestReferenceId,
        array $payload, 
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestReferenceId,
            'X-Target-Environment' => $this->targetEnvironment,
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
        ];

        if (!empty($callbackUrl)) 
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST', 
            $this->baseUrl.'/collection/v1_0/requesttopay',[
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }
}
