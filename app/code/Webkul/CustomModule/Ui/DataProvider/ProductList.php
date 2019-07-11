<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomModule
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomModule\Ui\DataProvider;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;

class ProductList extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    /**
     * Product collection
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $collection;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ProductCollection $productCollection
     * @param CollectionFactory $collectionFactory
     * @param HelperData $helperData
     * @param \Magento\Framework\Registry $registry
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ProductCollection $productCollection,
        \Magento\Framework\Registry $registry,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $productCollection,
            $addFieldStrategies,
            $addFilterStrategies,
            $meta,
            $data
        );
        $collectionData = $productCollection->create()
                                            // ->addFieldToFilter('type_id', ['in'=>['simple', 'virtual', 'downloadable']])
                                            ->addAttributeToSelect('name');
        $this->collection = $collectionData;
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }
}
