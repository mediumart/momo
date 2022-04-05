<?php
namespace Mediumart\MobileMoney;

abstract class BaseClient
{
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
}
