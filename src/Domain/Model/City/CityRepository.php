<?php


namespace App\Domain\Model\City;


use App\Domain\Model\CityName;

interface CityRepository
{
    public function getCities();
}