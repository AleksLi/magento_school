<?php

class Itdelight_First_Block_Adminhtml_Custom extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('itdelight_first');

        $this->_blockGroup  =  'itdelight_first';
        $this->_controller = 'adminhtml_custom';
//        Zend_Debug::dump($this);

        $this->_headerText = $helper->__('Posts Management');
        $this->_addButtonLabel = $helper->__('Add Posts');
    }

/*

    public function _toHtml()
    {
        return '<h1>News Module: Custom section   0000</h1>';
    }*/


}