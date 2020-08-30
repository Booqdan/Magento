<?php
namespace AlbertGold\Weather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface WeatherSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return WeatherInterface[]
     */
    public function getItems();

    /**
     * @param WeatherInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
