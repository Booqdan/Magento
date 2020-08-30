<?php


namespace AlbertGold\Weather\Cron;

use AlbertGold\Weather\Model\ImportWeather as ImportWeatherModel;
use Psr\Log\LoggerInterface;

/**
 * Class ImportWeather
 * @package AlbertGold\Weather\Cron
 */
class ImportWeather
{
    /**
     * @var ImportWeatherModel
     */
    protected $weatherModel;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ImportWeather constructor.
     * @param ImportWeatherModel $weatherModel
     * @param LoggerInterface $logger
     */
    public function __construct(
        ImportWeatherModel $weatherModel,
        LoggerInterface $logger
    )
    {
        $this->weatherModel = $weatherModel;
        $this->logger = $logger;
    }

    /**
     * Import Current Weather with API
     */
    public function execute()
    {
        try {
            $this->weatherModel->importWeather();
        } catch (\Exception $e) {
            $this->logger->critical('albertgold_weather_cron faild with message: ' . $e->getMessage());
        }
    }
}
