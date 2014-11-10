<?php

class LoginAction extends CAction
{

    public function run()
    {
        $controller = $this->getController();
        $email = Yii::app()->request->getPost('email', null);
        $pass = Yii::app()->request->getPost('pass', null);
        //check data
        if (is_null($pass) || is_null($email)) {
            $controller->sendResponse(500, 'No data');
            Yii::app()->end();
        }
        //check user auth   
        $user = User::model()->find('LOWER(user_email)=?', array(strtolower($email)));
        if (is_null($user)) {
            $controller->sendResponse(401, 'User not found');
            Yii::app()->end();
        }

        if (!$user->validatePassword($pass)) {
            $controller->sendResponse(401, 'Incorrect password');
            Yii::app()->end();
        }

        if ($user->verification_flag == 0) {
            $controller->sendResponse(401, 'This user has not confirmed');
            Yii::app()->end();
        }
        $data = array(
            "token" => $user->user_token
        );
        
        //send user token
        $controller->sendResponse(200, 'ok', $data);
    }

}