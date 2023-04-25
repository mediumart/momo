<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\BaseClient;

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
            $service1->getBaseurl()
        );

        $service2 = MobileMoney::{$name}();
        $this->assertInstanceOf(BaseClient::class, $service2);

        $this->assertEquals(
            'https://ericssondeveloperapi.portal.azure-api.net/'.$name, 
            $service2->getBaseurl()
        );
    }

    public function testSetAndGetCurrentEnvironmentGlobally()
    {
        MobileMoney::setCurrentEnvironment('sandbox');
        $this->assertEquals('sandbox', MobileMoney::getCurrentEnvironment());

        MobileMoney::setCurrentEnvironment('live');
        $this->assertEquals('live', MobileMoney::getCurrentEnvironment());
    }

    public function testUnknownServices():void
    {
        $this->expectException(\Exception::class);
        MobileMoney::unknown('sandbox');

        $this->expectException(\Exception::class);
        MobileMoney::unknown();
    }
}
