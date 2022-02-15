<?php
namespace AHT\SalesAgent\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;


class Commission extends Column
{
    protected $_storeManager;
    protected $_currency;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Directory\Model\Currency $currency
    ) {
        $this->_storeManager = $storeManager;
        $this->_currency = $currency;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource($dataSource)
    {   
        $currencyCode = $this->getCurrentCurrencyCode();
        $basePurchaseCurrency = $this->_currency->load($currencyCode);

        foreach ($dataSource['data']['items'] as $key => $item) {
            if ($item['sa_commission_type'] == 1) {
                $dataSource['data']['items'][$key]['sa_commission_type'] = '<span class="grid-severity-notice"><span>' . 'Fixel' . '</span></span>';
                $dataSource['data']['items'][$key]['sa_commission_value'] = $basePurchaseCurrency
                ->format($item['sa_commission_value'], [], false);
                $dataSource['data']['items'][$key]['result_commission'] = $basePurchaseCurrency
                ->format(($item['sa_commission_value']*$item['ordered_qty']), [], false);;
                $dataSource['data']['items'][$key]['base_price'] = $basePurchaseCurrency
                ->format($item['base_price'], [], false);;

                
            } else if ($item['sa_commission_type'] == 2) {
                $dataSource['data']['items'][$key]['sa_commission_type'] = '<span class="grid-severity-minor"><span>' . 'Percel' . '</span></span>';
                $dataSource['data']['items'][$key]['sa_commission_value'] = $dataSource['data']['items'][$key]['sa_commission_value']. '%';
                $dataSource['data']['items'][$key]['result_commission'] = $basePurchaseCurrency
                ->format((($item['base_price']*$item['ordered_qty']*$item['sa_commission_value'])/100), [], false);
                $dataSource['data']['items'][$key]['base_price'] = $basePurchaseCurrency
                ->format($item['base_price'], [], false);;
            }
        }

        // echo "<pre>";
        // print_r($dataSource);die;
        return $dataSource;
        
    }

    private function getCurrentCurrencyCode()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }  
}
