<?php 

namespace SolutionPioneers\BannerSlider\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'banner_id';
	protected $_eventPrefix = 'solutionpioneers_bannerslider_banner_collection';
	protected $_eventObject = 'bannerslider_banner_collection';

    /**
     * Constructor
     */
	public function _construct()
    {
		$this->_init(
            "SolutionPioneers\BannerSlider\Model\Banner",
            "SolutionPioneers\BannerSlider\Model\ResourceModel\Banner"
        );
	}
}
