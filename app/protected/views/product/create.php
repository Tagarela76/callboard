<h1>Создание товара</h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'productCreateForm',
        'enableClientValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <div class="row">
        <?php echo CHtml::errorSummary($product); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($product, 'product_name'); ?>
        <?php echo $form->textField($product, 'product_name'); ?>
        <?php echo $form->error($product, 'product_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($product, 'product_price'); ?>
        <?php echo $form->textField($product, 'product_price'); ?>
        <?php echo $form->error($product, 'product_price'); ?>
    </div>
    <div class="row">
		<?php echo $form->labelEx($image,'image'); ?>
        <?php echo $form->fileField($image, 'image'); ?>
		<?php echo $form->error($image,'image'); ?>
	</div>
     <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn-success')); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>