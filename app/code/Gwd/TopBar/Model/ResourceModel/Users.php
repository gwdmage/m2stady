<?php

namespace Gwd\TopBar\Model\ResourceModel;

class Users extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'info_id';

    /**
     * Users constructor.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('gwd_topbar_users', 'info_id');
    }
}
