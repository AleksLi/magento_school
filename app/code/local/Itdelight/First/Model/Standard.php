<?php

class Itdelight_First_Model_Standard extends Mage_Payment_Model_Method_Abstract
{

    protected $_code = 'itdelight_first';

    protected $_isInitializeNeeded      = true;
    protected $_canUseInternal          = false;
    protected $_canUseForMultishipping  = false;

    /**
     * Return Order place redirect ursl
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        //when you click on place order you will be redirected on this url, if you don't want this action remove this method
        return Mage::getUrl('first/standard/redirect', array('_secure' => true));
    }

}