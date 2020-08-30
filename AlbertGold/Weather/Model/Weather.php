<?php


namespace AlbertGold\Weather\Model;

use AlbertGold\Weather\Api\Data\WeatherInterface;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractModel;

class Weather extends AbstractModel implements IdentityInterface, WeatherInterface
{
    const CACHE_TAG = 'albertgold_weather_weather';

    protected $_cacheTag = 'albertgold_weather_weather';

    protected $_eventPrefix = 'albertgold_weather_weather';

    protected function _construct()
    {
        $this->_init('AlbertGold\Weather\Model\ResourceModel\Weather');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array|int|mixed|null
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @return array|int|mixed|null
     */
    public function getTime()
    {
        return parent::getData(self::TIME);
    }

    /**
     * @return array|int|mixed|null
     */
    public function getLocation()
    {
        return parent::getData(self::LOCATION);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getTemp()
    {
        return parent::getData(self::TEMP);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getTempFeelsLike()
    {
        return parent::getData(self::TEMP_FEELS_LIKE);
    }

    /**
     * @param $time
     * @return Weather|mixed
     */
    public function setTime($time)
    {
        return $this->setData(self::TIME, $time);
    }

    /**
     * @param $location
     * @return Weather|mixed
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * @param $temp
     * @return Weather|mixed
     */
    public function setTemp($temp)
    {
        return $this->setData(self::TEMP, $temp);
    }

    /**
     * @param $temp
     * @return Weather|mixed
     */
    public function setTempFeelsLike($temp)
    {
        return $this->setData(self::TEMP_FEELS_LIKE, $temp);
    }
}
