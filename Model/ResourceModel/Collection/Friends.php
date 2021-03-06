<?php

namespace Course\Backend\Model\ResourceModel\Collection;

use Course\Backend\Model\Friend as Model;
use Course\Backend\Model\ResourceModel\Friend as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Friends extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Model::class,
            ResourceModel::class
        );
    }
}
