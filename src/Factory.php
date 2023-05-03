<?php
namespace Mediumart\MobileMoney;

trait Factory
{
    /**
     * Current environement.
     *
     * @var string
     */
    static protected $env = 'live';

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
     * Momo Services instances.
     *
     * @var array
     */
    static protected $servicesInstances = [];

    /**
     * Get a new Service instance.
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments):mixed
    {
        if (! \in_array($name, static::$services)) {
            $msg = "Unknown service: [{$name}]. "
                . "Supported services for Mtn Mobile Money are: "
                . "collection, disbursement, and remittance.";

            throw new \Exception($msg);
        }

        $env = isset($arguments[0])
                    && $arguments[0] === 'sandbox'
                    ? 'sandbox'
                    : null;

        return static::getServiceInstance($name, $env);
    }

    /**
     * Set Momo Environment.
     *
     * @param string $value
     *
     * @return void
     */
    public static function setCurrentEnvironment(string $value)
    {
        if (\in_array($value, ['sandbox', 'live'])) static::$env = $value;
    }

    /**
     * Get Momo Environment.
     *
     * @return string
     */
    public static function getCurrentEnvironment(): string
    {
        return static::$env;
    }

    /**
     * Get http client.
     *
     * @return \GuzzleHttp\Client
     */
    protected static function httpClient():\GuzzleHttp\Client
    {
        return static::$httpClient ?? static::$httpClient = new \GuzzleHttp\Client;
    }

    /**
     * Get Service instance.
     *
     * @param string $name
     * @param string|null $env
     *
     * @return mixed
     */
    protected static function getServiceInstance($name, $env = null): mixed
    {
        $env = $env ?? static::$env;

        if (\array_key_exists($name, static::$servicesInstances)) {
            $i = static::$servicesInstances[$name];
            $i->setBaseurl(static::$baseurls[$env].$name);

            return $i;
        }

        return static::$servicesInstances[$name] = static::newServiceInstance($name, $env);
    }

    /**
     * Create a new service instance.
     *
     * @param string $name
     * @param string $env
     *
     * @return mixed
     */
    protected static function newServiceInstance($name, $env): mixed
    {
        $namespace = __NAMESPACE__;

        $instanceName = ucfirst($name);

        $instanceClass = "{$namespace}\\{$instanceName}\\Client";

        return new $instanceClass(static::httpClient(), static::$baseurls[$env].$name);
    }
}
