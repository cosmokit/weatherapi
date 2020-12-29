<?php

namespace App\Presentation\Cli;

use App\Application\Manager\ImportCitiesFromMusementApiManager;
use App\Application\Service\City\AllCitiesForecastService;
use App\Application\Service\City\CityService;
use App\Infrastructure\Domain\Model\City\MusementApiCityRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AllCitiesForecastCommand extends Command
{
    protected static $defaultName = 'app:all-cities-forecast';
    private $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Get weather for each city  for next 2 days')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $forecast = $this->cityService->execute();

        $io->title('Lorem Ipsum Dolor Sit Amet');

        foreach($forecast as $key => $val) {
            $io->info('| '.$val['City']. " | Today - ". $val['Today'] . " | Tomorrow - " . $val['Tomorrow']);
        }

        return 0;
    }
}
