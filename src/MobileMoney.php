<?php
namespace Mediumart\MobileMoney;

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
}
