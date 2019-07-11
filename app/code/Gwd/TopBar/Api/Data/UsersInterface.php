<?php

namespace Gwd\TopBar\Api\Data;

interface UsersInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const INFO_ID = 'info_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const BACKGROUND_COLOR = 'bg_color';
    const STORE_VIEW = 'store_view';
    const STATUS = 'status';
    const PRIORITY = 'priority';

    /**
     * Get Info Id.
     *
     * @return mixed
     */
    public function getInfoId();

    /**
     * Set Info Id.
     *
     * @param $infoId
     *
     * @return mixed
     */
    public function setInfoId($infoId);

    /**
     * Get Title.
     *
     * @return mixed
     */
    public function getTitle();

    /**
     * Set Title.
     *
     * @param $title
     *
     * @return mixed
     */
    public function setTitle($title);

    /**
     * Get Content.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Set Content.
     *
     * @param $content
     *
     * @return mixed
     */
    public function setContent($content);

    /**
     * Get Background Color.
     *
     * @return mixed
     */
    public function getBgColor();

    /**
     * Set Background Color.
     *
     * @param $bgColor
     *
     * @return mixed
     */
    public function setBgColor($bgColor);

    /**
     * Get Store View.
     *
     * @return mixed
     */
    public function getStoreView();

    /**
     * Set Store View.
     *
     * @param $storeView
     *
     * @return mixed
     */
    public function setStoreView($storeView);

    /**
     * Get Status.
     *
     * @return mixed
     */
    public function getStatus();

    /**
     * Set Status.
     *
     * @param $status
     *
     * @return mixed
     */
    public function setStatus($status);

    /**
     * Get Priority.
     *
     * @return mixed
     */
    public function getPriority();

    /**
     * Set Priority.
     *
     * @param $priority
     *
     * @return mixed
     */
    public function setPriority($priority);
}
