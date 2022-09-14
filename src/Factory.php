<?php
namespace Mediumart\MobileMoney;

trait Factory
{
    /**
     * Http client.
     * 
     * @var \GuzzleHttp\Client
     */
    static protected $httpClient;

    /**
     * paths.
     * 
     * @var array
     */
    static protected $baseurls = [
        'sandbox' => 'https://sandbox.momodeveloper.mtn.com/',
        'live'    => 'https://ericssondeveloperapi.portal.azure-api.net/',
    ];

    /**
     * Momo Services names.
     * 
     * @var array
     */
    static protected $services = [
        'collection',
        'disbursement',
        'remittance'
    ];

    /**
     * Get a new Service instance.
     * 
     * @return mixed
     */
    static public function __callStatic($name, $arguments):mixed
    {
        if (! in_array($name, static::$services)) {
            throw new \Exception(
                'Unknown service. Supported services from Mtn Mobile Money products are: collection,disbursement, and remittance.'
            );
        }

        $env = defined('MOMO_SANDBOX_ENVIRONMENT') ||
                    (array_key_exists(0, $arguments) && $arguments[0] == 'sandbox') 
                            ? 'sandbox' : 'live'; 

        $arguments = [
            static::httpClient(), static::$baseurls[$env].$name
        ];

        return new (__NAMESPACE__.'\\'.ucfirst($name) .'\\Client')(...$arguments);
    }

    /**
     * Get http client.
     * 
     * @return \GuzzleHttp\Client
     */
    static protected function httpClient():\GuzzleHttp\Client
    {
        return static::$httpClient ?? static::$httpClient = new \GuzzleHttp\Client;
    }

    /**
     * Enable sandbox environement.
     */
    static public function sandbox():void
    {
        define('MOMO_SANDBOX_ENVIRONMENT', 'sandbox');
    }
}
