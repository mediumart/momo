<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\MobileMoney;

class MobileMoneyTest extends TestCase
{
    public function testEnvFactoryIsSingleton():void
    {
        $factory = MobileMoney::sandbox();
        $factory2 = MobileMoney::sandbox();
        $this->assertSame($factory, $factory2);

        $factory = MobileMoney::live();
        $factory2 = MobileMoney::live();
        $this->assertSame($factory, $factory2);
    }

    public function servicesNames():array
    {
        return [
            ['collection'],
            ['disbursement'],
            ['remittance'],
            ['widget']
        ];
    }

    /**
     * @dataProvider servicesNames
     */
    public function testCreatingLiveAndSandboxServicesClients(string $name):void
    {
        $service1 = MobileMoney::sandbox()->{$name}();
        $this->assertNotNull($service1);

        $service2 = MobileMoney::live()->{$name}();
        $this->assertNotNull($service2);
    }

    public function testUnknownSandboxServices():void
    {
        $this->expectException(\Exception::class);
        MobileMoney::sandbox()->unknown();
    }

    public function testUnknownLiveServices():void
    {
        $this->expectException(\Exception::class);
        MobileMoney::live()->unknown();
    }

    /**
     * @dataProvider servicesNames
     */
    public function testServicesCalledStaticWithLiveAsDefaultEnvironment($service):void
    {
        $service = MobileMoney::{$service}();
        $this->assertNotNull($service);
    }
}