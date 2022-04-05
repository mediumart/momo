<?php
namespace Mediumart\MobileMoney\Tests;

use Mediumart\MobileMoney\MobileMoney;

class MomoTest extends TestCase
{
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
}