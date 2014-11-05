<?php

class User extends CActiveRecord
{
    /**
     *
     * user id
     * 
     * @var int 
     */
    public $user_id;

    /**
     *
     * user email
     * 
     * @var string 
     */
    public $user_email;

    /**
     *
     * user password
     * 
     * @var string 
     */
    public $user_password;
    
    /**
     *
     * user name
     * 
     * @var string 
     */
    public $user_name;

    /**
     *
     * user salt
     * 
     * @var string 
     */
    public $user_salt;

    /**
     *
     * user role
     * 
     * @var string 
     */
    public $user_role;
    
    /**
     *
     * verification string
     * 
     * @var string
     */
    public $verification_string;
    
    /**
     *
     * verification flag
     * 
     * @var bool 
     */
    public $verification_flag = 0;
    
    const USER_ROLE = 'user';
    const VERIFICATION_STRING_LENGTH = 40;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{user}}';
    }

    public function primaryKey()
    {
        return 'user_id';
    }

    public function rules()
    {
        return array(
            array('user_email, user_password', 'required'),
            array('user_email', 'email'),
            array('user_email', 'unique'),
            array('user_email, user_password', 'length', 'max' => 60),
            array('user_email, user_password, verification_string, verification_flag, user_name, user_salt', 'safe'),
        );
    }

    public function relations()
    {
        return array();
    }

    /**
     * 
     * validate user password
     * 
     * @param string $user_password
     * 
     * @return boolean
     */
    public function validatePassword($user_password)
    {
        return $this->hashPassword($user_password, $this->user_salt) === $this->user_password;
    }

    /**
     * 
     * hash user password
     * 
     * @param string $user_password
     * @param string $user_salt
     * 
     * @return string
     */
    public function hashPassword($user_password, $user_salt = null)
    {
        if(is_null($user_salt)){
            if(is_null($this->user_salt)){
                $this->user_salt = $this->generateSalt();
            }
            $user_salt = $this->user_salt;
        }
        
        return md5($user_salt . $user_password);
    }

    /**
     * 
     * generate uniq salt for user password
     * 
     * @return string
     */
    protected function generateSalt()
    {
        return uniqid('', true);
    }
    
    /**
     * 
     * generate random 
     * 
     * @param int $length
     * 
     * @return string
     */
    public static function generateVerificationString($length = 32)
    {
        $chars = 'abcdefghijklmnopqrsturxyzABCDEFGHKLMNOPQRSTUXYZ0123456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }

        return $string;
        
    }

}
