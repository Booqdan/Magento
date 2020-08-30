<?php


namespace AlbertGold\Weather\Model;


use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Json\DecoderInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\Stdlib\DateTime\DateTime;
use AlbertGold\Weather\Model\Weather;
use Psr\Log\LoggerInterface;

/**
 * Class ImportWeather
 * @package AlbertGold\Weather\Model
 */
class ImportWeather
{
    const WEATHER_API = 'http://api.openweathermap.org/data/2.5/weather';

    /**
     * @var DecoderInterface
     */
    protected $jsonDecoder;

    /**
     * @var Curl
     */
    protected $_curl;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var \AlbertGold\Weather\Model\Weather
     */
    protected $weather;

    /**
     * @param DecoderInterface $jsonDecoder
     * @param Curl $_curl
     * @param ScopeConfigInterface $scopeConfig
     * @param DateTime $date
     * @param Weather $weather
     */
    public function __construct(
        DecoderInterface $jsonDecoder,
        Curl $_curl,
        ScopeConfigInterface $scopeConfig,
        DateTime $date,
        Weather $weather,
        LoggerInterface $logger
    )
    {
        $this->jsonDecoder = $jsonDecoder;
        $this->_curl = $_curl;
        $this->scopeConfig = $scopeConfig;
        $this->date = $date;
        $this->weather = $weather;
        $this->logger = $logger;
    }

    /**
     * Create new weather status
     */
    public function importWeather()
    {
        $response = $this->getResponse();
        $weather = $this->jsonDecoder->decode($response);
        $this->saveCurrentWeatherValue($weather);
    }

    /**
     * Connect to api and get response
     * @return string
     */
    protected function getResponse()
    {
        $api = $this->scopeConfig->getValue('weather/general/api');
        $location = $this->scopeConfig->getValue('weather/general/location') ? $this->scopeConfig->getValue('weather/general/location') : 'Lublin';
        $uri = "?q=$location&appid=$api";
        $this->_curl->get(self::WEATHER_API . $uri);

        return $this->_curl->getBody();
    }

    /**
     * Save new (current) weather status to repo.
     * @param $data
     */
    protected function saveCurrentWeatherValue($data)
    {
        $temp = $this->calculateTemp((int)$data['main']['temp']);
        $tempFl = $this->calculateTemp((int)$data['main']['feels_like']);
        $time = $this->date->date();
        $location = $this->scopeConfig->getValue('weather/general/location') ? $this->scopeConfig->getValue('weather/general/location') : 'Lublin';
        try {
            $this->weather->setLocation($location);
            $this->weather->setTemp($temp);
            $this->weather->setTempFeelsLike($tempFl);
            $this->weather->setTime($time);
            $this->weather->save();
            die;
        } catch (\Exception $e) {
            $this->logger->critical('Problem with create new weather data: ' . $e->getMessage());
        }
    }

    /**
     * Calculate temperature | Kelvin to Celsius
     * @param $temp
     * @return float
     */
    protected function calculateTemp($temp)
    {
        return $temp - 273.15;
    }

}
