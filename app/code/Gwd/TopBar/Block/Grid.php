<?php

namespace Gwd\TopBar\Block;

class Grid extends \Magento\Framework\View\Element\Template
{

    /**
     * Grid constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getUsers()
    {
        return 'getUsers';
    }
}
