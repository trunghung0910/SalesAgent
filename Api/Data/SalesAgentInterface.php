<?php
namespace AHT\SalesAgent\Api\Data;

interface SalesAgentInterface
{
    const ENTITY_ID = 'entity_id';
    const ORDER_ID = 'order_id';
    const ORDER_ITEM_ID = 'order_item_id';
    const ORDER_ITEM_SKU = 'order_item_sku';
    const COMMISSION_TYPE = 'commission_type';
    const COMMISSION_VALUE = 'commission_value';

    /**
     * Get EntityId
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Get OrderId
     *
     * @return int|null
     */
    public function getOrderId();

    /**
     * Get OrderItemId
     *
     * @return int|null
     */
    public function getOrderItemId();

    /**
     * Get order item sku
     *
     * @return string|null
     */
    public function getOrderItemSku();

    /**
     * Get commission type
     *
     * @return int|null
     */
    public function getCommissionType();

    /**
     * Get commission value
     *
     * @return float|null
     */
    public function getCommissionValue();


    /**
     * Set ID
     *
     * @param int $entityId
     * @return SalesAgentInterface
     */
    public function setEntityId($entityId);

    /**
     * Set order id
     *
     * @param int $orderId
     * @return SalesAgentInterface
     */
    public function setOrderId($orderId);

    /**
     * Set order item id
     *
     * @param int $orderItemId
     * @return SalesAgentInterface
     */
    public function setOrderItemId($orderItemId);

    /**
     * Set order item sku
     *
     * @param string $orderItemSku
     * @return SalesAgentInterface
     */
    public function setOrderItemSku($orderItemSku);

    /**
     * Set commission type
     *
     * @param int $commissionType
     * @return SalesAgentInterface
     */
    public function setCommissionType($commissionType);

    /**
     * Set commission value
     *
     * @param float $commissionValue
     * @return SalesAgentInterface
     */
    public function setCommissionValue($commissionValue);
}
