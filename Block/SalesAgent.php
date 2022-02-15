<?php

namespace AHT\SalesAgent\Block;

class SalesAgent extends \Magento\Framework\View\Element\Template
{

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Product
     */
    private $_productCollectionFactory;

    /**
     * @param \Magento\Customer\Model\Session
     */
    private $_customerSession;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Customer\Model\SessionFactory $customerSession,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        // get param values
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records

        // get product collection
        
        $customerId = $this->_customerSession->create()->getCustomerId();

        $productCollection = $this->_productCollectionFactory->create()->addAttributeToFilter('sale_agent_id', $customerId)
            ->addAttributeToSelect('*');

        $productCollection->setPageSize($pageSize);
        $productCollection->setCurPage($page);

        return $productCollection;
    }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Sales Agent'));
        parent::_prepareLayout();
        $page_data = $this->getProductCollection();
        if ($this->getProductCollection()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'salesagent.pager.name'
            )
                ->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)
                ->setCollection($page_data);
            $this->setChild('pager', $pager);
            $this->getProductCollection()->load();
        }
        return $this;
    }


    /**
     * Get Pager child block output
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}
