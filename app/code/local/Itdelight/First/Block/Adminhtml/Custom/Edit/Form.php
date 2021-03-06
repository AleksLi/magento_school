<?php

class Itdelight_First_Block_Adminhtml_Custom_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
//        $helper = Mage::helper('itdelight_first');
        $model = Mage::registry('posts_data');
//        Zend_Debug::dump($model);

        if (Mage::getSingleton('adminhtml/session')->getPostsData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getPostsData();
            Mage::getSingleton('adminhtml/session')->getPostsData(null);
        }
        elseif (Mage::registry('posts_data'))
        {
            $data = Mage::registry('posts_data');
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

        $fieldset = $form->addFieldset('edit_form', array(
            'legend' => Mage::helper('itdelight_first')->__('Post Information')
        ));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('itdelight_first')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
            'note'     => Mage::helper('itdelight_first')->__('The name of the post.'),
        ));

        $fieldset->addField('content', 'text', array(
            'label'     => Mage::helper('itdelight_first')->__('Description'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'content',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('itdelight_first')->__('Status'),
            'title'     => Mage::helper('itdelight_first')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'value'  => '1',
            'values' => array('1' => 'Enabled', '2' => 'Disabled'),
            'disabled' => false,
           /* 'options'   => array(
                '1' => Mage::helper('itdelight_first')->__('Enabled'),
                '0' => Mage::helper('itdelight_first')->__('Disabled'),
            ),*/

        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('itdelight_first')->__('Image'),
            'name' => 'image',
        ));

        $fieldset->addField('product_id', 'select', array(
            'label' => Mage::helper('itdelight_first')->__('Product Name'),
            'name' => 'product_id',
            'values' => Mage::helper('itdelight_first')->getProductList(), //
        ));

        if($data->getData('image')){
            $data->setData('image','itdelight_posts/'.$model->getData('image'));
        } else {
            $data->setData('image', $model->getData('image'));
        }

        $form->setValues($data->getData());

        return parent::_prepareForm();
    }
}