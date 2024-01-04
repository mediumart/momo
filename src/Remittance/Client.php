<?php
namespace Mediumart\MobileMoney\Remittance;

use Mediumart\MobileMoney\BaseClient;
use Mediumart\MobileMoney\TransferApi;
use Psr\Http\Message\ResponseInterface;

/**
 * @method ResponseInterface transfer(string $subscriptionKey, string $requestId, string $token, string $targetEnv, array $payload, string $callbackUrl = null)
 * @method ResponseInterface getTransferStatus(string $subscriptionKey, string $requestId, string $token, string $targetEnv)
 */
class Client extends BaseClient
{
    use TransferApi;

    /**
     * Cash transfer operation is used to transfer an amount from the owner’s account to a payee account.
     * Status of the transaction can be validated by using GET /cashtransfer/{referenceId}
     *
     * @param string $cashTransferId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
     * @param string|null $callbackUrl
     * @return ResponseInterface
     */
    public function cashTransfer(
        string $cashTransferId,
        string $token,
        string $targetEnv,
        array $payload,
        string $callbackUrl = null
    )
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv,
            'X-Reference-Id' => $cashTransferId
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST',
            $this->baseurl.'/v2_0/cashtransfer', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to get the status of a transfer.
     * cash transfer-Id that was passed in the post is used as reference to the request.
     *
     * @param string $cashTransferId
     * @param string $token
     * @param string $targetEnv
     * @return ResponseInterface
     */
    public function getCashTransferStatus(string $cashTransferId, string $token, string $targetEnv)
    {
        return $this->client->request('GET',
            $this->baseurl.'/v2_0/cashtransfer/'.$cashTransferId, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                ]
            ]
        );
    }
}
