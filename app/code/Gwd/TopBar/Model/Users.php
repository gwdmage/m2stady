<?php

namespace Gwd\TopBar\Model;

use Gwd\TopBar\Api\Data\UsersInterface;

class Users extends \Magento\Framework\Model\AbstractModel implements UsersInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'users_grid_records';

    /**
     * @var string
     */
    protected $_cacheTag = 'users_grid_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'users_grid_records';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Gwd\TopBar\Model\ResourceModel\Users');
    }

    /**
     * Get Info Id.
     *
     * @return int
     */
    public function getInfoId()
    {
        return $this->getData(self::INFO_ID);
    }

    /**
     * Set Info Id.
     *
     * @param $infoId
     *
     * @return Users
     */
    public function setInfoId($infoId)
    {
        return $this->setData(self::INFO_ID, $infoId);
    }

    /**
     * Get Title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title
     *
     * @param $title
     *
     * @return Users
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Content.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set Content.
     *
     * @param $content
     *
     * @return Users
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get Background Color.
     *
     * @return mixed
     */
    public function getBgColor()
    {
        return $this->getData(self::BACKGROUND_COLOR);
    }

    /**
     * Set Background Color.
     *
     * @param $bgColor
     *
     * @return Users
     */
    public function setBgColor($bgColor)
    {
        return $this->setData(self::BACKGROUND_COLOR, $bgColor);
    }

    /**
     * Get Store View.
     *
     * @return mixed
     */
    public function getStoreView()
    {
        return $this->getData(self::STORE_VIEW);
    }

    /**
     * Set Store View.
     *
     * @param $storeView
     *
     * @return Users
     */
    public function setStoreView($storeView)
    {
        return $this->setData(self::STORE_VIEW, $storeView);
    }

    /**
     * Get Status.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * * Set Status.
     *
     * @param $status
     *
     * @return Users
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get Priority.
     *
     * @return mixed
     */
    public function getPriority()
    {
        return $this->getData(self::PRIORITY);
    }

    /**
     * Set Priority.
     *
     * @param $priority
     *
     * @return Users
     */
    public function setPriority($priority)
    {
        return $this->setData(self::PRIORITY, $priority);
    }
}
