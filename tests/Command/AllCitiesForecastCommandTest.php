<?php

namespace App\Tests\Command;

use App\Application\Service\City\CityService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Prophecy\PhpUnit\ProphecyTrait;


class AllCitiesForecastCommandTest extends KernelTestCase
{

    use ProphecyTrait;

    private ObjectProphecy $cityServiceMock;

    public function testSuccess()
    {
        $command = $this->getCommand();

        $this->cityServiceMock->processForecasts(
            new AnyValuesToken()
        )->shouldBeCalled();

        $command->execute([]);
    }

    private function getCommand(): CommandTester
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $this->cityServiceMock = $this->prophesize(CityService::class);

        $kernel->getContainer()->set("App\Application\Service\City\CityService", $this->cityServiceMock->reveal());
        $application = new Application($kernel);

        $command = $application->find("app:all-cities-forecast");
        $commandTester = new CommandTester($command);

        return $commandTester;
    }


}