<?php

class Itdelight_First_Model_Resource_Quantity extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('itdelight_first/table_quantity', 'quantity_id');
    }
}