<?php
 
namespace AHT\SalesAgent\Model\ResourceModel\SalesAgent\Grid; 

use Magento\Framework\Api;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;
 
class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{   
    protected $_eavAttribute;

    /**
     * @var string
     */
    private $identifierName;

    /**
     * SearchResult constructor.
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param null|string $resourceModel
     * @param null|string $identifierName
     * @param null|string $connectionName
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        $resourceModel = null,
        $identifierName = null,
        $connectionName = null,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute
    ) {
        $this->_eavAttribute = $eavAttribute;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel,
            $identifierName,
            $connectionName
        );
        
    }

    public function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->join(
            ['order_item' => $this->getTable('sales_order_item')],
            'main_table.order_item_id = order_item.item_id',
            ['order_item.sku','order_item.name', 'ordered_qty' => 'SUM(order_item.qty_ordered)', 'order_item.base_price', 'sa_commission_value' => 'main_table.commission_value', 'sa_commission_type' => 'main_table.commission_type']
        )->join(
            ['order' => $this->getTable('sales_order')],
            'main_table.order_id = order.entity_id',
            ['order.status']
        )->join(
            ['catalog_product_entity_text' => $this->getTable('catalog_product_entity_text')],
            'order_item.product_id = catalog_product_entity_text.entity_id and catalog_product_entity_text.attribute_id = ' . $this->getAttrIdByCode('sale_agent_id'),
            ['catalog_product_entity_text.value']
        )->join(
            ['customer' => $this->getTable('customer_entity')],
            'catalog_product_entity_text.value = customer.entity_id',
            ['saleagent_name' => 'customer.lastname']
        )
        ->group(
            'order_item.sku'
        );


        
        
        // echo "<pre>";
        // print_r($this->getData());
        // die();
        // return $this;
    }

    private function getAttrIdByCode($id, $entity = 'catalog_product')
    {
        return $this->_eavAttribute->getIdByCode($entity , $id);
    }

}