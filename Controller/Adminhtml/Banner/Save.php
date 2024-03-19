<?php

namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use SolutionPioneers\BannerSlider\Model\ImageUploader;

/**
 * Class Save
 * 
 * @package SolutionPioneers\BannerSlider\Controller\Adminhtml\Banner
 */
class Save extends Action
{
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
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * @return void
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            /** @var \SolutionPioneers\BannerSlider\Model\Banner $model */
            $model = $this->_objectManager->create('SolutionPioneers\BannerSlider\Model\Banner');

            try {
                $data = $this->getRequest()->getPostValue();

                if (isset($data['banner_id']) && $bannerId = $data['banner_id']) {
                    $model = $model->load($bannerId);
                } else {
                    unset($data['banner_id']);
                }
                
                $data = $this->addImageData($data);
                $model->setData($data);

                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $model->save();

                $this->messageManager->addSuccess(__('Banner successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData(false);
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the banner data. Please review the error log.')
                );
                $this->_redirect('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
                
                return;
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * @param array $rawData
     */
    protected function addImageData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $imageName = $this->imageUploader->uploadFileAndGetName('image', $data);
            $data['image_path'] = static::IMAGE_PATH . $imageName;
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }

        return $data;
    }
}