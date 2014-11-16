<?php

class MailService extends Service
{
    const VERIFICATION_MAIL_SUBJECT = 'Подтверждение регистрации CallBoard';
    
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
        //generate varification url
        $url = Yii::app()->createAbsoluteUrl('user/emailVerification');
        
        $mail = new YiiMailer();
        $mail->isHTML(true); 
        $mail->setView('verificationEmail');
        $mail->setData(array('user' => $user, 'url' => $url));
        $mail->setFrom(Yii::app()->params->adminEmail);
        //$mail->setTo('denis.kv76@gmail.com');
        $mail->setTo($user->user_email);
        $mail->setSubject(self::VERIFICATION_MAIL_SUBJECT);
        
        return $mail->send();
        
    }
}

