<?php 

namespace SolutionPioneers\BannerSlider\Model;

use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel
{
    /**
     * Constructor
     */
	public function _construct()
  {
		$this->_init("SolutionPioneers\BannerSlider\Model\ResourceModel\Banner");
	}

}
