<?php

class ProductByIdAction extends CAction
{

    public function run()
    {
        $controller = $this->getController();
        //get product id
        $productId = Yii::app()->request->getPost('productId', null);
        
        if(is_null($productId)){
            $controller->sendResponse(500, 'No data');
            Yii::app()->end();
        }
        //find product
        $product = Product::model()->findByPk($productId);
        
        if(is_null($product)){
           $controller->sendResponse(500, 'Product not found');
           Yii::app()->end(); 
        }
        
        //generate product List Responce
        $newProduct = array();
        $newProduct['productId'] = $product->product_id;
        $newProduct['productName'] = $product->product_name;
        $newProduct['productPrice'] = $product->product_price;
        $newProduct['productDate'] = $product->product_date;
        $newProduct['userId'] = $product->user_id;
        $newProduct['userEmail'] = $product->_user->user_email;
        $newProduct['productSmallImage'] = $product->_image->getSmallImageUrl();
        $newProduct['productRealImage'] = $product->_image->getRealImageUrl();

        $data = array(
            "product" => $newProduct
        );

        //send response
        $controller->sendResponse(200, 'ok', $data);
    }

}