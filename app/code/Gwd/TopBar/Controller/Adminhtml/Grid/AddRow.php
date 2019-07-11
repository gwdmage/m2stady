<?php

namespace Gwd\TopBar\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Gwd\TopBar\Model\UsersFactory
     */
    private $usersFactory;

    /**
     * AddRow constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Gwd\TopBar\Model\UsersFactory $usersFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Gwd\TopBar\Model\UsersFactory $usersFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->usersFactory = $usersFactory;
    }

    /**
     * Mapped Grid List page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = $this->usersFactory->create();

        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getInfoId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('users/grid/index');

                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ') . $rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
