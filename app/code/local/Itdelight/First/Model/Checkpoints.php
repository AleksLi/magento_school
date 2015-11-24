<?php
class Itdelight_First_Model_Checkpoints extends Mage_Payment_Model_Method_Abstract
{

    protected $_code = 'using_points';
//    protected $_formBlockType    = 'first/form';
//    protected $_infoBlockType    = 'checkbuy/info';
    protected $canUseCheckout = true;

//    public function isAvailable($quote = NULL)
//    {
////        die("Message");
//        return TRUE;
//    }

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

    public function echoData($data)
    {
        echo "<h1>" . $data . "This is true</h1>";
    }

    public function getEx()
    {
        echo "TRUE TRUE TRUE";
    }

}