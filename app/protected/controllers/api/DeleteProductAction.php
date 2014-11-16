<?php

class DeleteProductAction extends CAction
{
    public function run()
    {
        $controller = $this->getController();
        
        $token = Yii::app()->request->getPost('token', null);
        $productId = Yii::app()->request->getPost('productId', null);
        
        if(is_null($token) || is_null($productId)){
            $controller->sendResponse(500, 'No data');
            Yii::app()->end();
        }
        $user = User::model()->findByAttributes(array('user_token' => $token));
        
        if (is_null($user)) {
            $controller->sendResponse(401, 'not authorized');
            Yii::app()->end();
        }
        
        $product = Product::model()->findByPk($productId);
        
        if (is_null($product)) {
            $controller->sendResponse(500, 'product not found');
            Yii::app()->end();
        }
        
        if($product->user_id == $user->user_id){
            $product->delete();
            $controller->sendResponse(200, 'ok');
            Yii::app()->end();
        }else{
            $controller->sendResponse(500, 'You can not delete foreign product');
            Yii::app()->end();
        }
        
        
    }
    
}

