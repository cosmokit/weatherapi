<?php


namespace App\Application\Manager;


use App\Infrastructure\ApiClient\MusementApi\MusementApiQueryInterface;
use App\Infrastructure\Domain\Model\Forecast\ApiForecastRepository;

/**
 * Class ImportCitiesFromMusementApiManager
 * @package App\Application\Manager
 */
final class ImportCitiesFromMusementApiManager
{


    /**
     * @var MusementApiQueryInterface
     */
    private $query;
    /**
     * @var ApiForecastRepository
     */
    private $forecastRepository;


    /**
     * ImportCitiesFromMusementApiManager constructor.
     */
    public function __construct(MusementApiQueryInterface $query, ApiForecastRepository $forecastRepository)
    {
        $this->query = $query;
        $this->forecastRepository = $forecastRepository;
    }

    /**
     *
     */
    public function __invoke() {
//        $cities = $this->query->getAllCities();
//
//        foreach($cities as $city) {
//            $forecast[] = $this->forecastRepository->fetchWeatherForCity($city);
//        }
//
//        var_dump($cities); die();
    }
}