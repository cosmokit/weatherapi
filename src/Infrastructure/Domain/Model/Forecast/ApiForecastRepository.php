<?php

namespace App\Infrastructure\Domain\Model\Forecast;
use App\Domain\Model\City\City;
use App\Domain\Model\City\CityName;
use App\Domain\Model\Forecast\ForecastRepository;
use App\Domain\Model\Specification\WeatherApiSpecification;
use App\Infrastructure\Http\HttpQueryClientInterface;
use http\QueryString;

class ApiForecastRepository implements WeatherApiSpecification
{
    const REQUEST_URI = "http://api.weatherapi.com/v1/forecast.json?";
    const API_KEY     = 'c8c8d6f44b6a4c74b3b95838202412';

    /**
     * @var HttpQueryClientInterface
     */
    private $client;

    public function __construct(HttpQueryClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchWeatherForCity($city)
    {
        $params = [
            'key'   => self::API_KEY,
            'q'     => utf8_encode($city->latitude . "," . $city->longitude),
            'days'  => 2
        ];

        $url = self::REQUEST_URI . http_build_query($params);

        $response = $this->client->query($url);
        $result = json_decode($response->getBody());

        $tomorrow = date("Y-m-d", strtotime('tomorrow'));

        $forecast = [
            'City'      => $result->location->name,
            'Today'     => $result->forecast->forecastday[0]->day->condition->text,
            'Tomorrow'  => $result->forecast->forecastday[1]->day->condition->text

        ];

        return $forecast;
    }
}