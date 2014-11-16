<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'registrationForm',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <div class="row">
        <?php echo CHtml::errorSummary($model); ?>
        <?php echo CHtml::errorSummary($user); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->textField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'confirm_password'); ?>
        <?php echo $form->textField($model, 'confirm_password'); ?>
        <?php echo $form->error($model, 'confirm_password'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'user_name'); ?>
        <?php echo $form->textField($model, 'user_name'); ?>
        <?php echo $form->error($model, 'user_name'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Зарегестрироваться', array('class' => 'btn-success')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
