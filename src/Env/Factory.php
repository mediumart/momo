<?php
namespace Mediumart\MobileMoney\Env;

abstract class Factory
{
    /**
     * Http client.
     * 
     * @var \GuzzleHttp\Client
     */
    static protected $httpClient;

    /**
     * Momo Services names.
     * 
     * @var array
     */
    private $services = [
        'collection',
        'disbursement',
        'remittance'
    ];

    /**
     * Get a new Service instance.
     * 
     * @return mixed
     */
    public function __call($name, $arguments):mixed
    {
        if (! in_array($name, $this->services)) {
            throw new \Exception('Unknown service');
        }

        $arguments = [
            static::httpClient(), $this->baseurl()
        ];

        return new (rtrim(__NAMESPACE__, '\Env').'\\'.ucfirst($name).'\\Client')(...$arguments);
    }
    
    /**
     * Get the env base url.
     * 
     * @return string
     */
    abstract protected function baseurl():string;

    /**
     * Http client.
     * 
     * @return \GuzzleHttp\Client
     */
    static public function httpClient():\GuzzleHttp\Client
    {
        return static::$httpClient ?? static::$httpClient = new \GuzzleHttp\Client;
    } 
}
