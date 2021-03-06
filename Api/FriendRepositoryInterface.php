<?php

namespace Course\Backend\Api;

use Course\Backend\Api\Data\FriendInterface;
use Course\Backend\Model\Friend;
use Exception;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

interface FriendRepositoryInterface
{
    /**
     * @param FriendInterface|Friend $model
     * @throws AlreadyExistsException
     * @throws Exception
     * @return FriendInterface|Friend
     */
    public function save($model);

    /**
     * @param FriendInterface|Friend $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model): bool;

    /**
     * @param integer $id
     * @return true
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): bool;

    /**
     * @param integer $id
     * @throws NoSuchEntityException
     * @return FriendInterface|Friend
     */
    public function getById(int $id);

    /**
     * @param SearchCriteria $searchCriteria
     * @return SearchResultsInterface
     */
    public function getBySearchCriteria(SearchCriteria $searchCriteria): SearchResultsInterface;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @return Friend
     */
    public function getEmptyModel(): Friend;
}
