<?php


namespace App\Domain\Model\City;

use App\Domain\Model\Forecast\Forecast;


/**
 * Class City
 * @package App\Domain\Model\City
 */
class City
{

    /**
     * @var CityName
     */
    private $cityName;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var array
     */
    private $forecast;
    /**
     * City constructor.
     * @param CityName $cityName
     * @param Location $location
     */

    public static function fromApiResponse(object $response): City {
        return new self(
            new CityName($response->name),
            new Location($response->latitude, $response->longitude)
        );
    }

    public function __construct(CityName $cityName, Location $location)
    {
        $this->cityName = $cityName;
        $this->location = $location;
        $this->forecast = [];
    }

    public function getForecast() {
        //$this->forecast = new Forecast($city);

        return $this->forecast;
    }

    public function getName() {
        return $this->cityName->getName();
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }
}