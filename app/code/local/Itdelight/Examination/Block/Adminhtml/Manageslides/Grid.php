<?php

class Itdelight_Examination_Block_Adminhtml_Manageslides_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('itdelight_examination/cslider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addExportType('*/*/exportCsv', Mage::helper('itdelight_examination')->__('CSV'));

        $helper = Mage::helper('itdelight_examination');

        $this->addColumn('cslider_id', array(
            'header' => $helper->__('Slider ID'),
            'index' => 'cslider_id',
            'width'     => '80px',
        ));

        $this->addColumn('image', array(
            'header'    => Mage::helper('itdelight_examination')->__('Slider Image'),
            'align'     => 'left',
            'index'     => 'image',
            'width'     => '100',
            'renderer'  => 'Itdelight_Examination_Block_Adminhtml_Manageslides_Renderer_Image'
        ));

        $this->addColumn('title', array(
            'header' => $helper->__('Title'),
            'index' => 'title',
            'type' => 'text',
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