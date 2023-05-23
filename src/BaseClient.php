<?php

namespace Mediumart\MobileMoney;

use Psr\Http\Message\ResponseInterface;

/**
 * @method ResponseInterface createAccessToken(string $subscriptionKey, string $userReferenceId, string $apiKey)
 * @method ResponseInterface validateAccountHolderStatus(string $accountHolderId,string $accountHolderIdType,string $subscriptionKey,string $targetEnv,string $token)
 * @method ResponseInterface getAccountBalance(string $subscriptionKey, string $targetEnv, string $token)
 * @method ResponseInterface getBasicUserinfo(string $msisdn, string $subscriptionKey, string $targetEnv, string $token)
 * @method ResponseInterface requestToPayDeliveryNotification(string $message, string $subscriptionKey, string $requestId, string $targetEnv, string $token)
 */
abstract class BaseClient
{
    use SharedApi;

    /**
     * The base url of all the api endpoints.
     *
     * will be 'https://ericssondeveloperapi.portal.azure-api.net/' for the live env
     * or 'https://proxy.momoapi.mtn.com/' for live testing
     * or "https://sandbox.momodeveloper.mtn.com" for sandbox env
     *
     * @var string
     */
    protected $baseurl;

    /**
     * Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Construct.
     */
    public function __construct(\GuzzleHttp\Client $client, string $baseurl)
    {
        $this->client = $client;
        $this->baseurl = $baseurl;
    }

    /**
     * Set client baseurl
     *
     * @param string $baseurl
     * @return void
     */
    public function setBaseurl(string $baseurl)
    {
        $this->baseurl = $baseurl;
    }

    /**
     * Get client baseurl
     *
     * @return string
     */
    public function getBaseurl():string
    {
        return $this->baseurl;
    }
}
