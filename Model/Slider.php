<?php 

namespace SolutionPioneers\BannerSlider\Model;

use Magento\Framework\Model\AbstractModel;

class Slider extends AbstractModel
{
    /**
     * Constructor
     */
	public function _construct()
  {
		$this->_init("SolutionPioneers\BannerSlider\Model\ResourceModel\Slider");
	}

}
