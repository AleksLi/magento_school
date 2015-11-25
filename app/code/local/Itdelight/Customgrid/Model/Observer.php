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

    public function appendPointsColumn($observer) {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }
        if ($block->getType() == 'adminhtml/customer_grid') {
            /* @var $block Mage_Adminhtml_Block_Customer_Grid */
            $customer = $observer->getCustomer();
            $block->addColumnAfter('points', array(
                'header'=> Mage::helper('itdelight_customgrid')->__('Customer Points'),
                'type'  	=> 'text',
                'index' 	=> 'points',
                'renderer' => 'Itdelight_Customgrid_Block_Adminhtml_Customer_Points',
//                'filter_condition_callback' => array($this, '_addressFilter'),
            ), 'name');
        }
    }

    public function pointDifference($observer)
    {
        $observer->getData();
        $order = Mage::getModel('sales/order');
        $orderData = $order->getData();
    }


}
