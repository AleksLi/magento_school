<?php

class Itdelight_Examination_Model_Resource_Cslider_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('itdelight_examination/cslider');
    }
}
