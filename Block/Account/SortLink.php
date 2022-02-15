<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\SalesAgent\Block\Account;

use Magento\Framework\App\DefaultPathInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class for sortable links.
 */
class SortLink extends \Magento\Framework\View\Element\Html\Link\Current implements SortLinkInterface
{
    /**
     * @param \Magento\Customer\Model\SessionFactory
     */
    private $_customerSessionFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param DefaultPathInterface $defaultPath
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        Context $context,
        DefaultPathInterface $defaultPath,
        array $data = []
    ) {
        parent::__construct($context, $defaultPath, $data);
        $this->_customerSessionFactory = $customerSessionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    protected function _toHtml()
    {

        $isSalesAgent = $this->_customerSessionFactory->create()->getCustomer()->getData('is_sales_agent');
        
        $html = parent::_toHtml();
        if ($isSalesAgent == 1) {
            return $html; 
        } else {
            return '';
        }
        

    }
}
