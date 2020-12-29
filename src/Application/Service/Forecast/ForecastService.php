<?php


namespace App\Application\Service;


use App\Domain\Model\DailyForecast;

class ForecastService
{

    //private WeatherApiProvider $weatherApiProvider;

    public function __construct(
        WeatherApiProvider $weatherApiProvider
    ) {
        $this->weatherApiProvider = $weatherApiProvider;
    }

    public function getCityForecast(): DailyForecast
    {

    }
}