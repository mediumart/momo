<?php
namespace Mediumart\MobileMoney\Sandbox;

class ApiUser
{
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
     * @param string $id
     * @param string $apiKey
     */
    public function __construct(string $id, string $apiKey)
    {
        $this->id = $id;
        $this->apiKey = $apiKey;
    }

    /**
     * Get property value.
     * 
     * @param string $name
     * @return string
     */
    public function __get(string $name):string
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new \Exception('Undefined property');
    }
}
