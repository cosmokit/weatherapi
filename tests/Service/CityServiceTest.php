<?php


namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument\Token\AnyValuesToken;
use Prophecy\Argument\Token\IdenticalValueToken;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Console\Output\OutputInterface;

class CityServiceTest extends TestCase
{

    use ProphecyTrait;

    private ObjectProphecy $citiesApiMock;
    private ObjectProphecy $forecastApiMock;

    public function testProcessForecasts()
    {
        $cityService = $this->getCityServiceInstance();

        $city = new City();
        $city->setName("Test city");
        $this->citiesApiMock->getCities(
            new AnyValuesToken()
        )->willReturn([$city]);

        $forecast = $this->getMockedForecast();

        $outputMock = $this->prophesize(OutputInterface::class);
        $outputMock->writeln(
            new IdenticalValueToken("Sunny - Cloudy")
        )->shouldBeCalled();

        $cityService->processForecasts($outputMock->reveal());
    }
}