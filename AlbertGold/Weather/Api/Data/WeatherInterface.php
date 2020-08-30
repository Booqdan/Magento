<?php


namespace AlbertGold\Weather\Api\Data;


/**
 * Interface WeatherInterface
 * @package AlbertGold\Weather\Api\Data
 */
interface WeatherInterface
{
    const ENTITY_ID       = 'entity_id';
    const TIME            = 'time';
    const LOCATION        = 'location';
    const TEMP            = 'temp';
    const TEMP_FEELS_LIKE = 'temp_feels_like';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return int|null
     */
    public function getTime();

    /**
     * @return int|null
     */
    public function getLocation();

    /**
     * @return string|null
     */
    public function getTemp();

    /**
     * @return string|null
     */
    public function getTempFeelsLike();

    /**
     * @param $time
     * @return mixed
     */
    public function setTime($time);

    /**
     * @param $location
     * @return mixed
     */
    public function setLocation($location);

    /**
     * @param $temp
     * @return mixed
     */
    public function setTemp($temp);

    /**
     * @param $tempFeelsLike
     * @return mixed
     */
    public function setTempFeelsLike($tempFeelsLike);

}
