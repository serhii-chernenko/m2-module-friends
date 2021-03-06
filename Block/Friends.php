<?php

namespace Course\Backend\Block;

use Course\Backend\Api\Data\FriendInterface;
use Course\Backend\Api\FriendRepositoryInterface;
use Course\Backend\Model\FriendRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Exception;

class Friends extends Template
{
    protected $_template = 'Course_Backend::friends.phtml';
    protected array $data = [];

    /**
     * @var FriendRepositoryInterface|FriendRepository
     */
    protected $friendsRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * Friends constructor.
     * @param FriendRepositoryInterface $friendsRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param $data
     */
    public function __construct(
        FriendRepositoryInterface $friendsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context,
        $data
    ) {
        $this->friendsRepository = $friendsRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @param string $name
     * @param string|integer $age
     * @param string|null $notes
     * @throws AlreadyExistsException
     * @throws Exception
     */
    public function saveNewFriend(string $name, $age, ?string $notes)
    {
        $model = $this->friendsRepository->getEmptyModel();

        $model->setName($name)
            ->setAge($age)
            ->setNotes($notes);

        try {
            $this->friendsRepository->save($model);
        } catch (AlreadyExistsException $e) {
            throw new AlreadyExistsException(__($e->getMessage()));
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return array
     */
    public function getFriends(): array
    {
        return $this->friendsRepository->getAll();
    }

    /**
     * @param integer $id
     * @return SearchResultsInterface
     */
    public function getFriend(int $id): SearchResultsInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter(
            FriendInterface::FIELD_ID,
            $id
        )->create();

        return $this->friendsRepository->getBySearchCriteria($searchCriteria);
    }

    /**
     * @param $id
     * @return object|null
     * @throws NoSuchEntityException
     */
    private function getFriendModel($id): ?object
    {
        try {
            return $this->friendsRepository->getById($id);
        } catch (NoSuchEntityException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getFriendName($id)
    {
        return $this->getFriendModel($id)->getName();
    }

    /**
     * @param $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getFriendAge($id)
    {
        return $this->getFriendModel($id)->getAge();
    }

    /**
     * @param $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getFriendNotes($id)
    {
        return $this->getFriendModel($id)->getNotes();
    }
}
