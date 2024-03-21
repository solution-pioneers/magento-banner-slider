<?php

namespace SolutionPioneers\BannerSlider\Controller\Adminhtml\Slider;

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
     * @var string
     */
    protected const IMAGE_PATH = 'solutionpioneers/bannerslider/';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @var \SolutionPioneers\BannerSlider\Model\ImageUploader
     */
    protected $imageUploader;

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
        ImageUploader $imageUploader,
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return void
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            /** @var \SolutionPioneers\BannerSlider\Model\Slider $model */
            $model = $this->_objectManager->create('SolutionPioneers\BannerSlider\Model\Slider');

            try {
                $data = $this->getRequest()->getPostValue();

                if (isset($data['slider_id']) && $bannerId = $data['slider_id']) {
                    $model = $model->load($bannerId);
                } else {
                    unset($data['slider_id']);
                }
                
                $data = $this->addImageData($data, 'image');
                $data = $this->addImageData($data, 'mobile_image');
                $model->setData($data);

                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $model->save();

                $this->messageManager->addSuccess(__('Slider successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData(false);
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the slider data. Please review the error log.')
                );
                $this->_redirect('*/*/edit', ['slider_id' => $this->getRequest()->getParam('slider_id')]);
                
                return;
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * @param array $rawData
     * @param string $key
     */
    protected function addImageData(array $rawData, string $key)
    {
        $data = $rawData;
        
        if (isset($data[$key][0]['name'])) {
            $imageName = $this->imageUploader->uploadFileAndGetName($key, $data);
            $data['image_path'] = static::IMAGE_PATH . $imageName;
            $data[$key] = $imageName;
        } else {
            $data[$key] = null;
        }

        return $data;
    }
}