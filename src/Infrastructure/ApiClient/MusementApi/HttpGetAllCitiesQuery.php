<?php


namespace App\Infrastructure\ApiClient\MusementApi;


use App\Domain\Model\City\City;
use App\Domain\Model\City\CityName;
use App\Domain\Model\City\Location;
use App\Infrastructure\Http\HttpQueryClientInterface;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpGetAllCitiesQuery
 * @package App\Infrastructure\ApiClient\MusementApi
 */
class HttpGetAllCitiesQuery implements MusementApiQueryInterface
{
    const REQUEST_URI = "https://api.musement.com/api/v3/cities";
    const RESPONSE_FORMAT = 'json';

    /**
     * @var HttpQueryClientInterface
     */
    private $client;

    public function __construct(HttpQueryClientInterface $client )
    {
        $this->client = $client;
    }

    public function getAllCities()
    {
        return $this->client->query(self::REQUEST_URI);
    }

}