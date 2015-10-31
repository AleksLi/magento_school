<?php

class Itdelight_First_Block_Adminhtml_Custom_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'itdelight_first';
        $this->_controller = 'adminhtml_custom';

    }

    public function getHeaderText()
    {

        $helper = Mage::helper('itdelight_first');
        $model = Mage::registry('posts_data');

        if ($model->getId()) {
            return $helper->__("Edit News item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add News item");
        }
    }
}
