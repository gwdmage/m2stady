<?php

namespace Gwd\TopBar\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('gwd_topbar_users');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'info_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Title'
                )
                ->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Content'
                )
                ->addColumn(
                    'bg_color',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Background Color'
                )
                ->addColumn(
                    'store_view',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Store View'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    [],
                    'Status'
                )
                ->addColumn(
                    'priority',
                    Table::TYPE_TEXT,
                    null,
                    [],
                    'Priority'
                )
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }

        $table = $setup->getConnection()
            ->newTable($setup->getTable('gwd_topbar_users_additional'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true]
            )
            ->addColumn(
                'user_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false,]
            )
            ->addColumn(
                'blog',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255
            )
            ->addColumn(
                'order',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255
            )
            ->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255
            )->addForeignKey(
                $installer->getFkName(
                    'gwd_topbar_users_additional',
                    'user_id',
                    'gwd_topbar_users',
                    'info_id'
                ),
                'user_id',
                $installer->getTable('gwd_topbar_users'),
                'info_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $setup->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
