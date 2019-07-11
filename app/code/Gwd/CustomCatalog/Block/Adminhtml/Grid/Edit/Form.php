<?php

namespace Gwd\CustomCatalog\Block\Adminhtml\Grid\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ){
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return \Magento\Backend\Block\Widget\Form\Generic
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('General')));

        if ($model->getEntityId()) {
            $fieldset->addField('entity_id', 'hidden', array('name' => 'entity_id'));
        }
        $fieldset->addField(
            'copywriteinfo',
            'text',
            [
                'name' => 'copywriteinfo',
                'label' => __('CopyWriteInfo'),
                'title' => __('copywriteinfo'),
            ]
        );
        $fieldset->addField(
            'vpn',
            'text',
            [
                'name' => 'vpn',
                'label' => __('VPN'),
                'title' => __('vpn'),
            ]
        );
        $fieldset->addField(
            'sku',
            'text',
            [
                'name' => 'sku',
                'label' => __('SKU'),
                'title' => __('sku'),
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
