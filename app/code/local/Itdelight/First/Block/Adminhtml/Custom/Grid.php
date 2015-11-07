<?php

class Itdelight_First_Block_Adminhtml_Custom_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('itdelight_first/blogpost')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('itdelight_first');

        $this->addColumn('blogpost_id', array(
            'header' => $helper->__('Post ID'),
            'index' => 'blogpost_id',
            'width'     => '80px',
        ));

        $this->addColumn('image', array(
            'header'    => Mage::helper('itdelight_first')->__('Post Image'),
            'align'     => 'left',
            'index'     => 'image',
            'width'     => '100',
            'renderer'  => 'Itdelight_First_Block_Adminhtml_Custom_Renderer_Image'
        ));

        $this->addColumn('title', array(
            'header' => $helper->__('Title'),
            'index' => 'title',
            'type' => 'text',
        ));

        $this->addColumn('products', array(
            'header' => $helper->__('Products'),
            'index' => 'product_id',
            'options' => $helper->getProductList(),
            'type'  => 'options',
//            'width' => '150px',
        ));

        $this->addColumn('status', array(
            'header'    => $helper->__('Status'),
            'index'     => 'status',
            'type'      => 'options',
            'width'     => '100',
            'options'   => array(
                '1' => $helper->__('Enabled'),
                '2' => $helper->__('Disabled'),
            ),
        ));

        $this->addColumn('created', array(
            'header' => $helper->__('Created'),
            'index' => 'created',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }
}