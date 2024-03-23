<?php 

namespace SolutionPioneers\BannerSlider\Model\ResourceModel\Slider;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'slider_id';
	protected $_eventPrefix = 'solutionpioneers_bannerslider_slider_collection';
	protected $_eventObject = 'bannerslider_slider_collection';

    /**
     * Constructor
     */
	public function _construct()
    {
		$this->_init(
            "SolutionPioneers\BannerSlider\Model\Slider",
            "SolutionPioneers\BannerSlider\Model\ResourceModel\Slider"
        );
	}

    /**
     * @param int $bannerId
     * 
     * @return $this
     */
    public function addBannerFilter(int $bannerId)
    {
        return $this->addFieldToFilter('banner_id', $bannerId);
    }
}
