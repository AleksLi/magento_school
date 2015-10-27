<?php

class Itdelight_First_Adminhtml_CustomController extends Mage_Adminhtml_Controller_Action
{
    protected function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('custom/custom');

        $contentBlock = $this->getLayout()->createBlock('itdelight_first/adminhtml_custom');
//        Zend_Debug::dump($this->getLayout());
        $this->_addContent($contentBlock);
        $this->renderLayout();
        // name in admin->routers->"itdelight_first"

        // work fine
        /*$this->loadLayout()
            ->_addContent(
                $this->getLayout()
                    ->createBlock('itdelight_first/adminhtml_custom'))
                  //->setTemplate('template/customtemplate.phtml'))
            ->renderLayout();*/


    }
}
