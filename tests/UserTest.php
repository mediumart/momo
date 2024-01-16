<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\User;
use Mediumart\MobileMoney\Tests\TestCase;

class UserTest extends TestCase
{
    public function testCanGetApiUserDataProperties()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $apikey= 'oKhSR5nslBRnBZpjO6KuzZeX';
        $subscriptionkey = '0ce2ea5d5c98474f94034146fe69d3be';

        $user = new User($id, $apikey, $subscriptionkey);

        $this->assertSame($id, $user->userid);
        $this->assertSame($apikey, $user->apikey);
        $this->assertSame($subscriptionkey, $user->subscriptionkey);
    }

    public function testNulIsReturnedWhenGettingUndefinedProperty()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $apikey= 'oKhSR5nslBRnBZpjO6KuzZeX';
        $subscriptionkey = '0ce2ea5d5c98474f94034146fe69d3be';

        $user = new User($id, $apikey, $subscriptionkey);

        $this->assertNull($user->undefinedProperty);
    }
}
