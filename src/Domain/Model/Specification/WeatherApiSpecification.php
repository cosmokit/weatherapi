<?php


namespace App\Domain\Model\Specification;


use App\Domain\Model\City\City;

interface WeatherApiSpecification
{
    public function fetchWeatherForCity(City $city);
}