<?php
namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider;

class Index extends Slider
{
    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SolutionPioneers_BannerSlider::slider');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Sliders'));
 
        return $resultPage;
    }
}