<?php

namespace SolutionPioneers\BannerSlider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory;

class BannerWidget implements ArrayInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * SlidersWidget constructor.
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    protected function toArray()
    {
        $options = [];
        $banners = $this->collectionFactory->create();

        foreach ($banners as $banner) {
            $options[$banner->getBannerId()] = $banner->getTitle();
        }

        return $options;
    }
}