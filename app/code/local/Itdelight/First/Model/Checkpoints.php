<?php
class Itdelight_First_Model_Checkpoints extends Mage_Payment_Model_Method_Abstract
{

    protected $_code             = 'itdelight_first';
//    protected $_formBlockType    = 'checkbuy/form';
//    protected $_infoBlockType    = 'checkbuy/info';
    protected $canUseCheckout    = TRUE;

    public function isAvailable($quote = NULL)
    {
//        die("Message");
        return TRUE;
    }

    public function assignData($data)
    {
        if(!($data instanceof Varien_Object))
        {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setCheckNo($data->getCheckNo())->setCheckDate($data->getCheckDate());
        return $this;
    }

    public function validate()
    {
        parent::validate();

        $info = $this->getInfoInstance();

        $no      = $info->getCheckNo();
        $date    = $info->getCheckDate();
        if(empty($no) || empty($date))
        {
            $errorCode   = 'invalid_data';
            $errorMsg    = $this->_getHelper()->__('Check No and Date are required fields');
        }

        if($errorMsg)
        {
            Mage::throwException($errorMsg);
        }
        return $this;
    }

}