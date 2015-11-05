<?php

//echo '<h1>Upgrade DS News to version 0.0.3</h1>';
//exit;

$installer = $this;
$tableQuantity = $installer->getTable('itdelight_first/table_quantity');
$tableCategories = $installer->getTable('itdelight_first/blogcategory');

$installer->startSetup();
$installer->getConnection()->dropTable($tableQuantity);
$installer->getConnection()->dropTable($tableCategories);
$table = $installer->getConnection()
    ->newTable($tableQuantity)
    ->addColumn('quantity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable'  => false,
    ))
    ->addColumn('quantity', Varien_Db_Ddl_Table::TYPE_INTEGER, '11', array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$installer->endSetup();