<?php
class Itdelight_First_Model_Observer {
    public function changeQty($observer) {
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
}

