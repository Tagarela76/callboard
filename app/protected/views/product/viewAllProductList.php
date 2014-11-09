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
        array(
            'name' => 'product_name',
            'type' => 'raw',
            'header' => 'Название товара',
            'value' => 'CHtml::link($data->product_name, array("product/viewProduct", "id" => $data->product_id ))'
        ),
        array(
            'name' => 'product_price',
            'header' => 'Цена',
            'value' => '$data->product_price."$"'
            ),
        array(
            'name' => 'product_date',
            'type' => 'raw',
            'header' => 'Дата',
            'value' => 'date("d/m/Y H:s", $data->product_date)'
        ),
        array(
            'name' => 'user_email',
            'type' => 'raw',
            'header' => 'Пользователь',
            'value' => '$data->_user->user_email'
        ),
    ),
));
?>