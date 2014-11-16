<div id="usergrid" class="grid-view container-fluid">
    <div class="row">
        <div class="span2">
            Изображение
        </div>
        <div class="span8">
            <?php
            echo (!empty($product->_image)) ?
                    CHtml::image($product->_image->getRealImageUrl()) :
                    CHtml::image(ProductImage::getNoImageUrl());
            ?>
        </div>
    </div>
    <div class="row">
        <div class="span2">
            Название товара
        </div>
        <div class="span8">
            <?php echo $product->product_name ?>
        </div>
    </div>
    <div class="row">
        <div class="span2">
          Цена
        </div>
        <div class="span8">
            <?php echo $product->product_price."$" ?>
        </div>
    </div>
    <div class="row">
        <div class="span2">
          Имя Пользовтеля
        </div>
        <div class="span8">
            <?php echo $product->_user->user_name ?>
        </div>
    </div>
    <div class="row">
        <div class="span2">
          Email Пользователя
        </div>
        <div class="span8">
            <?php echo $product->_user->user_email ?>
        </div>
    </div>
</div>