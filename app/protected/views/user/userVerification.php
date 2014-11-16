<?php if(!empty($varificationErrors)):?>
<div>
    <?php foreach($varificationErrors as $varificationError): ?>
        <?php echo $varificationError ?><br>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div>
    Авторизация подтверждена
</div>

<?php endif; ?>
