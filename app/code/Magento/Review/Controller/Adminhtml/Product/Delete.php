<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Review\Controller\Adminhtml\Product;

use Magento\Framework\Controller\ResultFactory;
use Magento\Review\Controller\Adminhtml\Product as ProductController;

class Delete extends ProductController
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $reviewId = $this->getRequest()->getParam('id', false);
        try {
            $this->reviewFactory->create()->setId($reviewId)->aggregate()->delete();

            $this->messageManager->addSuccessMessage(__('The review has been deleted.'));
            if ($this->getRequest()->getParam('ret') == 'pending') {
                $resultRedirect->setPath('review/*/pending');
            } else {
                $resultRedirect->setPath('review/*/');
            }
            return $resultRedirect;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong  deleting this review.'));
        }

        return $resultRedirect->setPath('review/*/edit/', ['id' => $reviewId]);
    }
}
