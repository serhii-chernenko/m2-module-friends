<?php

namespace Course\Backend\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Course\Backend\Api\Data\FriendInterface;

class Friend extends AbstractDb
{

    protected function _construct()
    {
        $this->_init(
            FriendInterface::TABLE_NAME,
            FriendInterface::FIELD_ID
        );
    }
}
