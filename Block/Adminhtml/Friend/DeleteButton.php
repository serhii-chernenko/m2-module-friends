<?php

namespace Course\Backend\Block\Adminhtml\Friend;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getButtonData(): array
    {
        $data = [];
        $friend = $this->getFriend();
        if ($friend) {
            $data = [
                'label' => __('Delete Friend'),
                'class' => 'delete',
                'on_click' => "deleteConfirm(
                    'Are you sure you want to do this?',
                    '{$this->getDeleteUrl()}',
                    {data:{'id':'{$friend->getId()}'}}
                )",
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getFriend()]);
    }
}
