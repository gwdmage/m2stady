<?php

namespace Gwd\TopBar\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Get User row status type labels array.
     *
     * @return array
     */
    public function getOptionArray()
    {
        $options = ['1' => __('Enabled'),'0' => __('Disabled')];

        return $options;
    }

    /**
     * Get User row status labels array with empty value for option element.
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);

        return $res;
    }

    /**
     * Get User row type array for option element.
     *
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }

        return $res;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
