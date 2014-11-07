<?php

class ProductController extends Controller
{

    /**
     * create new Product
     */
    public function actionCreate()
    {
        $product = new Product();
        $image = new ProductImage();
        
        $userId = Yii::app()->user->getId();
        
        if ($productDataForm = Yii::app()->request->getParam('Product')) {
            $image->attributes = $_POST['ProductImage'];
            $uploadedFile = CUploadedFile::getInstance($image, 'image');
            var_dump($image);
            var_dump($uploadedFile);//die();
            $product->attributes = $productDataForm;
            $product->user_id = $userId;
            //$product->save();
        }

        $this->render('create', array('product' => $product, 'image'=>$image));
    }
    
    public function actionViewMyProductList()
    {
       $this->render('viewMyProductList'); 
    }

}