<?php
class Itdelight_First_Block_Adminhtml_Custom_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('itdelight_first');
//        Zend_Debug::dump(); die;
        $html = '<img ';
        $html .= 'id="' . $this->getColumn()->getId() . '" ';
//        $html .= 'src="' . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'src="' . Mage::getBaseUrl( Mage_Core_Model_Store::URL_TYPE_WEB, true ) .'media/itdelight_posts/'.  $row->getData('blogpost_id') . '.jpg' . '"';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '" style="width:100px;"/>';

        return $html;
    }
}
