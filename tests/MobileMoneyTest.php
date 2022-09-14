<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\BaseClient;
use ReflectionClass;

class MobileMoneyTest extends TestCase
{
    public function servicesNames():array
    {
        return [
            ['collection'],
            ['disbursement'],
            ['remittance']
        ];
    }

    /**
     * @dataProvider servicesNames
     */
    public function testCreatingLiveAndSandboxServicesClients(string $name):void
    {
        $service1 = MobileMoney::{$name}('sandbox');
        $this->assertInstanceOf(BaseClient::class, $service1);

        $this->assertEquals(
            'https://sandbox.momodeveloper.mtn.com/'.$name, 
            (new ReflectionClass($service1))->getProperty('baseurl')->getValue($service1)
        );

        $service2 = MobileMoney::{$name}();
        $this->assertInstanceOf(BaseClient::class, $service2);

        $this->assertEquals(
            'https://ericssondeveloperapi.portal.azure-api.net/'.$name, 
            (new ReflectionClass($service2))->getProperty('baseurl')->getValue($service2)
        );
    }

    public function testUnknownSandboxServices():void
    {
        $this->expectException(\Exception::class);
        MobileMoney::unknown();
    }
}
