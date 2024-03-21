<?php 

namespace SolutionPioneers\BannerSlider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Slider extends AbstractDb
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

     /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);

        $this->date = $date;
    }
    
    /**
     * constructor
     */
    public function _construct()
    {
        $this->_init("solutionpioneers_bannerslider_slider","slider_id");
    }

    /**
     * Process post data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * 
     * @return $this
     * 
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $date = $this->date->gmtDate();

        if ($object->isObjectNew() && !$object->getCreatedAt()) {
            $object->setCreatedAt($date);
        }

        $object->setUpdatedAt($date);

        return parent::_beforeSave($object);
    }

}