<?php
namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;

class Index extends Banner
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
        $resultPage->setActiveMenu('SolutionPioneers_BannerSlider::banner');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Banners'));
 
        return $resultPage;
    }
}