<?php

namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;

use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;

/**
 * Class Delete
 * @package SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider
 */
class Delete extends Banner
{
    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            /** @var \SolutionPioneers\BannerSlider\Model\Banner $banner */
            $this->bannerFactory->create()
                ->load($this->getRequest()->getParam('id'))
                ->delete();
            $this->messageManager->addSuccess(__('The banner has been deleted.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $resultRedirect->setPath(
                'sp_bannerslider/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );

            return $resultRedirect;
        }

        $resultRedirect->setPath('sp_bannerslider/*/');

        return $resultRedirect;
    }
}