<?php

namespace Course\Backend\Controller\Adminhtml\Index;

use Course\Backend\Api\FriendRepositoryInterface;
use Course\Backend\Model\Friend;
use Course\Backend\Model\FriendRepository;
use Course\Backend\Model\ResourceModel\Collection\FriendsFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends AbstractController
{
    /**
     * @var FriendsFactory
     */
    protected FriendsFactory $collectionFactory;

    /**
     * @var FriendRepositoryInterface|FriendRepository
     */
    protected $friendRepository;

    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param FriendRepositoryInterface|FriendRepository $friendsRepository
     * @param FriendsFactory $collectionFactory
     * @param Filter $filter
     */
    public function __construct(
        Context $context,
        FriendRepositoryInterface $friendsRepository,
        FriendsFactory $collectionFactory,
        Filter $filter
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context, $friendsRepository);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $friendsDeleted = 0;

            /**
             * @var Friend $friend
             */
            foreach ($collection->getItems() as $friend) {
                $this->friendsRepository->delete($friend);
                $friendsDeleted++;
            }

            if ($friendsDeleted) {
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 friend(s) have been deleted.', $friendsDeleted)
                );
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
        return $redirect;
    }
}
