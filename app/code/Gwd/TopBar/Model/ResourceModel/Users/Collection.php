<?php

namespace Gwd\TopBar\Model\ResourceModel\Users;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'info_id';


    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        $this->_init('Gwd\TopBar\Model\Users', 'Gwd\TopBar\Model\ResourceModel\Users');
        //Class naming structure
        // 'NameSpace\ModuleName\Model\ModelName', 'NameSpace\ModuleName\Model\ResourceModel\ModelName'
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('gwd_topbar_users_additional')],
            'main_table.info_id = secondTable.user_id',
            '*'
        );
    }

//    public function setTableRecords($condition, $columnData)
//    {
//        return $this->getConnection()->update(
//            $this->_initSelect(),
//            $columnData,
//            $where = $condition
//        );
//    }
}
