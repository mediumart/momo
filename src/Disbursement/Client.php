<?php
namespace Mediumart\MobileMoney\Disbursement;

use Mediumart\MobileMoney\BaseClient;
use Mediumart\MobileMoney\TransferApi;
use Psr\Http\Message\ResponseInterface;

/**
 * @method \Psr\Http\Message\ResponseInterface transfer()
 * @method \Psr\Http\Message\ResponseInterface getTransferStatus()
 */
class Client extends BaseClient
{
    use TransferApi;
    
    /**
     * Deposit an amount from the owner’s account to a payee account.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function depositV1(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey,
            'X-Target-Environment' => $targetEnv
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST', 
            $this->baseurl.'/v1_0/deposit', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

     /**
     * Deposit an amount from the owner’s account to a payee account.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function depositV2(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey,
            'X-Target-Environment' => $targetEnv
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST', 
            $this->baseurl.'/v2_0/deposit', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * Get the status of a deposit. 
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getDepositStatus(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv
    ):ResponseInterface
    {
        return $this->client->request('GET', 
            $this->baseurl.'/v1_0/deposit/'.$requestId, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey,
                    'X-Target-Environment' => $targetEnv
                ]
            ]
        );
    }

    /**
     * Refund an amount from the owner’s account to a payee account.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function refundV1(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST',
            $this->baseurl.'/v1_0/refund', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * Refund an amount from the owner’s account to a payee account.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function refundV2(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    ):ResponseInterface
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Reference-Id' => $requestId,
            'X-Target-Environment' => $targetEnv,
            'Ocp-Apim-Subscription-Key' => $subscriptionKey
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST',
            $this->baseurl.'/v2_0/refund', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * Get the status of a refund.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRefundStatus(
        string $subscriptionKey, 
        string $requestId,
        string $token,
        string $targetEnv
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/v1_0/refund/'.$requestId, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
