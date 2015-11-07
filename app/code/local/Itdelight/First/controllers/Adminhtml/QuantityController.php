<?php

class Itdelight_First_Adminhtml_QuantityController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
//        $this->_redirect('*/*/edit');

        $this->loadLayout();
        $this->_setActiveMenu('quantity');

        $contentBlock = $this->getLayout()->createBlock('itdelight_first/adminhtml_quantity');
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
        Mage::register('current_qty', Mage::getModel('itdelight_first/quantity')->load($id));

        $this->loadLayout()->_setActiveMenu('quantity');
        $this->_addContent($this->getLayout()->createBlock('itdelight_first/adminhtml_quantity_edit'));
        $this->renderLayout();

    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($data = $this->getRequest()->getPost()) {
            try {

                $model = Mage::getModel('itdelight_first/quantity');
                $model->setData($data)->setId($id);
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Quantity was saved successfully'));
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
        $this->_redirect('*/*/edit');

    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('itdelight_first/quantity')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Quantity was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
}