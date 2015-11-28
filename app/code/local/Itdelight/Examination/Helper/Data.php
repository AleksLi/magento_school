<?php

class Itdelight_Examination_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getImagePath($name = "")
    {
        $path = Mage::getBaseDir('media') . '/itdelight_slides' ;
        if($name) {
            return "{$path}/{$name}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'itdelight_slides/' ;
        if ($id) {
            return $url . $id . '.jpg';
        } else {
            return $url;
        }
    }

    public function getAvailProdquantity($id)
    {
        $_product = Mage::getModel('catalog/product')->load($id);
        $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product);
        return $stock;
    }
}