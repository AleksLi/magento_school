<?php

class Itdelight_First_IndexController extends Mage_Core_Controller_Front_Action
{

    const XML_PATH_FEEDBACK_TEMPLATE = 'feedback_form';
    const ADMIN_EMAIL = 'odesey2008@yandex.ru'; // Admin email here


    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        /* $this->loadLayout();
    $layoutHandles = $this->getLayout()->getUpdate()->getHandles();
    echo '<pre>' . print_r($layoutHandles, true) . '</pre>';*/
    }

    public function testModelAction()
    {
        $blogpost = Mage::getModel('itdelight_first/blogpost');
        echo get_class($blogpost);
    }

    public function viewAction()
    {
        var_dump(Mage::app()->getRequest()->getParams());
    }

    public function saveAction()
    {
        $post = $this->getRequest()->getPost();
        echo "<pre>";
        print_r($post);
        echo "</pre>";

        $formdata = Mage::getModel('itdelight_first/blogpost')->setData($post)->save();
        echo "<pre>";
        print_r($formdata);
        echo "</pre>";

        $title = $this->getRequest()->getParam('title'); // set My
        $content = $this->getRequest()->getParam('content'); // set My
        $status = $this->getRequest()->getParam('status'); // set My

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault(self::XML_PATH_FEEDBACK_TEMPLATE);

        $sender = array();
        $sender['title'] = $title;
        $sender['content'] = $content;
        $sender['status'] = $status;

        try {
            $feedback = new Varien_Object();
            $feedback->setData($this->getRequest()->getPost());
            $emailTemplate->sendTransactional(
                self::XML_PATH_FEEDBACK_TEMPLATE,
                $sender,
                self::ADMIN_EMAIL,
                'Admin',
                array('feedback' =>$feedback)
            );
            Mage::getSingleton('core/session')->addSuccess("Your Form Submitted Successfully");
            $this->_redirect('*/*/');
            return;

        } catch (Mage_Core_Exception $e) {
            echo $e->getMessage();
        }



//        $this->_redirect('*/*/');
    }


    public function createproductAction()
    {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID); //
    $product = Mage::getModel('catalog/product');
    $rand = rand(1, 999);
    $product
        ->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE)
        ->setAttributeSetId(4) // default attribute set
        ->setSku('example_sku' . $rand) // generate a random SKU
        ->setWebsiteIDs(array(1))
        ->setCategoryIds(array(4,10))
        ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
        ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH); // visible in catalog and search

        $product->setStockData(array(
            'use_config_manage_stock' => 0, // use global config?
            'manage_stock'            => 1, // should we manage stock or not?
            'is_in_stock'             => 1,
            'qty'                     => 5,
        ));
        $product
            ->setName('Test Product #' . $rand) // add string attribute
            ->setShortDescription('Description') // add text attribute

            // set up prices
            ->setPrice(24.50)
            ->setSpecialPrice(19.99)
            ->setTaxClassId(2)    // Taxable Goods by default
            ->setWeight(87)
        ;
        $product->save();

        $images = array(
            'thumbnail'   => '_1.JPG',
            'small_image' => '_1.JPG',
            'image'       => '_1.JPG',
        );

        $dir = Mage::getBaseDir('media') . DS . 'itdelight_posts/';

        foreach ($images as $imageType => $imageFileName) {
            $path = $dir . $imageFileName;
            if (file_exists($path)) {
                try {
                    $product->addImageToMediaGallery($path, $imageType, false);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "Can not find image by path: `{$path}`<br/>";
            }
        }

        echo "everything is ok";
    }


}