<?php
namespace Mediumart\MobileMoney;

/**
 * @property-read string $id
 * @property-read string $apikey
 * @property-read string $subscriptionkey
 */
class User
{
    /**
     * Constructor.
     *
     * @param string $id
     * @param string $apikey
     * @param string $subscriptionkey
     */
    public function __construct(protected string $id, protected string $apikey, protected string $subscriptionkey) {}

    /**
     * Get the property value.
     *
     * @param string $name
     * @return mixed
     */
   public function __get(string $name) { return property_exists($this, $name) ? $this->{$name} : null; }
}
