<?php

class AllProductListAction extends CAction
{
    public function run()
    {
        $controller = $this->getController();
        $productList = Product::model()->findAll();
        $result = array();
        //generate product List Responce
        foreach($productList as $product){
            $newProduct = array();
            $newProduct['productId'] = $product->product_id;
            $newProduct['productName'] = $product->product_name;
            $newProduct['productPrice'] = $product->product_price;
            $newProduct['productDate'] = $product->product_date;
            $newProduct['userId'] = $product->user_id;
            $newProduct['userEmail'] = $product->_user->user_email;
            $newProduct['productSmallImage'] = $product->_image->getSmallImageUrl();
            $newProduct['productRealImage'] = $product->_image->getRealImageUrl();
            $result[] = $newProduct;
        }
        
        $data = array(
            "productList" => $result
        );
        
        //send response
        $controller->sendResponse(200, 'ok', $data);
    }
    
}

