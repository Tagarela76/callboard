<?php

class ProductImage extends CActiveRecord
{

    /**
     *
     * image id
     * 
     * @var int 
     */
    public $image_id;

    /**
     *
     * image
     * 
     * @var CUploadFile 
     */
    public $image;

    /**
     *
     * user id
     * 
     * @var int 
     */
    public $user_id;

    /**
     *
     * real size image name
     * 
     * @var string 
     */
    public $real_size_image_name;

    /**
     *
     * small size image name
     * 
     * @var string 
     */
    public $small_size_image_name;

    /**
     *
     * product id
     * 
     * @var int 
     */
    public $product_id;

    const SAVE_IMAGE_PATH = '/images/products/';

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
            array('image', 'required', 'message'=>'Пожалуйста загрузите рисунок'),
            array('image_id, image, user_id', 'safe'),
            array('image', 'file', 'types' => 'jpg, png', 'maxSize'=>1024*1024*5,'tooLarge'=>'Максимальный размер файла 5MB'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        //check is image CUploaded file or string
        if($this->image instanceof CUploadedFile){
            $this->uploadImage();
        }
        
        return parent::beforeSave();
    }
    
    public function beforeDelete()
    {
        $smallImagePath = $this->getSmallImagePath();
        $realImagePath = $this->getRealImagePath();
        if($smallImagePath && file_exists($smallImagePath)){
            unlink($smallImagePath);
        }
        if($realImagePath && file_exists($realImagePath)){
            unlink($realImagePath);
        }
        
        return parent::beforeDelete();
    }

    /**
     * 
     * upload image
     * 
     * @return boolean
     */
    public function uploadImage()
    {
        $path = Yii::app()->basePath . '/..'.self::SAVE_IMAGE_PATH . $this->user_id;
        //check is folder exist
        if (!file_exists($path)) {
            //create user folder for image upload.
            mkdir($path, 0777, true);
        }
        //check is image isset
        if (isset($this->image)) {
            //generate random image name
            $imageName = $this->generateImageName();
            $realSizeImageName = 'real_size_' . $imageName;
            $smallSizeImageName = 'small_size_' . $imageName;

            $this->real_size_image_name = $realSizeImageName;
            $this->small_size_image_name = $smallSizeImageName;
            //save real image
            $this->image->saveAs($path . '/' . $realSizeImageName);
            //load new image from existing one
            $smallImage = ImageEditor::createFromFile($path . '/' . $realSizeImageName);
            //resize image
            $smallImage->resize(50, 50);
            //save image
            $smallImage->save($path . '/' . $smallSizeImageName, $this->image->extensionName);
        } else {
            return false;
        }
    }

    /**
     * 
     * generate random image name
     * 
     * @return string
     */
    private function generateImageName()
    {
        if (isset($this->image)) {
            $time = time();

            return md5($this->image->name) . $time . '.' . $this->image->extensionName;
        }
    }
    
    /**
     * 
     * get small image url
     * 
     * @return string
     */
    public function getSmallImageUrl()
    {
        $url = Yii::app()->getBaseUrl(true) . self::SAVE_IMAGE_PATH . 
                $this->user_id . '/' . $this->small_size_image_name;
        if (!file_exists($url)) {
            return $url;
        }else{
            return self::getNoImageUrl();
        }
        
    }
    
    /**
     * 
     * get real image url
     * 
     * @return string
     */
    public function getRealImageUrl()
    {
        $url = Yii::app()->getBaseUrl(true) . self::SAVE_IMAGE_PATH . 
                $this->user_id . '/' . $this->real_size_image_name;
        if (!file_exists($url)) {
            return $url;
        }else{
            return self::getNoImageUrl();
        }
        
    }
    /**
     * 
     * get small image path
     * 
     * @return boolean|string
     */
    public function getRealImagePath()
    {
        $path = Yii::app()->basePath . '/..'.self::SAVE_IMAGE_PATH . 
                $this->user_id . '/' . $this->real_size_image_name;
        if (file_exists($path)) {
            return $path;
        }else{
            return false;
        }
    }
    
    /**
     * 
     * get small image path
     * 
     * @return boolean|string
     */
    public function getSmallImagePath()
    {
        $path = Yii::app()->basePath . '/..'.self::SAVE_IMAGE_PATH . 
                $this->user_id . '/' . $this->small_size_image_name;
        if (file_exists($path)) {
            return $path;
        }else{
            return false;
        }
    }
    
    /**
     * get No Image Url
     */
    public static function getNoImageUrl()
    {
        return Yii::app()->getBaseUrl(true) . self::SAVE_IMAGE_PATH . 'small_size_no_image.jpg';
    }

}
