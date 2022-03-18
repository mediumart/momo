<?php
namespace Mediumart\Momo\Sandbox;

use GuzzleHttp\Client as GuzzleHttpClient;

class Factory
{
    static protected $httpClient;

    /**
     * @return Client
     */
    static public function httpClient()
    {
        if (! static::$httpClient) {
            static::$httpClient = new Client(new GuzzleHttpClient);
        }
        
        return static::$httpClient;
    }
}
