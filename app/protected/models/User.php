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
    
    const USER_ROLE = 'user';

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
        );
    }

    public function relations()
    {
        return array();
    }

    public function validatePassword($user_password)
    {
        return $this->hashPassword($user_password, $this->user_salt) === $this->user_password;
    }

    public function hashPassword($user_password, $user_salt = null)
    {
        if(is_null($user_salt)){
            if(is_null($this->user_salt)){
                $this->user_salt = $this->generateSalt();
            }
            $user_salt = $this->user_salt;
        }
        
        $this->user_password = md5($user_salt . $user_password);
        
        return $this->user_password;
    }

    protected function generateSalt()
    {
        return uniqid('', true);
    }

}
