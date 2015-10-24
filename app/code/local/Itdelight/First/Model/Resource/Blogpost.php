<?php

class Itdelight_First_Model_Resource_Blogpost extends  Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('itdelight_first/blogpost', 'blogpost_id');
    }
}