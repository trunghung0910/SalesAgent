<?php

namespace AHT\SalesAgent\Observer;

use Magento\Framework\Event\Observer;

class SalesAgent implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \AHT\SalesAgent\Model\SalesAgentFactory
     */
    private $_salesAgentFactory;

    public function __construct(
        \AHT\SalesAgent\Model\SalesAgentFactory $salesAgentFactory
    ) {
        $this->_salesAgentFactory = $salesAgentFactory;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getData('order');

        $orderItems = $order->getItemsCollection();

        foreach ($orderItems as $orderItem) {
            $saleAgentsId = $orderItem->getProduct()->getSaleAgentId();

            if (($saleAgentsId != '') && ($saleAgentsId != null)) {
                $salesAgent = $this->_salesAgentFactory->create();
                $salesAgent->setOrderId($order->getId()); 
                $salesAgent->setOrderItemId($orderItem->getItemId()); 
                $salesAgent->setOrderItemSku($orderItem->getSku()); 
                $salesAgent->setCommissionType($orderItem->getProduct()->getCommissionType()); 
                $salesAgent->setCommissionValue($orderItem->getProduct()->getCommissionValue()); 

                $salesAgent->save();
            }            
        }
    }
}
