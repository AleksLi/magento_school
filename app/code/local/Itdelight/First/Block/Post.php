<?php

class Itdelight_First_Block_Post extends Mage_Core_Block_Template
{
    /**
     * To add data into itdelight_first_blogposts table
     *
     * @return object
     */
    public function getDataFromTable()
    {
        $posts = Mage::getModel('itdelight_first/blogpost')->getCollection();
        return $posts;
    }

    /**
     * To add data into itdelight_first_blogposts table
     *
     * @var $title string
     * @var $content string
     * @return success or log message
     */
    public function addDataToTable($title, $content)
    {
        $data = array('title'=>$title, 'content'=> $content);
        $model = Mage::getModel('itdelight_first/blogpost')->setData($data);
        try {
            $insertId = $model->save()->getId();
            return "Data successfully inserted. Insert ID: ".$insertId;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}