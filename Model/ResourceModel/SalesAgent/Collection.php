<?php
namespace AHT\SalesAgent\Model\ResourceModel\SalesAgent;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'aht_salesagent_sales_agent_collection';
	protected $_eventObject = 'sales_agent_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\SalesAgent\Model\SalesAgent', 'AHT\SalesAgent\Model\ResourceModel\SalesAgent');
    }
}
