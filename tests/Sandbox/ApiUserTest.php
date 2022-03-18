<?php
namespace Mediumart\Momo\Tests\Sandbox;

use Mediumart\Momo\Sandbox\ApiUser;
use Mediumart\Momo\Tests\TestCase;

class ApiUserTest extends TestCase
{
    public function testCanGetApiUserDataProperties()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $api = 'collection';
        $apiKey= 'oKhSR5nslBRnBZpjO6KuzZeX';

        $user = new ApiUser($id, $api, $apiKey);

        $this->assertSame($id, $user->id);
        $this->assertSame($api, $user->api);
        $this->assertSame($apiKey, $user->apiKey);
    }

    public function testExceptionIsThrownWhenGettingUndefinedProperty()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $api = 'collection';
        $apiKey= 'oKhSR5nslBRnBZpjO6KuzZeX';

        $user = new ApiUser($id, $api, $apiKey);

        $this->expectException(\Exception::class);

        $value = $user->nonExistantProperty;
    }
}