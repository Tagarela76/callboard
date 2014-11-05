<?php

class MailService extends Service
{
    const VERIFICATION_MAIL_SUBJECT = 'Спасибо за регистрацию';
    
    /**
     * 
     * send user varification letter
     * 
     * @param User $user
     * 
     * @return boolean
     */
    public function sendVerificationEmail($user)
    {
        if(is_null($user)){
            return false;
        }
        
        $mail = new YiiMailer();
        $mail->isHTML(true); 
        $mail->setView('verificationEmail');
        $mail->setData(array('user' => $user));
        $mail->setFrom(Yii::app()->params->adminEmail);
        $mail->setTo('denis.kv@kttsoft.com');
        //$mail->setTo($user->user_email);
        $mail->setSubject(self::VERIFICATION_MAIL_SUBJECT);
        
        return $mail->send();
        
    }
}

