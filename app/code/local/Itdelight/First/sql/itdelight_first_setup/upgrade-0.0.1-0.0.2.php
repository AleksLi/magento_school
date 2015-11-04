<?php

$installer = $this;

//die('base is connecting');

$installer->startSetup();

$tablePosts = $installer->getTable('itdelight_first/blogpost');


$table = $installer->getConnection()
    ->addColumn($tablePosts, 'image', array(
        'comment'   => 'News column',
        'nullable'  => false,
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    ));

//$installer->getConnection()->createTable($table);
$installer->endSetup();