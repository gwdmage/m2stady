<?php

namespace Gwd\TopBar\Controller\Grid;

class View extends \Magento\Framework\App\Action\Action
{
    protected $dataProvider;

    protected $dataProviderFactory;

    protected $_usersFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Gwd\TopBar\Model\UsersFactory $usersFactory,
        \Gwd\TopBar\Ui\Component\DataProviderFactory $dataProviderFactory
    ) {
        $this->_usersFactory = $usersFactory->create();
        $this->dataProviderFactory = $dataProviderFactory->create();
        $this->dataProviderFactory->setCustomCollection($this->_usersFactory->getCollection());
        parent::__construct($context);
    }

    public function execute()
    {
        $limit = $this->getRequest()->getParam('offset');
        $this->dataProviderFactory->setCustomLimit($limit);
        $this->dataProviderFactory->getData();
    }

}