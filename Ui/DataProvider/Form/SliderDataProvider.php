<?php

namespace SolutionPioneers\BannerSlider\Ui\DataProvider\Form;

use SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem\DirectoryList;

/**
 * Class SliderDataProvider
 * 
 * @package SolutionPioners\BannerSlider\Ui\DataProvider\Form
 */
class SliderDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var Magento\Framework\Filesystem\DirectoryList
     */
    protected $directoryList;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var SolutionPioneers\BannerSlider\Model\ResourceModel\Slider\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        StoreManagerInterface $storeManager,
        DirectoryList $directoryList,
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $data);

        $this->directoryList = $directoryList;
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collectionFactory->create();
        $this->_request = $request;
        $this->storeManager = $storeManager;
    }

    /**
    * Get data
    *
    * @return array
    */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $itemId = $this->_request->getParam('id');

        $this->collection = $this->collectionFactory->create();

        if (!empty($itemId)) {
            $items = $this->collection->getItems();
            foreach ($items as $item) {
                $data = $item->getData();

                /* Prepare Image */
                $map = [
                    'image' => 'getImage',
                    'mobile_image' => 'getMobileImage',
                ];

                foreach ($map as $key => $method) {
                    if (isset($data[$key]) && !empty($data[$key])) {
                        $name = $data[$key];
                        unset($data[$key]);
                        $data[$key][0] = [
                            'name' => $name,
                            'url' => $this->getImageUrl($item->$method()),
                            'size' => $this->getImageSize($item->$method())
                        ];
                    }
                }

                $this->loadedData[$item->getId()] = $data;
            }
        }
        
        return $this->loadedData;
    }

    /**
     * @param \Magento\Framework\Api\Filter $filter
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }

    /**
     * @param string $imagePath
     * 
     * @return string
     */
    protected function getImageUrl(string $image) 
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'solutionpioneers/bannerslider/' . $image;
    }

    /**
     * @param string $imagePath
     * 
     * @return int
     */
    protected function getImageSize(string $image) 
    {
        $path = $this->directoryList->getPath('media') . '/solutionpioneers/bannerslider/' . $image;
        
        return filesize($path);
    }

}