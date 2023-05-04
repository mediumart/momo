<?php
namespace Mediumart\MobileMoney;

use Psr\Http\Message\ResponseInterface;

trait TransferApi
{
    /**
     * Transfer an amount from the own account to a payee account.
     *
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param mixed[] $payload
     * @param string $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function transfer(
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
            $this->baseurl.'/v1_0/transfer', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * Get the status of a transfer.
     *
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTransferStatus(
        string $subscriptionKey,
        string $requestId,
        string $token,
        string $targetEnv
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/v1_0/transfer/'.$requestId, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
