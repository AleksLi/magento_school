<?php

class Itdelight_First_Block_Test extends Mage_Core_Block_Template
{
    public function getFrontName()
    {
        echo "<h1> Test </h1>";
    }

    public function getNumOfProducts($attr, $first, $second, $third) {
        $_collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter($attr, array(
                array('eq'=>$first),
                array('eq'=>$second),
                array('eq'=>$third)
            ) );
        return $_collection;
    }
}