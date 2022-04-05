<?php
namespace Mediumart\MobileMoney\Env;

class Live extends Factory
{
    /**
     * Get the env base url.
     * 
     * @return string
     */
    protected function baseurl():string
    {
        return 'https://sandbox.momodeveloper.mtn.com';
    }
}