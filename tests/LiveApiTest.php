<?php
namespace Mediumart\Momo\Tests;

use Mediumart\Momo\Sandbox\UsersProvisioning;

class LiveApiTest extends TestCase
{
    public function testUserProvisioningForSandboxUser():void
    {
        // $this->assertNull(UsersProvisioning::sandboxUserFor('disbursements'));

        $this->assertNull(UsersProvisioning::sandboxUserFor('remittances'));

        // $this->assertNotNull(UsersProvisioning::sandboxUserFor('collection'));
    } 
}