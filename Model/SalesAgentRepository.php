<?php
namespace AHT\SalesAgent\Model;

use AHT\SalesAgent\Api\SalesAgentRepositoryInterface;
use AHT\SalesAgent\Model\ResourceModel\Salesagent as ResourceSalesAgent;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

class SaleagentRepository implements SalesAgentRepositoryInterface
{

    protected $dataObjectProcessor;

    private $storeManager;

    protected $resource;
  
    protected $saleagentFactory;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'salesagent_repository';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        ResourceSalesAgent $resource,
        SalesAgentFactory $salesAgentFactory,
        StoreManagerInterface $storeManager,
		DataObjectProcessor $dataObjectProcessor,

        array $data = []
    ) {
		$this->salesagentFactory = $salesAgentFactory;
        $this->resource = $resource;
        $this->storeManager = $storeManager;
		$this->dataObjectProcessor = $dataObjectProcessor;
    }

    public function save(\AHT\SalesAgent\Api\Data\SalesagentInterface $salesAgent)
    {
        if ($salesAgent->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $salesAgent->setStoreId($storeId);
        }
        try {
            $this->resource->save($salesAgent);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the salesagent: %1', $exception->getMessage()),
                $exception
            );
        }
        return $salesAgent;
    }

    public function getById($salesAgentId)
    {
		$salesAgent = $this->salesagentFactory->create()->load($salesAgentId);
        if (!$salesAgent->getEntityId()) {
            throw new NoSuchEntityException(__('Salesagent with id "%1" does not exist.', $salesAgentId));
        }
        return $salesAgent;
    }
	
    public function delete(\AHT\SalesAgent\Api\Data\SalesagentInterface $salesAgent)
    {
        try {
            $this->resource->delete($salesAgent);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the salesagent: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($salesAgentId)
    {
        return $this->delete($this->getById($salesAgentId));
    }
}
