<?php
class Itdelight_Examination_Block_Adminhtml_Manageslides_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('itdelight_examination');
        $html = '<img ';
        $html .= 'id="' . $row->getId() . '" ';
        $html .= 'src="' . Mage::getBaseUrl( Mage_Core_Model_Store::URL_TYPE_WEB, true ) .'media/itdelight_slides/'.  $row->getData('image') . '"';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '" style="width:100px;"/>';

        return $html;
    }
}
