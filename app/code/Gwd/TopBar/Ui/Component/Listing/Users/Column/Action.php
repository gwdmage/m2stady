<?php

namespace Gwd\TopBar\Ui\Component\Listing\Users\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Action extends Column
{

    /** Url path */
    const ROW_EDIT_URL = 'users/grid/addrow';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @var string
     */
    private $_editUrl;

    /**
     * Action constructor.
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['info_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['info_id']]
                        ),
                        'label' => __('Edit'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}
