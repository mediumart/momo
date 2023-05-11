<?php
namespace Mediumart\MobileMoney\Tests\Sandbox;

use Mediumart\MobileMoney\Sandbox\SandboxUser;
use Mediumart\MobileMoney\Tests\TestCase;

class ApiUserTest extends TestCase
{
    public function testCanGetApiUserDataProperties()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $apiKey= 'oKhSR5nslBRnBZpjO6KuzZeX';

        $user = new SandboxUser($id, $apiKey);

        $this->assertSame($id, $user->id);
        $this->assertSame($apiKey, $user->apiKey);
    }

    public function testExceptionIsThrownWhenGettingUndefinedProperty()
    {
        $id = '48f2918e-c52c-4e5e-b595-d26b83a578e8';
        $apiKey= 'oKhSR5nslBRnBZpjO6KuzZeX';

        $user = new SandboxUser($id, $apiKey);

        $this->expectException(\Exception::class);

        $value = $user->undefinedProperty;
    }
}
