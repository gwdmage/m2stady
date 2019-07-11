<?php

namespace Gwd\CustomCatalog\Controller\Adminhtml\Custom;

use Magento\Framework\Controller\ResultFactory;

class AddProduct extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var  \Magento\Catalog\Model\ProductFactory
     */
    private $catalogProductFactory;

    /**
     * AddProduct constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Catalog\Model\ProductFactory $catalogProductFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Catalog\Model\ProductFactory $catalogProductFactory
    ){
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->catalogProductFactory = $catalogProductFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = $this->catalogProductFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('grid/grid/rowdata');

                return;
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Product Data ') . $rowTitle : __('Add Product');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}