<?php

namespace Gwd\TopBar\Block\Adminhtml\Grid\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * Form constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Gwd\TopBar\Model\Status $options
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Gwd\TopBar\Model\Status $options,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
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
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );
        $form->setHtmlIdPrefix('usersrid');
        if ($model->getInfoId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('info_id', 'hidden', ['name' => 'info_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'bg_color',
            'text',
            [
                'name' => 'bg_color',
                'label' => __('Background Color'),
                'id' => 'bg_color',
                'title' => __('Background Color'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'store_view',
            'text',
            [
                'name' => 'store_view',
                'label' => __('Store View'),
                'id' => 'store_view',
                'title' => __('Store View'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'id' => 'status',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'priority',
            'text',
            [
                'name' => 'priority',
                'label' => __('Priority'),
                'id' => 'priority',
                'title' => __('Priority'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'blog',
            'text',
            [
                'name' => 'blog',
                'label' => __('Blog'),
                'id' => 'blog',
                'title' => __('Blog'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'order',
            'text',
            [
                'name' => 'order',
                'label' => __('Order'),
                'id' => 'order',
                'title' => __('Order'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'message',
            'text',
            [
                'name' => 'message',
                'label' => __('Message'),
                'id' => 'message',
                'title' => __('message'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}