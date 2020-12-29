<?php


namespace App\Domain\Model\City;


use App\Domain\ValueObjectInterface;

class Location implements ValueObjectInterface
{
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;

    /**
     * Location constructor.
     * @param $latitude
     * @param $longitude
     */
    public function __construct($latitude, $longitude)
    {
        if (!$this->isValidLatitude($latitude)) {
            throw new \InvalidArgumentException('latitude is not valid');
        }

        if (!$this->isValidLongitude($longitude)) {
            throw new \InvalidArgumentException('longitude is not valid');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    private function isValidLatitude($latitude)
    {
        return preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $latitude);
    }

    private function isValidLongitude($longitude)
    {
        return preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/", $longitude);
    }
}