<?php
class Itdelight_Examination_Model_Checkpoints extends Mage_Payment_Model_Method_Abstract
{

    protected $_code = 'using_points';
//    protected $_formBlockType    = 'first/form';
//    protected $_infoBlockType    = 'checkbuy/info';
    protected $canUseCheckout = true;

    public function assignData($data)
    {
        Mage::getSingleton('checkout/session')->getQuote()->getPayment()->getMethodInstance()->getTitle();

        $this->getMethodTitle();

        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setCheckNo($data->getCheckNo())->setCheckDate($data->getCheckDate());
        return $this;
    }
}