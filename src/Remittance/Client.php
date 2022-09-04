<?php
namespace Mediumart\MobileMoney\Remittance;

use Mediumart\MobileMoney\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
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
            $this->baseurl.'/remittance/token/', 
            [
                'headers' => [
                    'Authorization' => 'Basic '.\base64_encode($userReferenceId.':'.$apiKey),
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * Transfer an amount from the own account to a payee account.
     * 
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $token
     * @param string $targetEnv
     * @param array $payload
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
            $this->baseurl.'/remittance/v1_0/transfer', [
                'headers' => $headers,
                'body' => json_encode($payload)
            ]
        );
    }

    /**
     * This operation is used to send additional Notification to an End User.
     * 
     * @param string $message
     * @param string $subscriptionKey
     * @param string $requestId
     * @param string $targetEnv
     * @param string $token
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestToPayDeliveryNotification(
        string $message,
        string $subscriptionKey,
        string $requestId,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        if (strlen($message) > 160) {
            throw new Exception('Notification message should be 160 characters max');
        }

        return $this->client->request('POST', 
            $this->baseurl.'/remittance/v1_0/requesttopay/'.$requestId.'/deliverynotification',[
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'notificationMessage' => $message, // Max length 160
                    'X-Target-Environment' => $targetEnv,
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ],
                'body' => json_encode(['notificationMessage' => $message])
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
            $this->baseurl.'/remittance/v1_0/transfer/'.$requestId, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * Get Account Balance.
     * 
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param string $token
     */
    public function getAccountBalance(
        string $subscriptionKey,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/remittance/v1_0/account/balance',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * This operation returns personal information of the account holder. 
     * The operation does not need any consent by the account holder.
     * 
     * @param string $msisdn
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param string $token
     */
    public function getBasicUserinfo(
        string $msisdn, // phone number
        string $subscriptionKey,
        string $targetEnv,
        string $token,
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/remittance/v1_0/accountholder/msisdn/'.$msisdn.'/basicuserinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }

    /**
     * Operation is used to check if an account holder is registered and active in the system.
     * 
     * @param string $accountHolderId
     * 
     * specifies the type of the party ID. Allowed values [msisdn, email, party_code].
     * accountHolderId should explicitly be in small letters.
     * @param string $accountHolderIdType 
     * 
     * @param string $subscriptionKey
     * @param string $targetEnv
     * @param string $token
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function validateAccountHolderStatus(
        string $accountHolderId,
        string $accountHolderIdType,
        string $subscriptionKey,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        return $this->client->request('GET', 
            $this->baseurl.'/remittance/v1_0/accountholder/'.$accountHolderIdType.'/'.$accountHolderId.'/active',[
                'headers' =>  [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
