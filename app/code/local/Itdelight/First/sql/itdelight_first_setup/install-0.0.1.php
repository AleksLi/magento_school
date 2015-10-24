<?php

$installer = $this;

$tablePosts = $installer->getTable('itdelight_first/blogpost');

//die ($tablePosts);

$installer->startSetup();

$installer->getConnection()->dropTable($tablePosts);
$table = $installer->getConnection()
    ->newTable($tablePosts)
    ->addColumn('blogpost_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable' => false,
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ));
$installer->getConnection()->createTable($table);

// create second table itdelight_first_blogcategory
$tableBlogcategory = $installer->getTable('itdelight_first/blogcategory');

$installer->getConnection()->dropTable($tableBlogcategory);
$table = $installer->getConnection()
    ->newTable($tableBlogcategory)
    ->addColumn('blogcategory_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable' => false,
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ));

$installer->getConnection()->createTable($table);

$installer->endSetup();