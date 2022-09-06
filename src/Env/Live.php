<?php
namespace Mediumart\MobileMoney\Env;

class Live extends Factory
{
    /**
     * Get the env base url.
     * 
     * @param string $serviceName
     * @return string
     */
    protected function baseurl(string $serviceName):string
    {
        return 'https://ericssondeveloperapi.portal.azure-api.net/'.$serviceName;
    }
}
