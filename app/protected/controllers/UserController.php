<?php

class UserController extends Controller
{

    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * 
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    /**
     * Update User Profile
     */
    public function actionUpdateProfile()
    {
        $userId = Yii::app()->user->getId();
        //get user
        $user = User::model()->findByPk($userId);
        
        if ($userDataForm = Yii::app()->request->getParam('User')) {
            //check is user change password
            if($userDataForm['user_password'] == $user->user_password){
                //we don't need update password
                unset($userDataForm['user_password']);
            }else{
                //hash new user password
                $userDataForm['user_password'] = $user->hashPassword($userDataForm['user_password']);
            }
             $user->attributes = $userDataForm;
             $user->save();
        }
        
        $this->render('updateProfile', array('user' => $user));
    }

    /**
     * Verification of client email.
     */
    public function actionEmailVerification()
    {
        $verificationString = Yii::app()->request->getParam('vs');
        $varificationErrors = array();
        //find user by verification string
        $user = User::model()->findByAttributes(array('verification_string'=>$verificationString));
        if(isset($user)){
            $user->verification_flag = 1;
            if($user->validate()){
                $user->save();
            }else{
                //The user does not need to know about validation errors.
                $varificationErrors[] = 'Ошибка на сервере';
            }
        }else{
            $varificationErrors[] = 'Пользователь не найден';
        }
        
        $this->render('userVerification', array('varificationErrors' => $varificationErrors));
    }


    /**
     * Verification of new email.
     * @param string Client e-mail verification string
     */
    public function actionNewEmailVerification()
    {
    
        $vs = (string) $vs;

        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = 'verificationString=:verificationString';
        $criteria->params = array(':verificationString' => $vs);
        $tempData = AccTemporaryData::model()->find($criteria);

        if (!is_null($tempData)) {
            $account = Account::model()->findByPk($tempData->accId);
            if ($account->accType == 'lawyer') {
                $person = Lawyer::model()->findByPk($account->pId);
            } else {
                $person = Client::model()->findByPk($account->pId);
            }
            $account->person = $person;
            $account->login = $tempData->email;
            if ($account->validate()) {
                $account->save();
                $tempData->delete();
                $this->render('new-email-verification', array());
            } else {
                throw new CException(Yii::t('general', "Account validation error(s): {errors}", array('{errors}' => json_encode($account->getErrors()))));
            }
        } else {
            throw new CException(Yii::t('general', "Verification string is not correct"));
        }
    }

}
