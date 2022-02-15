<?php
namespace AHT\SalesAgent\Model\Source;
use Magento\customer\Model\ResourceModel\Customer\CollectionFactory;

class SalesAgent extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{
    private $_collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory; 
    }

    public function getAllOptions() {
        $collection = $this->_collectionFactory->create()->addAttributeToFilter('is_sales_agent', 1);
        
        $data = [];
        $data[] = ['label' => 'Select Sales Agent', 'value' => ''];
        foreach ($collection as $item) {
            $data[] = ['label' => $item->getFirstname(). ' ' .$item->getLastname(), 'value' => $item->getEntity_id()];
        }
        if ($this->_options === null) {
            $this->_options = $data;      
        }
        
        return $this->_options;
        
    }
}