<?php

class ProductImage extends CActiveRecord
{
    public $image_id;
    public $image;
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{product_image}}';
    }
    
      /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, image', 'safe'),
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }
    
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}