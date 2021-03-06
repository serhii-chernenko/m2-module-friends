<?php

namespace Course\Backend\Block\Adminhtml\Friend;

use Course\Backend\Api\Data\FriendInterface;
use Course\Backend\Api\FriendRepositoryInterface;
use Course\Backend\Model\Friend;
use Course\Backend\Model\FriendRepository;
use Exception;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * @var FriendRepositoryInterface|FriendRepository
     */
    protected $friendsRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param FriendRepositoryInterface $friendsRepository
     */
    public function __construct(
        Context $context,
        FriendRepositoryInterface $friendsRepository
    ) {
        $this->context = $context;
        $this->friendsRepository = $friendsRepository;
    }

    /**
     * @return FriendInterface|Friend|null
     * @throws NoSuchEntityException
     */
    public function getFriend()
    {
        $id = $this->context->getRequest()->getParam('id');

        if ($id) {
            try {
                return $this->friendsRepository->getById($id);
            } catch (Exception $e) {
                throw new NoSuchEntityException(__($e->getMessage()));
            }
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
