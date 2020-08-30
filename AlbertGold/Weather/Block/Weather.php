<?php

namespace AlbertGold\Weather\Block;

use \Magento\Framework\View\Element\Template;
use AlbertGold\Weather\Model\Weather as WeatherModel;

/**
 * Class Weather
 * @package AlbertGold\Weather\Block
 */
class Weather extends Template
{
    /**
     * @var WeatherModel
     */
    protected $weather;

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
     * Weather constructor.
     * @param Template\Context $context
     * @param WeatherModel $weather
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        WeatherModel $weather,
        array $data = []
    )
    {
        $this->weather = $weather;
        parent::__construct($context, $data);
    }

    /**
     * Return last weather status
     * @return \Magento\Framework\DataObject
     */
    public function getCurrentWeather()
    {
        return $this->getWeatherModel();
    }

    /**
     * Get last weather row from weather collection
     * @return \Magento\Framework\DataObject
     */
    protected function getWeatherModel()
    {
        return $this->weather->getCollection()
            ->setOrder('entity_id', 'DESC')
            ->setPageSize('1')
            ->getLastItem();
    }
}
