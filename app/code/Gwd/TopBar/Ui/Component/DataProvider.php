<?php

namespace Gwd\TopBar\Ui\Component;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    public $limit = 3;

    public $output;

    public function getData()
    {
        $this->setLimit(null, 4);
        $this->output = parent::getData();
        return $this->output;
    }

    protected function prepareUpdateUrl()
    {
        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }
        foreach ($this->data['config']['filter_url_params'] as $paramName => $paramValue) {
            if ('*' == $paramValue) {
                $paramValue = $this->request->getParam($paramName);
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s', $this->data['config']['update_url'], $paramName, $paramValue
                );
                if ($paramName == 'offset') {
//                    $this->limit = 6;
                    $this->setLimit(null, 4);
                    parent::getData();
//                    $paramValue = explode(',', $paramValue);
//                    $this->addFilter(
//                        $this->filterBuilder->setField('info_id')->setValue(6)->setConditionType('in')->create()
//                    );
                } else {
                    $this->addFilter(
                        $this->filterBuilder->setField($paramName)->setValue($paramValue)->setConditionType('eq')->create()
                    );
                }
            }
        }
    }
}

