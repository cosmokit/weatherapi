<?php


namespace App\Domain\Model\Forecast;


use App\Domain\Model\City\City;

/**
 * Class CityForecast
 * @package App\Domain\Model
 */
class Forecast
{
    /**
     * @var City
     */
    protected $city;

    /**
     * CityForecast constructor.
     * @param $city
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

}