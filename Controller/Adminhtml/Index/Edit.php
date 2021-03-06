<?php

namespace Course\Backend\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Edit extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $page->getConfig()->getTitle();

        if ($id) {
            $model = $this->friendsRepository->getById($id);
            if (!$model->getId()) {
                return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*');
            }

            $title->prepend(__($model->getName()));
            $title->set(__('Edit'));
            $title->append(__('Friends'));
        } else {
            $title->set(__('Add new Friend'));
        }
        return $page;
    }
}
