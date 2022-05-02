<?php
namespace Mediumart\MobileMoney\Collection;

class Service extends Client
{
    /**
     * Expose Client protected methods for now.
     * The Service owned behaviors are to do next...
     * 
     * @param string $method
     * @param array $arguments
     * @return void
     */
    public function __call(string $method, array $arguments):void
    {
        $this->{$method}($arguments);
    }
}
