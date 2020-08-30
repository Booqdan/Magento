<?php


namespace AlbertGold\Weather\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Weather extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('albertgold_weather', 'entity_id');
    }
}
