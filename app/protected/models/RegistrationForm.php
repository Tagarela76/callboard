<?php

class RegistrationForm extends CFormModel
{
    /**
     *
     * user name
     * 
     * @var string 
     */
    public $user_name;
    
    /**
     *
     * user password
     * 
     * @var string 
     */
    public $password;
    
    /**
     *
     * user email
     * 
     * @var string 
     */
    public $email;
    
    /**
     *
     * confirm password
     * 
     * @var string 
     */
    public $confirm_password;

    public function rules()
    {
        return array(
            // username and password are required
            array('email, user_name, password, confirm_password', 'required'),
            array('email', 'email'),
            array('password, confirm_password', 'length', 'min'=>6, 'max'=>40),
            array('confirm_password', 'compare', 'compareAttribute'=>'password'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'user_name' => 'Имя',
            'password' => 'Пароль',
            'confirm_password' => 'Подтверждение Пароля' 
        );
    }

}
