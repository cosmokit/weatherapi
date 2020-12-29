<?php


namespace App\Application;


use App\Domain\Model\DailyForecast;

class ForecastImporterInterface
{
    public function import(): DailyForecast
    {

    }
}