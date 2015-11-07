<?php

class Itdelight_First_Model_Blogpost extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('itdelight_first/blogpost');
    }

    protected function _afterDelete()
    {
        $helper = Mage::helper('itdelight_first');
        @unlink($helper->getImagePath($this->getId()));
        return parent::_afterDelete();
    }

    public function getImageUrl()
    {
        $helper = Mage::helper('itdelight_first');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }
}