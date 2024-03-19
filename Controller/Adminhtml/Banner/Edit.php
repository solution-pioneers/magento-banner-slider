<?php

namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Edit
 * 
 * @package SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner
 */
class Edit extends Action
{
    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * AbstractAction constructor.
     *
     * @param Context $context
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->eventManager = $context->getEventManager();
        $this->resultPageFactory = $resultPageFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $bannerId = $this->getBannerId();
        
        if ($bannerId) {
            try {
                $model = $this->_objectManager->create('SolutionPioneers\BannerSlider\Model\Banner')->load($bannerId);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
                $this->messageManager->addError(__('This Banner no longer exists.'));
                $this->_redirect('*/*/*');

                return;
            }
        } else {
            /** @var \SolutionPioneers\BannerSlider\Model\Banner $model */
            $model = $this->_objectManager->create('SolutionPioneers\BannerSlider\Model\Banner');
        }
        
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        
        $resultPage->getConfig()->getTitle()->prepend(__('New Banner'));
        if ($bannerId) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Banner'));
        }
        
        $resultPage->addBreadcrumb(__('Banner'), __('Banner'));


        return $resultPage;
    }

    /**
     * @return string
     */
    protected function getBannerId()
    {
        return $this->getRequest()->getParam('id');
    }
}