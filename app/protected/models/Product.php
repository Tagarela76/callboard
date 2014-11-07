<?php

class Product extends CActiveRecord
{
    /**
     *
     * product id
     * 
     * @var int
     */
    public $product_id;

    /**
     *
     * product name
     * 
     * @var string 
     */
    public $product_name;

    /**
     *
     * product price
     * 
     * @var float 
     */
    public $product_price;
    
    /**
     *
     * user id
     * 
     * @var int 
     */
    public $user_id;

    
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    public function tableName()
    {
        return '{{product}}';
    }

    public function primaryKey()
    {
        return 'product_id';
    }
    
    public function rules()
    {
        return array(
            array('product_name, product_price, user_id', 'required', 'message'=>'{attribute} не может быть пустым.'),
            array('product_price', 'type', 'type'=>'float'),
            array('product_name, product_price, user_id', 'safe'),
        );
    }

    public function relations()
    {
        return array();
    }
    
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'product_name' => 'Название',
            'product_price' => 'Цена',
        );
    }

}