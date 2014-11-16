<?php

class ProductController extends Controller
{

    const PAGINATION_COUNT = 10;

    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * 
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('allow',
                'users' => array('*'),
                'actions'=> array('viewAllProductList')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * create new Product
     */
    public function actionCreate()
    {
        $product = new Product();
        $image = new ProductImage();

        $userId = Yii::app()->user->getId();

        if ($productDataForm = Yii::app()->request->getParam('Product')) {
            $product->attributes = $productDataForm;
            $product->user_id = $userId;
            $product->product_date = time();
            //get image
            if ($productImageForm = Yii::app()->request->getParam('ProductImage')) {
                $image->attributes = $productImageForm;
                $image->image = CUploadedFile::getInstance($image, 'image');
                $image->user_id = $userId;
            }
            //validate models
            $productError = $product->validate();
            $imageError = $image->validate();

            //save if everything ok
            if ($productError && $imageError) {
                $product->save();
                $image->product_id = $product->product_id;
                $image->save();
                $this->redirect('index.php?r=product/viewMyProductList');
            }
        }

        $this->render('create', array('product' => $product, 'image' => $image));
    }

    /**
     * update product
     */
    public function actionUpdate($id)
    {
        //load product
        $product = $this->loadModel($id);
        $image = $product->_image;
        if (is_null($image)) {
            //create new image for upload if image not exist
            $image = new ProductImage();
        }
        $userId = Yii::app()->user->getId();
        //image validate - set true for saving correct, if user nor upload new image
        $imageValidate = true;

        //update product information
        if ($productDataForm = Yii::app()->request->getParam('Product')) {
            $product->attributes = $productDataForm;
            $product->product_date = time();
            //validate model
            $productValidate = $product->validate();

            //update image if we need
            if ($productImageForm = Yii::app()->request->getParam('ProductImage')) {
                //create new image
                $newImage = new ProductImage();
                $newImage->attributes = $productImageForm;
                $cUploadImage = CUploadedFile::getInstance($newImage, 'image');
                //check if user make new upload
                if (!is_null($cUploadImage)) {
                    $newImage->image = $cUploadImage;
                    $newImage->user_id = $userId;
                    $newImage->product_id = $product->product_id;
                    //validate image
                    $imageValidate = $newImage->validate();
                }
            }
            //save if everything ok
            if ($productValidate && $imageValidate) {
                //save product
                $product->save();
                //check is user update new image. $cUploadImage exist in this case
                if (!is_null($cUploadImage)) {
                    //check is image exist before, or we create it for uploading
                    if (!$image->isNewRecord) {
                        //delete old image
                        $image->delete();
                    }
                    //save new image
                    $newImage->save();
                }
                $this->redirect('index.php?r=product/viewMyProductList');
            }
        }

        $this->render('update', array('product' => $product, 'image' => $image));
    }

    /**
     * view my product list
     */
    public function actionViewMyProductList()
    {
        $userId = Yii::app()->user->getId();

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => array(
                'condition' => 'user_id=' . $userId,
            ))
        );

        $this->render('viewMyProductList', array('dataProvider' => $dataProvider));
    }

    /**
     * 
     * view all product list
     * 
     */
    public function actionViewAllProductList()
    {
        $dataProvider = new CActiveDataProvider('Product', array(
            'pagination' => array('pageSize' => self::PAGINATION_COUNT),
            'criteria' => array(
                'order' => 'product_date DESC',
            )
        ));

        $this->render('viewAllProductList', array('dataProvider' => $dataProvider));
    }
    
    /**
     * 
     * view product
     * 
     * @param int $id
     */
    public function actionViewProduct($id)
    {
        $product = $this->loadModel($id);
        
        $this->render('viewProduct', array('product' => $product));
    }

    /**
     * 
     * delete product
     * 
     * @param int $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
    }

    /**
     * 
     * load Product model
     * 
     * @param int $id
     * 
     * @return Product
     * 
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Product::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Такой записи не существует.');
        }
        return $model;
    }

}
