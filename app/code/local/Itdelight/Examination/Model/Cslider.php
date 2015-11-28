<?php

class Itdelight_Examination_Model_Cslider extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('itdelight_examination/cslider');
    }

    protected function _afterDelete()
    {
        $helper = Mage::helper('itdelight_examination');
        @unlink($helper->getImagePath($this->getId()));
        return parent::_afterDelete();
    }

    public function getImageUrl()
    {
        $helper = Mage::helper('itdelight_examination');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }
}