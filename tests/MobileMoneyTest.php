<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\MobileMoney;
use Mediumart\MobileMoney\BaseClient;
use Mediumart\MobileMoney\Env\Factory;
use ReflectionClass;

class MobileMoneyTest extends TestCase
{
    public function testEnvFactoryIsSingleton():void
    {
        $factory = MobileMoney::sandbox();
        $this->assertInstanceOf(Factory::class, $factory);

        $factory2 = MobileMoney::sandbox();
        $this->assertSame($factory, $factory2);

        $factory = MobileMoney::live();
        $this->assertInstanceOf(Factory::class, $factory);

        $factory2 = MobileMoney::live();
        $this->assertSame($factory, $factory2);
    }

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
        $service1 = MobileMoney::sandbox()->{$name}();
        $this->assertInstanceOf(BaseClient::class, $service1);

        $service2 = MobileMoney::live()->{$name}();
        $this->assertInstanceOf(BaseClient::class, $service2);
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
    public function testCallStaticOfServiceWithLiveAsDefaultEnvironment($service):void
    {
        $service = MobileMoney::{$service}();
        $this->assertInstanceOf(BaseClient::class, $service);

        $this->assertEquals(
            'https://ericssondeveloperapi.portal.azure-api.net', 
            (new ReflectionClass($service))->getProperty('baseurl')->getValue($service)
        );
    }
}