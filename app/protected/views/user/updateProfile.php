<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'profileForm',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <div class="row">
        <?php echo CHtml::errorSummary($user); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($user, 'user_email'); ?>
        <?php echo $form->textField($user, 'user_email'); ?>
        <?php echo $form->error($user, 'user_email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($user, 'user_password'); ?>
        <?php echo $form->passwordField($user, 'user_password'); ?>
        <?php echo $form->error($user, 'user_password'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($user, 'user_name'); ?>
        <?php echo $form->textField($user, 'user_name'); ?>
        <?php echo $form->error($user, 'user_name'); ?>
    </div>
     <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn-success')); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>