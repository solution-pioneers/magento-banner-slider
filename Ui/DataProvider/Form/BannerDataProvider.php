<?php

namespace SolutionPioneers\BannerSlider\Ui\DataProvider\Form;

use SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem\DirectoryList;

/**
 * Class BannerDataProvider
 *
 * @package SolutionPioners\BannerSlider\Ui\DataProvider\Form
 */
class BannerDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
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
     * @var SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Magento\Store\Model\StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \SolutionPioneers\BannerSlider\Model\ResourceModel\Banner\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Filesystem\DirectoryList $directoryList
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

}
