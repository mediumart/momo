<?php
namespace Mediumart\MobileMoney\Collection;

use Mediumart\MobileMoney\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * Claim a consent by the account holder for the requested scopes.
     * 
     * $payload format:
     * 'login_hint=ID:{msisdn}/MSISDN&scope={scope}&access_type={online/offline}'
     * 
     * @param string $subscriptionKey
     * @param string $oauth2Token
     * @param string $targetEnv
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bcAuthorize(
        string $subscriptionKey,
        string $oauth2Token,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$oauth2Token,
            'X-Target-Environment' => $targetEnv,
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) 
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST', 
            $this->baseurl.'/collection/v1_0/bc-authorize',
            [
                'headers'=> $headers,
                
                // Not So Sure about this...
                'body' => json_encode($payload) // Not So Sure about this...
            ]
        );
    }

    /**
     * Create an access token.
     * 
     * @param string $subscriptionKey
     * @param string $userReferenceId
     * @param string $apiKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createAccessToken(
        string $subscriptionKey, 
        string $userReferenceId, 
        string $apiKey
    ):ResponseInterface
    {
        return $this->client->request('POST', 
            $this->baseurl.'/collection/token/', 
            [
                'headers' => [
                    'Authorization' => 'Basic '.\base64_encode($userReferenceId.':'.$apiKey),
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

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
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId, 
            'X-Target-Environment' => $targetEnv,
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) 
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST', 
            $this->baseurl.'/collection/v1_0/requesttopay',[
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }
}
