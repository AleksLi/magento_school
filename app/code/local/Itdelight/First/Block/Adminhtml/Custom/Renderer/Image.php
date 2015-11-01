<?php
class Itdelight_First_Block_Adminhtml_Custom_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('itdelight_first');
//        Zend_Debug::dump($this->getColumn()); die;
        $html = '<img ';
        $html .= 'id="' . $this->getColumn()->getId() . '" ';
//        $html .= 'src="' . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'src="' .  Mage::getBaseUrl().'media/itdelight_posts/'. '------'. $this->getColumn()->getId() . '.jpg' . '"';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';

        return $html;
    }
}
