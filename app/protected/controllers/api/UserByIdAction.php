<?php

class UserByIdAction extends CAction
{
    public function run()
    {
        $controller = $this->getController();
        
        $userId = Yii::app()->request->getPost('userId', null);
        
        if(is_null($userId)){
            $controller->sendResponse(500, 'No data');
            Yii::app()->end();
        }
        //find product
        $user = User::model()->findByPk($userId);
        
        if(is_null($user)){
           $controller->sendResponse(500, 'User not found');
           Yii::app()->end(); 
        }
        
        $response = array();
        $response['userId'] = $user->user_id;
        $response['userEmail'] = $user->user_email;
        $response['userName'] = $user->user_name;
        
        $data = array(
            "user" => $response
        );

        //send response
        $controller->sendResponse(200, 'ok', $data);
    }
}

