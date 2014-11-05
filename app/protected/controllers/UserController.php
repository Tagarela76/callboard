<?php

class UserController extends Controller
{
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
