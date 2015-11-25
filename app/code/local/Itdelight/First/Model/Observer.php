<?php
class Itdelight_First_Model_Observer {

    public function changeQty($observer)
    {
        $event = $observer->getEvent();
//        $observer->getData();
//        $quoteItem = $observer->getQuoteItem();
        $model = Mage::getModel('itdelight_first/quantity');
        $model->getCollection();

//        Zend_Debug::dump($observer);
//        die;
//        $observer->getData('cart')->getData();
//        $observer->getData('cart')->getData('quote')->setData(array('cart_qty'=>'20'));
//        $_POST['qty'] = "4";
//        Zend_Debug::dump($_POST);
//        $quoteItem = $observer->getEvent()->getQuoteItem()->setQty('15');

        try {
            $quoteItem = $observer->getQuoteItem();

            if(is_null($quoteItem->getParentItem())) {
                $qty_my = $quoteItem->getQty();
                $qty = $qty_my * 2;
                $quoteItem->setQty($qty);
                $quoteItem->setQtyToAdd($qty);
            } else {
                $qty_my = $quoteItem->getParentItem()->getQty();
                $qty = $qty_my * 2;
                $quoteItem->getParentItem()->setQty($qty);
                $quoteItem->getParentItem()->setQtyToAdd($qty);
            }
        } catch(Exception $e) {
            mage::logException($e);
        }


    }

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
        $customerPoints = Mage::getSingleton('customer/session')->getCustomer(); //->getPoints(); //good decision is OK
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
}

