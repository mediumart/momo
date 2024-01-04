<?php
namespace Mediumart\MobileMoney;

use Exception;
use Psr\Http\Message\ResponseInterface;

trait SharedApi
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
            $this->baseurl.'/token/',
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
            $this->baseurl.'/v1_0/accountholder/'.$accountHolderIdType.'/'.$accountHolderId.'/active',[
                'headers' =>  [
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAccountBalance(
        string $subscriptionKey,
        string $targetEnv,
        string $token,
        string $currency = null
    ):ResponseInterface
    {
        $path = $currency ? '/v1_0/account/balance/'.$currency : '/v1_0/account/balance';

        return $this->client->request('GET',
            $this->baseurl.$path,
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getBasicUserinfo(
        string $msisdn, // phone number
        string $subscriptionKey,
        string $targetEnv,
        string $token
    ):ResponseInterface
    {
        return $this->client->request('GET',
            $this->baseurl.'/v1_0/accountholder/msisdn/'.$msisdn.'/basicuserinfo',
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
            $this->baseurl.'/v1_0/requesttopay/'.$requestId.'/deliverynotification',[
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
     * This operation is used to claim a consent by the account holder for the requested scopes.
     *
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createOauth2Token(string $token, string $targetEnv)
    {
        return $this->client->request('POST', $this->baseurl.'/oauth2/token/', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'X-Target-Environment' => $targetEnv
            ]
        ]);
    }

    /**
     * This operation is used to claim a consent by the account holder for the requested scopes.
     *
     * @param string $token
     * @param string $targetEnv
     * @param string|null $callbackUrl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bcAuthorize(string $token, string $targetEnv, string $callbackUrl = null)
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
            'X-Target-Environment' => $targetEnv
        ];

        if (! empty($callbackUrl)) {
            $headers['X-Callback-Url'] = $callbackUrl;
        }

        return $this->client->request('POST',
            $this->baseurl.'/v1_0/bc-authorize', [
                'headers' => $headers
            ]
        );
    }

    /**
     * This operation is used to claim a consent by the account holder for the requested scopes.
     *
     * @param string $token
     * @param string $targetEnv
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getUserInfoWithConsent(string $token, string $targetEnv)
    {
        return $this->client->request('GET',
            $this->baseurl.'/oauth2/v1_0/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'X-Target-Environment' => $targetEnv
                ]
            ]
        );
    }
}
