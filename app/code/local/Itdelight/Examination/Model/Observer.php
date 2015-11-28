<?php
class Itdelight_Examination_Model_Observer {

    public function checkPoints(Varien_Event_Observer  $observer)
    {
        $payment = $observer->getPayment();
        $paymentMethod = $observer->getPayment()->getMethod();
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerPoints = $customer->getPoints();
        $orderSum = $payment->getOrder()->getGrandTotal();

        if ($paymentMethod == "using_points") {
            $currentSumPoints = $customerPoints - $orderSum;
            $customer->setPoints($currentSumPoints);
            $customer->save();
        } else {
            $currentSumPoints = $customerPoints + $orderSum;
            $customer->setPoints($currentSumPoints);
            $customer->save();
        }

    }

    public function isEnoughPoints(Varien_Event_Observer  $observer)
    {
        $event = $observer->getEvent();
        $method = $event->getMethodInstance();
        $result = $event->getResult();
        $quote = $observer->getEvent()->getQuote();
        $customerPoints = Mage::getSingleton('customer/session')->getCustomer();
        $customerPoints->getPoints();

        $allActivePaymentMethods = Mage::getModel('payment/config')->getActiveMethods();

        if (isset($allActivePaymentMethods['using_points'])) {

                if ($method->getCode() == 'using_points') {
                    $grandTotalCost = $quote->getGrandTotal();
                    if ($grandTotalCost > $customerPoints->getPoints()) {
                        $result->isAvailable = false;
                }
            }
        }
    }

    public function appendPointsColumn($observer) {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }
        if ($block->getType() == 'adminhtml/customer_grid') {

            /* @var $block Mage_Adminhtml_Block_Customer_Grid */
            $customer = $observer->getCustomer();

            $block->addColumnAfter('points', array(
                'header'=> Mage::helper('itdelight_examination')->__('Customer Points'),
                'type'  	=> 'text',
                'index' 	=> 'points',
                'renderer' => 'Itdelight_Examination_Block_Adminhtml_Customer_Points',
            ), 'name');
        }
    }

}

