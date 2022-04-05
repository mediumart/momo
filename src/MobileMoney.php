<?php
namespace Mediumart\MobileMoney;

class MobileMoney
{   
    /**
     * Factory method for Sandbox environment.
     * 
     * @return Env\Factory
     */
    static public function sandbox():Env\Factory
    {
        return new Env\Sandbox;
    }

    /**
     * Factory method for Live environment.
     * 
     * @return Env\Factory
     */
    static public function live():Env\Factory
    {
        return new Env\Live;
    }
}
