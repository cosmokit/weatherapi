<?php


namespace App\Domain\Model\Forecast;


use App\Domain\Model\City\CityName;

interface ForecastRepository
{
    public function ofCity(CityName $cityName);
}