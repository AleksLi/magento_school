<?php

class Itdelight_First_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getHello()
    {
        return "helper is working";
    }
    /**
     * To add data into itdelight_first_blogposts table
     *
     * @var $title string
     * @var $content string
     * @var $tableName string (name of the table in config.xml file of the module pack_module/table_name)
     * @return success or log message
     */
    public function addDataToTable($tableName, $title, $content)
    {

        $data = array('title'=>$title, 'content'=> $content);
        $model = Mage::getModel($tableName)->setData($data);
        try {
            $insertId = $model->save()->getId();
            return "Data successfully inserted. Insert ID: ".$insertId;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}