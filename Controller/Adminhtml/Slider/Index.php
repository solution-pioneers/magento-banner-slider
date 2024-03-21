<?php
namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider;

class Index extends Slider
{
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
    )
    {
        parent::__construct(
            $context, 
            $coreRegistry, 
            $resultPageFactory, 
        );
    }

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