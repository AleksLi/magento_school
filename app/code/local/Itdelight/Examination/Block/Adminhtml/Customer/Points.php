<?php
class Itdelight_Examination_Block_Adminhtml_Customer_Points extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerData = Mage::getModel('customer/customer')->load($row->getId())->getData();
        $value = $customerData['points'] ;

        return $value;
    }
}