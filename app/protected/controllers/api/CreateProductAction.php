<?php

class CreateProductAction extends CAction
{

    /**
     * @param string token
     * @param string productName
     * @param int productPrice
     * @param base64 productImage
     * 
     */
    public function run()
    {
        $path = '/tmp/ololo.jpg';
        $path = '/home/developer/2/p.jpg';
        $productImage = new ProductImage();
        $test = CUploadedFile::getInstance($productImage, $path);
        
        var_dump($test);die('f');
        $controller = $this->getController();
        $errors = array();
        
        $token = Yii::app()->request->getPost('token', null);
        $productName = Yii::app()->request->getPost('productName', null);
        $productPrice = Yii::app()->request->getPost('productPrice', null);
        $base64Image = Yii::app()->request->getPost('productImage', null);
        $imageName = Yii::app()->request->getPost('imageName', null);
        //get user by token
        $user = User::model()->findByAttributes(array('user_token' => $token));
        if (is_null($user)) {
            $controller->sendResponse(401, 'User not found');
            Yii::app()->end();
        }
        //create product
        $product = new Product();
        $product->user_id = $user->user_id;
        $product->product_date = time();
        $product->product_name = $productName;
        $product->product_price = $productPrice;
        
        $productImage = new ProductImage();
        $productImage->user_id = $user->user_id;
        $saveImageResult = $productImage->uploadEncodeImage($base64Image, $imageName);
        $c= new CUploadedFile('/tmp/'.$imageName);
        var_dump($c);die();
        
        
        //validate product
        $product->validate();
        
        var_dump($productImage);
    }

}