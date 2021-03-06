<?php

namespace Course\Backend\Controller\Adminhtml\Index;

use Exception;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        $model = null;

        try {
            if ($data['id']) {
                $model = $this->friendsRepository->getById($data['id']);
            } else {
                $model = $this->friendsRepository->getEmptyModel();
            }
        } catch (NoSuchEntityException $e) {
            $model = $this->friendsRepository->getEmptyModel();
        }

        $model->setName($data['name'])
            ->setAge($data['age'])
            ->setNotes($data['notes']);

        if ($data['id']) {
            $model->setId($data['id']);
        }

        try {
            $this->friendsRepository->save($model);

            $this->messageManager->addSuccessMessage(__('%1 has been successfully saved', $model->getName()));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'edit', ['id' => $model->getId()]);
        } catch (Exception | AlreadyExistsException $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
            $redirect->setPath(self::DEFAULT_ACTION_PATH . 'index');
        }

        return $redirect;
    }
}
