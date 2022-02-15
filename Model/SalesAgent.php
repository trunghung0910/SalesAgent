<?php
namespace AHT\SalesAgent\Model;

use AHT\SalesAgent\Api\Data\SalesAgentInterface;

class SalesAgent extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, SalesAgentInterface
{
    const CACHE_TAG = 'aht_salesagent_sales_agent';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'sales_agent';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\SalesAgent\Model\ResourceModel\SalesAgent');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getEntityId() {
        return $this->getData(self::ENTITY_ID);
    }

    public function getOrderId() {
        return $this->getData(self::ORDER_ID);
    }

    public function getOrderItemId() {
        return $this->getData(self::ORDER_ITEM_ID);
    }

    public function getOrderItemSku()
    {
        return $this->getData(self::ORDER_ITEM_SKU);
    }

    public function getCommissionType()
    {
        return $this->getData(self::COMMISSION_TYPE);
    }

    public function getCommissionValue()
    {
        return $this->getData(self::COMMISSION_VALUE);
    }

    public function setEntityId($entityId) {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function setOrderId($orderId) {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    public function setOrderItemId($orderItemId) {
        return $this->setData(self::ORDER_ITEM_ID, $orderItemId);
    }

    public function setOrderItemSku($orderItemSku) {
        return $this->setData(self::ORDER_ITEM_SKU, $orderItemSku);
    }

    public function setCommissionType($commissionType)
    {
        return $this->setData(self::COMMISSION_TYPE, $commissionType);
    }

    public function setCommissionValue($commissionValue)
    {
        return $this->setData(self::COMMISSION_VALUE, $commissionValue);
    }

}
