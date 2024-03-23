<?php 

namespace SolutionPioneers\BannerSlider\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface; 
use SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\CollectionFactory;
use SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\Collection as SliderCollection;
 
class Banner extends Template implements BlockInterface {

	/** @var string */
	protected $_template = "widget/banner.phtml";

	/** @var \SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\CollectionFactory */
	protected CollectionFactory $collectionFactory;

	/** @var \Magento\Store\Model\StoreManagerInterface */
	protected StoreManagerInterface $storeManager;

	/**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory
     * @param array<mixed> $data
     */
    public function __construct(
		Context $context,
		CollectionFactory $collectionFactory,
		StoreManagerInterface $storeManager,
		array $data = []
	) {
        parent::__construct($context, $data);

        $this->collectionFactory =  $collectionFactory;
		$this->storeManager = $storeManager;
    }

	/**
	 * @return \SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\Collection
	 */
	public function getSliderCollection(): SliderCollection
	{
		return $this->collectionFactory->create()
			->addBannerFilter($this->getBannerId());
	}

	/**
	 * @return string
	 */
	public function getImagePath(): string
	{
		return $this->getMediaUrl() . 'solutionpioneers/bannerslider/';
	}

	/**
     * @return int
     */
    protected function getBannerId(): ?int
    {
        return $this->getData('banner_id') ?: null;
    }
	
	/**
	 * @return string
	 */
	protected function getMediaUrl(): string 
	{
		return $this->storeManager
			->getStore()
			->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}
}
