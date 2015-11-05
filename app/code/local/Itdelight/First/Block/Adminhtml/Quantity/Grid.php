<?php

class Itdelight_First_Block_Adminhtml_Quantity_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('itdelight_first/quantity')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('itdelight_first');

        $this->addColumn('quantity_id', array(
            'header' => $helper->__('Quantity ID'),
            'index' => 'quantity_id',
            'width'     => '80px',
        ));

        $this->addColumn('title', array(
            'header' => $helper->__('Title'),
            'index' => 'title',
            'type' => 'text',
        ));

        $this->addColumn('quantity', array(
            'header' => $helper->__('Quantity'),
            'index' => 'quantity',
            'type' => 'text',
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