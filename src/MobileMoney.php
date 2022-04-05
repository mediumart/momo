<?php
namespace Mediumart\MobileMoney;

class MobileMoney
{   
    static protected $sandbox;
    static protected $live;

    /**
     * Factory method for Sandbox environment.
     * 
     * @return Env\Factory
     */
    static public function sandbox():Env\Factory
    {
        if (! static::$sandbox) {
            static::$sandbox = new Env\Sandbox;
        }

        return static::$sandbox;
    }

    /**
     * Factory method for Live environment.
     * 
     * @return Env\Factory
     */
    static public function live():Env\Factory
    {
        if (! static::$live) {
            static::$live = new Env\Live;
        }

        return static::$live;
    }
}
