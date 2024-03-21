<?php

namespace SolutionPioneers\BannerSlider\Ui\Component\Listing\Columns\Options;

use SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory;

class Banner implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $collection;

    /**
     * Category constructor.
     * @param \SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collection = $collectionFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $banners = $this->collection->create();
        $options = [];
        foreach ($banners as $banner){
            $options[] = [
                'value' => $banner->getBannerId(),
                'label' => $banner->getTitle()
            ];
        }

        return $options;
    }
}