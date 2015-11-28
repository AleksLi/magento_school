<?php

class Itdelight_Examination_Block_Adminhtml_Manageslides_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
//        $helper = Mage::helper('itdelight_first');
        $model = Mage::registry('slides_data');
//        Zend_Debug::dump($model);

        if (Mage::getSingleton('adminhtml/session')->getPostsData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getPostsData();
            Mage::getSingleton('adminhtml/session')->getPostsData(null);
        }
        elseif (Mage::registry('slides_data'))
        {
            $data = Mage::registry('slides_data');
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
            'legend' => Mage::helper('itdelight_examination')->__('Slide Information')
        ));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('itdelight_examination')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
            'note'     => Mage::helper('itdelight_examination')->__('The name of the post.'),
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('itdelight_examination')->__('Status'),
            'title'     => Mage::helper('itdelight_examination')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'value'  => '1',
            'values' => array('1' => 'Enabled', '2' => 'Disabled'),
            'disabled' => false,

        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('itdelight_examination')->__('Image'),
            'name' => 'image',
        ));

        if($data->getData('image')){
            $data->setData('image','itdelight_slides/'.$model->getData('image'));
        } else {
            $data->setData('image', $model->getData('image'));
        }

        $form->setValues($data->getData());

        return parent::_prepareForm();
    }
}