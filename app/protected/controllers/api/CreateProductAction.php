<?php

class CreateProductAction extends CAction
{

    public function run()
    {
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
        $product->save();

        //create image
        if (!is_null($base64Image) && !is_null($imageName) && empty($product->getErrors())) {
            $productImage = new ProductImage();
            $ext = end(explode('.', $imageName));
            $hashImageName = md5($imageName) . time() . '.' . $ext;
            $productImage->real_size_image_name = 'real_size_'.$hashImageName;
            $productImage->small_size_image_name = 'small_size_'.$hashImageName;
            $productImage->image = $imageName;
            $productImage->user_id = $user->user_id;
            $productImage->product_id = $product->product_id;
            $productImage->save(false);
            
            $path = Yii::app()->basePath . '/..'.ProductImage::SAVE_IMAGE_PATH . $user->user_id;
            
            $imageData = base64_decode($base64Image);
            file_put_contents($path .'/'. $productImage->real_size_image_name, $imageData);
            //load new image from existing one
            $smallImage = ImageEditor::createFromFile($path . '/' . $productImage->real_size_image_name);
            //resize image
            $smallImage->resize(50, 50);
            //save image
            $smallImage->save($path . '/' . $productImage->small_size_image_name, $ext);
            
            $controller->sendResponse(200, 'ok');
            
        }
    }

}
