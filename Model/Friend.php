<?php

namespace Course\Backend\Model;

use Course\Backend\Api\Data\FriendInterface;
use Course\Backend\Model\ResourceModel\Friend as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Friend extends AbstractModel implements FriendInterface
{
    protected $_eventPrefix = 'course_friends_event';

    protected $_eventObject = 'course_friends_event_object';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->getData(FriendInterface::FIELD_ID);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getData(FriendInterface::FIELD_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): FriendInterface
    {
        return $this->setData(FriendInterface::FIELD_NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getAge()
    {
        return $this->getData(FriendInterface::FIELD_AGE);
    }

    /**
     * @inheritDoc
     */
    public function setAge($age): FriendInterface
    {
        return $this->setData(FriendInterface::FIELD_AGE, $age);
    }

    /**
     * @inheritDoc
     */
    public function getNotes(): string
    {
        return $this->getData(FriendInterface::FIELD_NOTES);
    }

    /**
     * @inheritDoc
     */
    public function setNotes(string $notes): FriendInterface
    {
        return $this->setData(FriendInterface::FIELD_NOTES, $notes);
    }

    /**
     * @inheritDoc
     */
    public function getCreated(): string
    {
        return $this->getData(FriendInterface::FIELD_CREATED);
    }

    /**
     * @inheritDoc
     */
    public function getUpdated(): string
    {
        return $this->getData(FriendInterface::FIELD_UPDATED);
    }
}
