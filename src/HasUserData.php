<?php
namespace Mediumart\MobileMoney;

trait HasUserData
{
    /**
     * User Data.
     *
     * @var string[]
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
     * Set user data.
     *
     * @param User $user
     * @return static
     */
    public function withUser(User $user)
    {
        foreach ($this->_keys as $key) {
            if (!isset($user->$key)) {
                throw new \InvalidArgumentException("Missing required user data: {$key}");
            }
            $this->_data[$key] = $user->$key;
        }

        return $this;
    }

     /**
     * Set data.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function __set(string $key, string $value) { if (\in_array($key, $this->_keys)) $this->_data[$key] = $value; }

    /**
     * Get data.
     *
     * @param string $key
     * @return mixed
     */
   public function __get(string $key) { return \array_key_exists($key, $this->_data) ? $this->_data[$key] : null; }
}
