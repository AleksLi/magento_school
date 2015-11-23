<?php

class Itdelight_Customgrid_Model_Observer extends Varien_Event_Observer
{
    public function appendCustomColumn($observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }
        if ($block->getType() == 'adminhtml/customer_grid') {
            /* @var $block Mage_Adminhtml_Block_Customer_Grid */
            $block->addColumnAfter('middlename', array(
                'header'	=> 'Middle Name',
                'type'  	=> 'text',
                'index' 	=> 'middlename',
            ), 'email');
        }
    }


}
