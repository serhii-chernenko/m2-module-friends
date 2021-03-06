<?php

namespace Course\Backend\Controller\Adminhtml\Index;

use Course\Backend\Api\FriendRepositoryInterface;
use Course\Backend\Model\FriendRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

abstract class AbstractController extends Action
{
    const DEFAULT_ACTION_PATH = 'course/index/';

    /**
     * @var FriendRepositoryInterface|FriendRepository
     */
    protected $friendsRepository;

    public function __construct(
        Context $context,
        FriendRepositoryInterface $friendsRepository
    ) {
        $this->friendsRepository = $friendsRepository;
        parent::__construct($context);
    }
}
