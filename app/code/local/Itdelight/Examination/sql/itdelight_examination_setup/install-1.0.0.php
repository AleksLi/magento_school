<?php


$installer = $this;

$tableCslider = $installer->getTable('itdelight_examination/cslider');

//die ($tableCslider);

$installer->startSetup();

$installer->getConnection()->dropTable($tableCslider);
$table = $installer->getConnection()
    ->newTable($tableCslider)
    ->addColumn('cslider_id',  Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ))
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable' => false,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable' => false,
    ))
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, 4, array(
        'nullable' => false,
    ), 'Status')
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ));

$installer->getConnection()->createTable($table);


$installer->endSetup();