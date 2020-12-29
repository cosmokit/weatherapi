<?php


namespace App\Infrastructure\Importer;


use App\Application\ForecastImporterInterface;
use App\Domain\Model\DailyForecast;

class WeatherApiImporter extends ForecastImporterInterface
{

    public function import(): DailyForecast
    {
        parent::import();
    }
}