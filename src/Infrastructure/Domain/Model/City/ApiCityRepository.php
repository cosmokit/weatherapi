<?php


namespace App\Infrastructure\Domain\Model\City;

use App\Domain\Model\City\CityRepository;

use App\Infrastructure\Http\HttpQueryClientInterface;

class ApiCityRepository implements CityRepository
{
    const REQUEST_URI = "https://api.musement.com/api/v3/cities";

    private $client;
    public function __construct(HttpQueryClientInterface $client)
    {
        $this->client = $client;
    }

    public function getCities()
    {
        $response = $this->client->query(self::REQUEST_URI);

        $cities = json_decode($response->getBody());

        return $cities;
    }
}