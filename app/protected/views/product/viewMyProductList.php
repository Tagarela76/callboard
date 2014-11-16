<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'condensed',
    'id' => 'usergrid',
    'itemsCssClass' => 'table-bordered items',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'header' => 'Изображение',
            'type' => 'html',
            'name' => '_image',
            'value' => '(!empty($data->_image))?CHtml::image($data->_image->getSmallImageUrl()):CHtml::image(ProductImage::getNoImageUrl())',
        ),
        array('name' => 'product_name', 'header' => 'Название товара'),
        array('name' => 'product_price', 'header' => 'Цена'),
        array(
            'name' => 'product_date',
            'type' => 'raw',
            'header' => 'Дата',
            'value' => 'date("d/m/Y H:i", $data->product_date)'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 32px'),
            'template' => '{update} {delete}'
        ),
    ),
));
?>