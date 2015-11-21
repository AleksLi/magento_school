<?php

//Method with Resource Eav Model

//$installer = $this;
//$installer->startSetup();
//
//$installer->addAttribute('catalog_product', 'my_attribute_date', array(
//    'group'             => 'My Attribute Set',
//    'label'             => 'My Attribute Date',
//    'type'              => 'datetime',
//    'input'             => 'date',
//    'backend'           => 'eav/entity_attribute_backend_datetime',
//    'frontend'          => '',
//    'visible'           => true,
//    'required'          => false,
//    'user_defined'      => true,
//    'searchable'        => false,
//    'filterable'        => false,
//    'comparable'        => false,
//    'visible_on_front'  => true,
//    'visible_in_advanced_search' => false,
//    'unique'            => false,
//    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
//));


//$installer->endSetup();
// Standard method

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId = $setup->getEntityTypeId('customer');
$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttribute("customer", "points", array(
    "type" => "varchar",
    "backend" => "",
    "label" => "Customer Points",
    "input" => "text",
    "source" => "",
    "visible" => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique" => false,
    "note" => "Customer Points"

));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "points");


$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'points',
    '999'  //sort_order
);

$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
//$used_in_forms[]="checkout_register";
//$used_in_forms[]="customer_account_create";
//$used_in_forms[]="customer_account_edit";
//$used_in_forms[]="adminhtml_checkout";
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100);
$attribute->save();


$installer->endSetup();


