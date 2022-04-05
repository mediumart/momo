<?php
namespace Mediumart\MobileMoney\Env;

class Sandbox implements Factory
{
    /**
     * Get the env base url.
     * 
     * @return string
     */
    protected function baseurl():string
    {
        return 'https://ericssondeveloperapi.portal.azure-api.net/';
    }
}