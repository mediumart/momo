<?php
namespace Mediumart\MobileMoney\Env;

class Sandbox extends Factory
{
    /**
     * Get the env base url.
     * 
     * @return string
     */
    protected function baseurl(string $serviceName):string
    {
        return 'https://sandbox.momodeveloper.mtn.com/'.$serviceName;
    }
}