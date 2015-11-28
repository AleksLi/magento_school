<?php

class Itdelight_Examination_Block_Adminhtml_Manageslides_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'itdelight_examination';
        $this->_controller = 'adminhtml_manageslides';

    }

    public function getHeaderText()
    {

        $helper = Mage::helper('itdelight_examination');
        $model = Mage::registry('slides_data');

        if ($model->getId()) {
            return $helper->__("Edit Slider '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Slider");
        }
    }
}
