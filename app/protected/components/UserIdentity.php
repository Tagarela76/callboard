<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    protected $_id;

    const ERROR_EMAIL_VERIFICATION = 3;

    public function authenticate()
    {
        $user = User::model()->find('LOWER(user_email)=?', array(strtolower($this->username)));

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }elseif($user->verification_flag == 0){
            //check verification if email and password is valid
            $this->errorCode = self::ERROR_EMAIL_VERIFICATION;
        }else{
            $this->_id = $user->user_id;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

}
