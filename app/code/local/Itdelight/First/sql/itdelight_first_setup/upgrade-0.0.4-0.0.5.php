<?php

$currentStore = Mage::app()->getStore()->getId();
Mage::app()->setUpdateMode(0);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

Mage::app()->getStore()->setId($currentStore);
Mage::app()->setUpdateMode(1);


$product = Mage::getModel('catalog/product');
$rand = rand(1, 999);
$product
    ->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE)
    ->setAttributeSetId(4) // default attribute set
    ->setSku('example_sku' . $rand) // generate a random SKU
    ->setWebsiteIDs(array(1))
    ->setCategoryIds(array(4,10))
    ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
    ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH); // visible in catalog and search

$product->setStockData(array(
    'use_config_manage_stock' => 0, // use global config?
    'manage_stock'            => 1, // should we manage stock or not?
    'is_in_stock'             => 1,
    'qty'                     => 5,
));
$product
    ->setName('Test Product #' . $rand) // add string attribute
    ->setShortDescription('Description') // add text attribute

    // set up prices
    ->setPrice(24.50)
    ->setSpecialPrice(19.99)
    ->setTaxClassId(2)    // Taxable Goods by default
    ->setWeight(87)
;
$product->save();

$images = array(
    'thumbnail'   => '_1.JPG',
    'small_image' => '_1.JPG',
    'image'       => '_1.JPG',
);

$dir = Mage::getBaseDir('media') . DS . 'itdelight_posts/';

foreach ($images as $imageType => $imageFileName) {
    $path = $dir . $imageFileName;
    if (file_exists($path)) {
        try {
            $product->addImageToMediaGallery($path, $imageType, false);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "Can not find image by path: `{$path}`<br/>";
    }
}

//echo "everything is ok";