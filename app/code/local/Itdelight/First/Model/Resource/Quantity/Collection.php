<?php

class Itdelight_First_Model_Resource_Quantity_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('itdelight_first/quantity');
    }
}
