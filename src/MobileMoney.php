<?php
namespace Mediumart\MobileMoney;

/**
 * Services.
 * 
 * @method Env\Factory sandbox
 * @method Env\Factory live
 * @method Collection\Client collection
 * @method Disbursement\Client disbursement
 * @method Remittance\Client remittance
 * @method Widget\Client widget
 */
class MobileMoney
{   
    /**
     * @var Env\Live
     */
    static protected $live;

    /**
     * @var Env\Sandbox
     */
    static protected $sandbox;
    
    /**
     * Factory method for Sandbox environment.
     * 
     * @return Env\Factory
     */
    static public function sandbox():Env\Factory
    {
        return static::$sandbox ?? static::$sandbox = new Env\Sandbox;
    }

    /**
     * Factory method for Live environment.
     * 
     * @return Env\Factory
     */
    static public function live():Env\Factory
    {
        return static::$live ?? static::$live = new Env\Live;
    }
    
    /**
     * Get a service with 'Live' as default evnironment.
     * 
     * @return mixed
     */
    static public function __callStatic(string $name, array $arguments): mixed
    {
        return static::live()->{$name}(...$arguments);
    }
}
