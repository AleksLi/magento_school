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

        $name = $this->getRequest()->getParam('name'); // set My
        $email = $this->getRequest()->getParam('name'); // set My
        $content = $this->getRequest()->getParam('name'); // set My

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault(self::XML_PATH_FEEDBACK_TEMPLATE);

        $sender = array();
        $sender['name'] = $name;
        $sender['email'] = $email;
        $sender['content'] = $content;

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
            Mage::getSingleton('core/session')->addSuccess("Your feedback Submitted Successfully");
            $this->_redirect('*/*/');
            return;

        } catch (Mage_Core_Exception $e) {
            echo $e->getMessage();
        }



//        $this->_redirect('*/*/');
    }


}