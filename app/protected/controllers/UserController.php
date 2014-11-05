<?php

class UserController extends Controller
{
    
    /**
	 * Verification of client email.
	 * @param string Client e-mail verification string
	 */
	public function actionEmailVerification($vs)
    {
        $vs = (string) $vs;

        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = 'verificationString=:verificationString';
        $criteria->params = array(':verificationString' => $vs);
        $account = Account::model()->find($criteria);

        if (!is_null($account)) {
            $client = Client::model()->with('account')->findByPk($account->pId);
            $changeFlagResult = $this->_setEmailVerificationFlag($client);
            //create openfire user
            Yii::app()->openFireService->addUserToOpenFire($account);
            if ($changeFlagResult) {
                $this->render('email_verification', array());
            }
        }
    }
    
    /**
	 * Set client email verification flag
	 * @return boolean|array of errors or true
	 */
	public function _setEmailVerificationFlag($client)
	{
		$account = $client->account;
		
		// hack to perform single table inheritance
		$account->person = $client;
		
		$account->verificationFlag = 1;
		if($account->validate()){
			$account->save();
			return true;
		}
		
		return $account->getErrors();
	}

	/**
	 * Verification of new email.
	 * @param string Client e-mail verification string
	 */
	public function actionNewEmailVerification($vs)
	{
		$vs = (string) $vs;
		
		$criteria = new CDbCriteria;
		$criteria->select = '*';
		$criteria->condition = 'verificationString=:verificationString';
		$criteria->params = array(':verificationString'=>$vs);
		$tempData = AccTemporaryData::model()->find($criteria);
		
		if (!is_null($tempData))
		{
			$account = Account::model()->findByPk($tempData->accId);
			if ($account->accType == 'lawyer')
			{
				$person = Lawyer::model()->findByPk($account->pId);
			}
			else
			{
				$person = Client::model()->findByPk($account->pId);
			}
			$account->person = $person;
			$account->login = $tempData->email;
			if ($account->validate())
			{
				$account->save();
				$tempData->delete();
				$this->render('new-email-verification',array());
			}
			else
			{
				throw new CException(Yii::t('general', "Account validation error(s): {errors}", array('{errors}'=>json_encode($account->getErrors())) ));
			}
		}
		else
		{
			throw new CException(Yii::t('general', "Verification string is not correct"));
		}
	}
}
