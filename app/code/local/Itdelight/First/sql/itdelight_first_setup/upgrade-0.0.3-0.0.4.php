<?php

$installer = $this;

//die('sql is right');

$installer->startSetup();

$tablePosts = $installer->getTable('itdelight_first/blogpost');

$table = $installer->getConnection()
    ->addColumn($tablePosts, 'product_id', array(
        'comment'   => 'Product column',
        'nullable'  => false,
        'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
    ));

$installer->endSetup();