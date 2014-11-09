<?php

$this->pageTitle=Yii::app()->name . ' - Создание товара';

?>

<h1>Создание товара</h1>

<?php $this->renderPartial('_form', array('product' => $product, 'image'=>$image)); ?>