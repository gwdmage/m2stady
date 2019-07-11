<?php

namespace Gwd\CustomCatalog\Controller\Adminhtml\Custom;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    public $catalogProductFactory;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Catalog\Model\ProductFactory $catalogProductFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ProductFactory $catalogProductFactory
    ) {
        parent::__construct($context);
        $this->catalogProductFactory = $catalogProductFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('customcatalog/custom/addproduct');
            return;
        }
        try {
            $rowData = $this->catalogProductFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Product has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('customcatalog/custom/index');
    }
}
