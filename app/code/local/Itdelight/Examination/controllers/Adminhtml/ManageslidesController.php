<?php

class Itdelight_Examination_Adminhtml_ManageslidesController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('slides/slides');

        $contentBlock = $this->getLayout()->createBlock('itdelight_examination/adminhtml_manageslides');
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
        Mage::register('slides_data', Mage::getModel('itdelight_examination/cslider')->load($id));

        $this->loadLayout()->_setActiveMenu('slides/slides');
        $this->_addContent($this->getLayout()->createBlock('itdelight_examination/adminhtml_manageslides_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {

        $id = $this->getRequest()->getParam('id');
        if($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('itdelight_examination');
                $model = Mage::getModel('itdelight_examination/cslider');

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
                    $uploader->save($helper->getImagePath(), $_FILES['image']['name']); // Upload the image

                    $data['image'] = $_FILES['image']['name'] ;
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {

                        @unlink($helper->getImagePath($id) );
                    } else {
                        $str =  $data['image']['value'];
                        $parts = explode('/', $str);
                        $model->getData($id);
                        $data['image'] = $parts[1];
                    }
                }

                $model->setData($data)->setId($id);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Slider was saved successfully'));
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
                Mage::getModel('itdelight_examination/cslider')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Slider was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function exportCsvAction()
    {
        $fileName   = 'slides.csv';
        $grid       = $this->getLayout()->createBlock('itdelight_examination/adminhtml_manageslides');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }
}
