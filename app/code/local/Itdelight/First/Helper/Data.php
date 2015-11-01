<?php

class Itdelight_First_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getHello()
    {
        return "helper is working";
    }

    public function getImagePath($id = 0)
    {
        $path = Mage::getBaseDir('media') . DS. 'itdelight_posts' ;
        if($id) {
            return "{$path}/{$id}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'itdelight_posts' .DS ;
        if ($id) {
            return $url . $id . '.jpg';
        } else {
            return $url;
        }
    }


}