<?php

class Itdelight_Examination_Block_Adminhtml_Manageslides extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('itdelight_examination');

        $this->_blockGroup  =  'itdelight_examination';
        $this->_controller = 'adminhtml_manageslides';
//        Zend_Debug::dump($this);

        $this->_headerText = $helper->__('Manage Slides');
        $this->_addButtonLabel = $helper->__('Add Slide');
    }


//
//        public function _toHtml()
//        {
//            return '<h1>News Module: Custom section   0000</h1>';
//        }


}