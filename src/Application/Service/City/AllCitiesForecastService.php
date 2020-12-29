<?php


namespace App\Application\Service\City;


use App\Domain\Model\City\CityRepository;
use App\Domain\Model\Forecast\ForecastRepository;

class AllCitiesForecastService
{
    /**
     * @var CityRepository
     */
    private $cityRepository;
    /**
     * @var ForecastRepository
     */
    private $forecastRepository;


    /**
     * AllCitiesForecastService constructor.
     * @param CityRepository $cityRepository
     * @param ForecastRepository $forecastRepository
     */
    public function __construct(CityRepository $cityRepository, ForecastRepository $forecastRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->forecastRepository = $forecastRepository;
    }

    public function execute() {
        $cities = $this->cityRepository->getCities();
    }
}