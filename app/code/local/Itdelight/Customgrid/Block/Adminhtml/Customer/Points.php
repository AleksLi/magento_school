<?php
class Itdelight_Customgrid_Block_Adminhtml_Customer_Points extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerData = Mage::getModel('customer/customer')->load($row->getId())->getData();
//        $customerPoints = Mage::getSingleton('customer/session')->getCustomer()->getPoints();
        $value = $customerData['points'] ;

        return $value;
    }
}