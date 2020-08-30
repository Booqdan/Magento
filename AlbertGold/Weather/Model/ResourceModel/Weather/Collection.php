<?php

namespace AlbertGold\Weather\Model\ResourceModel\Weather;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \AlbertGold\Weather\Model\Weather;
use \AlbertGold\Weather\Model\ResourceModel\Weather as WeatherResource;

class Collection extends AbstractCollection
{
    protected $_eventPrefix = 'albertgold_weather_weather';
    protected $_eventObject = 'collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Weather::class, WeatherResource::class);
    }
}
