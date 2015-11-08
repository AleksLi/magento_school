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
        $id = $this->getRequest()->getParam('id');
        if($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('itdelight_first');
                $model = Mage::getModel('itdelight_first/blogpost');

                $model->setData($data)->setId($id);
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $id = $model->getId();


                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $_FILES['image']['name'] . '.jpg'); // Upload the image

                    $data['image'] = $_FILES['image']['name'] ;
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {

                        @unlink($helper->getImagePath($id) . "-------");
                    }
                    $data['image'] = 'choose the picture please';
                }

                $model->setData($data)->setId($id);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Post was saved successfully'));
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
