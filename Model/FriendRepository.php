<?php

namespace Course\Backend\Model;

use Course\Backend\Api\FriendRepositoryInterface;
use Course\Backend\Model\ResourceModel\Collection\FriendsFactory as FriendsCollectionFactory;
use Course\Backend\Model\ResourceModel\Friend as FriendResourceModel;
use Exception;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class FriendRepository implements FriendRepositoryInterface
{
    protected FriendFactory $friendFactory;
    protected FriendResourceModel $friendResourceModel;
    protected FriendsCollectionFactory $friendsCollectionFactory;
    protected CollectionProcessorInterface $collectionProcessor;
    protected SearchResultsInterfaceFactory $searchResultsInterfaceFactory;

    public function __construct(
        FriendFactory $friendFactory,
        FriendResourceModel $friendResourceModel,
        FriendsCollectionFactory $friendsCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory
    ) {
        $this->friendFactory = $friendFactory;
        $this->friendResourceModel = $friendResourceModel;
        $this->friendsCollectionFactory = $friendsCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
    }

    /**
     * @inheritDoc
     */
    public function save($model)
    {
        try {
            return $this->friendResourceModel->save($model);
        } catch (AlreadyExistsException $e) {
            throw new AlreadyExistsException(__($e->getMessage()));
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($model): bool
    {
        try {
            $this->friendResourceModel->delete($model);
            return true;
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id): bool
    {
        try {
            $this->friendResourceModel->delete($this->getById($id));
            return true;
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id)
    {
        try {
            $model = $this->friendFactory->create();
            $this->friendResourceModel->load($model, $id);

            return $model;
        } catch (Exception $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        }
    }

    /**
     * @inheritDoc
     */
    public function getBySearchCriteria(SearchCriteria $searchCriteria): SearchResultsInterface
    {
        $collection = $this->friendsCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsInterfaceFactory->create();

        $searchResult
            ->setSearchCriteria($searchCriteria)
            ->setTotalCount($collection->getSize())
            ->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $collection = $this->friendsCollectionFactory->create();

        return $collection->getItems();
    }

    /**
     * @inheritDoc
     */
    public function getEmptyModel(): Friend
    {
        return $this->friendFactory->create();
    }
}
