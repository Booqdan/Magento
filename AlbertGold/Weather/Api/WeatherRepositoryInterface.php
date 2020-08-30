<?php


namespace AlbertGold\Weather\Api;

use AlbertGold\Weather\Api\Data\WeatherInterface;
use AlbertGold\Weather\Api\Data\WeatherSearchResultsInterface;
use AlbertGold\Weather\Model\Weather;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface WeatherRepositoryInterface
{
    /**
     * @param int $id
     * @return Weather
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return WeatherSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param WeatherInterface $weather
     * @return WeatherInterface
     */
    public function save(WeatherInterface $weather);

    /**
     * @param WeatherInterface $weather
     * @return void
     */
    public function delete(WeatherInterface $weather);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);
}
