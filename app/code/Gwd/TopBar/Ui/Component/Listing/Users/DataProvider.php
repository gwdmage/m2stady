<?php

namespace Gwd\TopBar\Ui\Component\Listing\Users;

use \Gwd\TopBar\Model\ResourceModel\Users\CollectionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    public $collection;

    private $modifiersPool;

    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = [],
        PoolInterface $modifiersPool = null
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data
        );
        $this->collection = $collectionFactory->create();
        $this->modifiersPool = $modifiersPool ?: ObjectManager::getInstance()->get(PoolInterface::class);

    }

    public function getData()
    {
//        $this->getCollection()->addFieldToFilter();
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();

        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),
        ];
        if ($this->modifiersPool->getModifiersInstances()) {
            /** @var ModifierInterface $modifier */
            foreach ($this->modifiersPool->getModifiersInstances() as $modifier) {
                $data = $modifier->modifyData($data);
            }
        }
//         $data /
        return $items;
    }

    public function getMeta()
    {
        $meta = parent::getMeta();

        /** @var ModifierInterface $modifier */
        foreach ($this->modifiersPool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }
}