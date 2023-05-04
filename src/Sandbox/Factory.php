<?php
namespace Mediumart\MobileMoney\Sandbox;

use GuzzleHttp\Client as GuzzleHttpClient;

class Factory
{
    /**
     * Http client
     *
     * @var ClientInterface | null
     */
    static protected $httpClient;

    /**
     * @return ClientInterface
     */
    static public function httpClient(): ClientInterface
    {
        return static::$httpClient ?? static::$httpClient = new Client(new GuzzleHttpClient);
    }
}
