<?php
namespace Course\Backend\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Course'));
        $resultPage->getConfig()->getTitle()->set(__('Friends'));

        return $resultPage;
    }

    /**
     * @inheritdoc
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Course_Backend::course');
    }
}
