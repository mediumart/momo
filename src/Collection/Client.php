<?php
namespace Mediumart\MobileMoney\Collection;

use Mediumart\MobileMoney\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
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
            $this->baseurl.'/v1_0/requesttopay',[
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to get the status of a request to pay. 
     * X-Reference-Id that was passed in the post is used as reference to the request..
     * 
     * @param string $requestId
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPayTransactionStatus(
        string $requestId,
        string $subscriptionKey,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        return $this->client->request('GET', 
            $this->baseurl.'/v1_0/requesttopay/'.$requestId,[
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * This operation is used to request a withdrawal (cash-out) from a consumer (Payer). 
     * The payer will be asked to authorize the withdrawal. 
     * The transaction will be executed once the payer has authorized the withdrawal
     * 
     * @param string $requestId
     * @param string $token
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param string $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV1(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) 
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST', 
            $this->baseurl.'/v1_0/requesttowithdraw',[
                'headers' => $headers,
                'body' =>json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to request a withdrawal (cash-out) from a consumer (Payer). 
     * The payer will be asked to authorize the withdrawal. 
     * The transaction will be executed once the payer has authorized the withdrawal
     * 
     * @param string $requestId
     * @param string $token
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param string $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV2(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv,
        array $payload,
        string $callbackUrl=null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) 
            $headers['X-Callback-Url'] = $callbackUrl;

        return $this->client->request('POST', 
            $this->baseurl.'/v2_0/requesttowithdraw',[
                'headers' => $headers,
                'body' =>json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to get the status of a request to withdraw. 
     * X-Reference-Id that was passed in the post is used as reference to the request.
     * 
     * @param string $requestId
     * @param string $userReferenceId
     * @param string $apiKey
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToWithdrawV1TransactionStatus(
        string $requestId,
        string $token,
        string $subscriptionKey,
        string $targetEnv
    ):ResponseInterface
    {
        return $this->client->request('GET', 
            $this->baseurl.'/v1_0/requesttowithdraw/'.$requestId,[
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
