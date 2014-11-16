<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование товара';
?>

<h1>Редактирование товара</h1>
<div>
    <?php echo  (!empty($product->_image))?CHtml::image($product->_image->getRealImageUrl()):CHtml::image(ProductImage::getNoImageUrl())?>
</div>
<?php $this->renderPartial('_form', array('product' => $product, 'image'=>$image)); ?>