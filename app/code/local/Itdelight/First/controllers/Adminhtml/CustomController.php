<?php

class Itdelight_First_Adminhtml_CustomController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('custom/custom');

        $contentBlock = $this->getLayout()->createBlock('itdelight_first/adminhtml_custom');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('posts_data', Mage::getModel('itdelight_first/blogpost')->load($id));

        $this->loadLayout()->_setActiveMenu('custom/custom');
        $this->_addContent($this->getLayout()->createBlock('itdelight_first/adminhtml_custom_edit'));
        $this->renderLayout();

    }

    public function saveAction()
    {
        if($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('itdelight_first/blogpost');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('itdelight_first/blogpost')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
}
