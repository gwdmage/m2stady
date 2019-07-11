<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_CustomModule
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\CustomModule\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Controller\Adminhtml\AbstractAction;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponentInterface;

/**
 * Class Render
 */
class Render extends AbstractAction
{
    /**
     * @return void
     */
    public function execute()
    {
        if ($this->_request->getParam('namespace') === null) {
            $this->_redirect('admin/noroute');
            return;
        }
        $component = $this->factory->create($this->_request->getParam('namespace'));
        $this->prepareComponent($component);
        $this->_response->appendBody((string) $component->render());
    }

    /**
     * Call prepare method in the component UI
     *
     * @param UiComponentInterface $component
     * @return void
     */
    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}
