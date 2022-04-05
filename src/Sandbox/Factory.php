<?php
namespace Mediumart\MobileMoney\Sandbox;

use GuzzleHttp\Client as GuzzleHttpClient;

class Factory
{
    static protected $httpClient;

    /**
     * @return ClientInterface
     */
    static public function httpClient():ClientInterface
    {
        if (! static::$httpClient) {
            static::$httpClient = new Client(new GuzzleHttpClient);
        }
        
        return static::$httpClient;
    }
}
