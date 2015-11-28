<?php

/**
 * Class Itdelight_Examination_Block_Cslider
 * @author Aleks Li
 * @company Itdelight
 */

class Itdelight_Examination_Block_Cslider extends Mage_Core_Block_Template
{

    public function getDataFromTable()
    {
        $slides = Mage::getModel('itdelight_examination/cslider')->getCollection()->addFieldToFilter('status', '1');
        return $slides;
    }

}