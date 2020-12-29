<?php


namespace App\Domain\Model\City;

use App\Domain\ValueObjectInterface;

/**
 * Class CityName
 * @package App\Domain\Model\City
 */
class CityName
{
    /**
     * @var String
     */
    private $name;

    /**
     * CityName constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }
}