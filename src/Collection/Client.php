<?php
namespace Mediumart\MobileMoney\Collection;

use Exception;
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
            $this->baseurl.'/collection/v1_0/accountholder/'.$accountHolderIdType.'/'.$accountHolderId.'/active',[
                'headers' =>  [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
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
            $this->baseurl.'/collection/v1_0/requesttopay/'.$requestId.'/deliverynotification',[
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
            $this->baseurl.'/collection/v1_0/requesttopay/'.$requestId,[
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
            $this->baseurl.'/collection/v1_0/requesttowithdraw',[
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
            $this->baseurl.'/collection/v2_0/requesttowithdraw',[
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
            $this->baseurl.'/collection/v1_0/requesttowithdraw/'.$requestId,[
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
            $this->baseurl.'/collection/v1_0/account/balance',
            [
                'headers' => [
                    // // optional ???
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
            $this->baseurl.'/collection/v1_0/accountholder/msisdn/'.$msisdn.'/basicuserinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv,
                    'Ocp-Apim-Subscription-Key' => $subscriptionKey
                ]
            ]
        );
    }
}
