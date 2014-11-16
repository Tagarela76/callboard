<?php

class UpdateProfileAction extends CAction
{
    public function run()
    {
        $controller = $this->getController();
        $token = Yii::app()->request->getPost('token', null);
        $userEmail = Yii::app()->request->getPost('userEmail', null);
        $userPass = Yii::app()->request->getPost('userPass', null);
        $userName = Yii::app()->request->getPost('userName', null);
        
        
        if(is_null($token)){
            $controller->sendResponse(500, 'No data');
            Yii::app()->end();
        }
        $user = User::model()->findByAttributes(array('user_token' => $token));
        
        if (is_null($user)) {
            $controller->sendResponse(401, 'not authorized');
            Yii::app()->end();
        }
        
        $user->user_email = $userEmail;
        $user->user_password = $user->hashPassword($userPass);
        $user->user_name = $userName;
        
        if(!$user->save()){
            $controller->sendResponse(500, 'ok', $user->getErrors());
        }
        
        $controller->sendResponse(200, 'ok');
    }
}