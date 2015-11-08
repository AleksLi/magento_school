<?php

class Itdelight_First_Block_Product_View extends Mage_Catalog_Block_Product_View
{
    public  function getItdelightPosts()
    {
        $posts = Mage::getModel('itdelight_first/blogpost')->getCollection();
        return $posts;
    }
}
