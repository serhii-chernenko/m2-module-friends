<?php

namespace Course\Backend\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Exception;

class Delete extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $model = $this->friendsRepository->getById($id);
                $name = $model->getName();
                $this->friendsRepository->delete($model);
                $this->messageManager->addSuccessMessage(__('%1 has been successfully removed', $name));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
        return $redirect;
    }
}
