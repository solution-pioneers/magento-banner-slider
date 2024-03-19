<?php

namespace SolutionPioneers\BannerSlider\Block\Adminhtml;

use \Magento\Backend\Block\Widget\Grid\Container;

class Banner extends Container
{
    /**
     * Constructor 
     */
	protected function _construct()
	{
		$this->_controller = 'adminhtml_bannerslider';
		$this->_blockGroup = 'SolutionPioneers_BannerSlider';
		$this->_headerText = __('Banner');
		$this->_addButtonLabel = __('Create New Banner');

		parent::_construct();
	}
}