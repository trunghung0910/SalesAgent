<?php
namespace AHT\SalesAgent\Block\Html;

class Header extends \Magento\Theme\Block\Html\Header
{
    /**
     * Current template name
     *
     * @var string
     */
    protected $_template = 'AHT_SalesAgent::html/header.phtml';

    /**
     * @param \Magento\Customer\Model\SessionFactory
     */
    private $customerSessionFactory;

    public function __construct(
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
        
    )
    {
        parent::__construct($context, $data);
        $this->customerSessionFactory = $customerSessionFactory;
        
    }


    public function checkSaleAgent()
    {
        $customerSession = $this->customerSessionFactory->create();
        $customer = $customerSession->getCustomer();

        $isSaleAgent = $customer->getData('is_sales_agent');
        
        return $isSaleAgent;

    }
}
