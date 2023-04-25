<?php
namespace Mediumart\MobileMoney\Tests;

use PHPUnit\Framework\TestCase as PHP_Unit_Test_Case;

class TestCase extends PHP_Unit_Test_Case
{
    /**
     * @var ApiUser
     */
    protected $sandboxUser;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $accessToken;
}