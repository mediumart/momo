<?php
namespace Mediumart\Momo\Tests;

use Mediumart\Momo\Sandbox\UsersProvisioning;

class LiveApiTest extends TestCase
{
    public function testUserProvisioningSandbox():void
    {
        $this->assertNotNull(
            $user = UsersProvisioning::sandboxUserFor('0ce2ea5d5c98474f94034146fe69d3be')
        );

        var_dump($user);
    } 
}