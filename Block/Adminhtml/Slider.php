<?php

namespace SolutionPioneers\BannerSlider\Block\Adminhtml;

use \Magento\Backend\Block\Widget\Grid\Container;

class Slider extends Container
{
    /**
     * Constructor 
     */
	protected function _construct()
	{
		$this->_controller = 'adminhtml_bannerslider';
		$this->_blockGroup = 'SolutionPioneers_BannerSlider';
		$this->_headerText = __('Slider');
		$this->_addButtonLabel = __('Create New Slider');

		parent::_construct();
	}
}