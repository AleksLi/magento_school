<?php

class Itdelight_First_Block_Adminhtml_Quantity_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {

        if (Mage::getSingleton('adminhtml/session')->getPostsData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getPostsData();
            Mage::getSingleton('adminhtml/session')->getPostsData(null);
        }
        elseif (Mage::registry('posts_data'))
        {
            $data = Mage::registry('posts_data')->getData();
        }
        else
        {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));
        $form->setUseContainer(true);

        $this->setForm($form);


        $helper = Mage::helper('itdelight_first');

        $fieldset = $form->addFieldset('qty_form', array('legend' => $helper->__('Qty Information')));

        $fieldset->addField('title', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('quantity', 'text', array(
            'label' => $helper->__('Quantity'),
            'required' => true,
            'name' => 'quantity',
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }

}