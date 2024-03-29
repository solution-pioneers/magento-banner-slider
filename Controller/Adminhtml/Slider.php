<?php
namespace SolutionPioneers\BannerSlider\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use SolutionPioneers\BannerSlider\Model\SliderFactory;
 
class Slider extends Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    
    /**
     * @var \SolutionPioneers\BannerSlider\Model\SliderFactory
     */
    protected $sliderFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \SolutionPioneers\BannerSlider\Model\SliderFactory $sliderFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        SliderFactory $sliderFactory,
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->sliderFactory = $sliderFactory;

        parent::__construct($context);
    }

    public function execute(){}
 
    protected function _isAllowed()
    {
        return true;
    }
}