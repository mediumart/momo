<?php
namespace Mediumart\MobileMoney;

trait HasUserData
{
    /**
     * User Data.
     *
     * @var array
     */
    protected $_data = [];

    /**
     * User Data Keys.
     *
     * @var string[]
     */
    protected $_keys = [
        'userid',
        'apikey',
        'subscriptionkey',
    ];

     /**
     * Set data.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function __set(string $name, string $value) { if (\in_array($name, $this->_keys)) $this->_data[$name] = $value; }

    /**
     * Get data.
     *
     * @param string $name
     * @return mixed
     */
   public function __get(string $name) { return \array_key_exists($name, $this->_data) ? $this->_data[$name] : null; }
}
