<?php


namespace AlbertGold\Weather\Model;

use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use AlbertGold\Weather\Api\Data\WeatherSearchResultsInterfaceFactory;
use AlbertGold\Weather\Api\WeatherRepositoryInterface;
use AlbertGold\Weather\Api\Data\WeatherInterface;
use AlbertGold\Weather\Model\WeatherFactory;
use AlbertGold\Weather\Model\ResourceModel\Weather as ResourceWeather;

class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var ResourceWeather
     */
    protected $resourceWeather;

    /**
     * @var WeatherFactory
     */
    protected $weatherFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var WeatherSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @param ResourceWeather $resourceWeather
     * @param WeatherFactory $weatherFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param WeatherSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceWeather $resourceWeather,
        WeatherFactory $weatherFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        WeatherSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resourceWeather = $resourceWeather;
        $this->weatherFactory = $weatherFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Delete weather option
     *
     * @param WeatherInterface $option
     * @return boolean
     * @throws CouldNotDeleteException
     */
    public function delete(WeatherInterface $option)
    {
        try {
            $this->resourceWeather->delete($option);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete weather info: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * Get weather option by ID
     *
     * @param int $id
     * @return Weather
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $option = $this->weatherFactory->create();
        $option->load($id);
        if (!$option->getId()) {
            throw new NoSuchEntityException(__('Weather with ID "%1" does not exist.', $id));
        }
        return $option;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return WeatherSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Save Weather option
     *
     * @param WeatherInterface $option
     * @return WeatherInterface
     * @throws CouldNotSaveException
     */
    public function save(WeatherInterface $option)
    {
        try {
            $this->resourceWeather->save($option);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save weather: %1', $exception->getMessage()),
                $exception
            );
        }
        return $option;
    }
}
