<?php
namespace Mediumart\Momo\Sandbox;

class ApiUser
{
    /**
     * The product api name.
     * 
     * @var string
     */
    protected $api;

    /**
     * Reference Id.
     * 
     * @var string
     */
    protected $id;

    /**
     * Api Key.
     * 
     * @var string
     */
    protected $apiKey;

    /**
     * Construct.
     * 
     * @param string $api
     * @param string $id
     * @param string $apiKey
     */
    public function __construct(string $id, string $api, string $apiKey)
    {
        $this->id = $id;
        $this->api = $api;
        $this->apiKey = $apiKey;
    }

    /**
     * Get property value.
     * 
     * @param string $name
     * @return void
     */
    public function __get(string $name):mixed
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new \Exception('Undefined property');
    }
}
