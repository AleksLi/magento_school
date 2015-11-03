<?php
class Itdelight_First_Model_Observer {
    public function changeQty($observer) {
        $event = $observer->getEvent();
        $object = $event->getObject();
//        Zend_Debug::dump($observer);
//        die;
//        $observer->getData('cart')->getData();
//        $observer->getData('cart')->getData('quote')->setData(array('cart_qty'=>'20'));
//        $_POST['qty'] = "4";
//        Zend_Debug::dump($_POST);
        $quoteItem = $observer->getEvent()->getQuoteItem()->setQty('15');




    }
}

