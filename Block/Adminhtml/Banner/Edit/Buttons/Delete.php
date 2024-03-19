<?php

namespace SolutionPioneers\BannerSlider\Block\Adminhtml\Banner\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Context as UiContext;

/**
 * Class Delete
 * 
 * @package SolutionPioneers\BannerSlider\Block\Adminhtml\Banner\Edit\Buttons
 */
class Delete extends \Magento\Backend\Block\Template implements ButtonProviderInterface
{
    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    protected $context;

    /**
     * @var \Magento\Framework\View\Element\UiComponent\Context
     */
    protected $uiContext;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\View\Element\UiComponent\Context $uiContext
     */
    public function __construct(
        Context $context,
        UiContext $uiContext
    ) {
        $this->context = $context;
        $this->uiContext = $uiContext;
    }

    /**
     * Retrieve button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($bannerId = $this->context->getRequest()->getParam('id')) {
            $url = $this->uiContext->getUrl('*/*/delete', ['id' => $bannerId]);
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => sprintf("deleteConfirm(
                    'Are you sure you want to delete this banner?', 
                    '%s'
                )", $url),
                'sort_order' => 20,
            ];
        }
        return $data;
    }
}