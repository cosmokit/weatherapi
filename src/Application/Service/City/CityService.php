<?php


namespace App\Application\Service\City;

use App\Domain\Model\City\CityName;
use App\Infrastructure\Domain\Model\City\ApiCityRepository;
use App\Infrastructure\Domain\Model\Forecast\ApiForecastRepository;

class CityService
{

    private $repository;
    /**
     * @var ApiForecastRepository
     */
    private $forecastRepository;

    public function __construct(ApiCityRepository $repository, ApiForecastRepository $forecastRepository)
    {
        $this->repository = $repository;
        $this->forecastRepository = $forecastRepository;
    }

    public function execute() {
        $cities = $this->repository->getCities();

        $forecast = [];

        foreach ($cities as $city) {
            $forecast[] = $this->forecastRepository->fetchWeatherForCity($city);
        }

        return $forecast;
    }
}