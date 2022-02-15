<?php
namespace AHT\SalesAgent\Api;

interface SalesAgentRepositoryInterface
{
    /**
     * Save SalesAgent.
     *
     * @param \AHT\SalesAgent\Api\Data\SalesAgentInterface $SalesAgent
     * @return \AHT\SalesAgent\Api\Data\SalesAgentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AHT\SalesAgent\Api\Data\SalesAgentInterface $SalesAgent);

    /**
     * Retrieve SalesAgent.
     *
     * @param int $SalesAgentId
     * @return \AHT\SalesAgent\Api\Data\SalesAgentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($SalesAgentId);

    /**
     * Retrieve SalesAgents matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AHT\Blog\Api\Data\SalesAgentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    // public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete SalesAgent.
     *
     * @param \AHT\SalesAgent\Api\Data\SalesAgentInterface $SalesAgent
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\AHT\SalesAgent\Api\Data\SalesAgentInterface $SalesAgent);

    /**
     * Delete SalesAgent by ID.
     *
     * @param int $SalesAgentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($SalesAgentId);
}
