<?php

namespace Gwd\TopBar\Controller\Adminhtml\Grid;

class Save extends \Magento\Backend\App\Action
{


    public $usersFactory;

    protected $collection;

    protected $_dataObjectFactory;

    protected $_collectionFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Gwd\TopBar\Model\UsersFactory $usersFactory,
        \Gwd\TopBar\Model\ResourceModel\Users\Grid\CollectionFactory $collectionFactory,
        \Magento\Framework\DataObjectFactory $dataObjectFactory
    )
    {
        parent::__construct($context);
        $this->usersFactory = $usersFactory->create();
        $this->collection = $this->usersFactory->getCollection();
        $this->_dataObjectFactory = $dataObjectFactory->create();
        $this->_collectionFactory = $collectionFactory->create();
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $userData = null;
        if (isset($data['info_id'])) {
            $userObject = $this->_collectionFactory->getItemById($data['info_id']);
            $userData = $userObject->getData();
            foreach ($userData as $userKey => $userValue) {
                foreach ($data as $dataKey => $dataValue) {
                    if ($userKey == $dataKey) {
                        if ($userValue != $dataValue) {
                            $userData[$userKey] = $dataValue;
                        }
                    } else continue;
                }
            }
            $userData['user_id'] = $data['info_id'];
//            $userObject->setData($userData);
//            $this->_collectionFactory->save();
        }

        if (!$data) {
            $this->_redirect('users/grid/addrow');
            return;
        }
        try {

            $this->usersFactory->setData($data);
//            if (isset($data['id'])) {
//                $this->usersFactory->setInfoId($data['id']);
//            }
            $this->usersFactory->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('users/grid/index');
    }
}
