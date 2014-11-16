CallBoard
=======================================================
http://511656.miabook.web.hosting-test.net/
--
-- Установка проекта
--

1)Наберите в консоле
git clone https://github.com/Tagarela76/callboard.git

2) Создайте папки с правами доступа 777

    callboard/app/protected/runtime

    callboard/app/assets

-- --------------------------------------------------------
--
-- Настройка базы данных
--

1) Создайте базу данных callboard

2) Загрузите файл callboard.sql или введите следующие команды


-- Структура таблицы `cb_product`

CREATE TABLE IF NOT EXISTS `cb_product` (
  `product_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_price` float NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `product_date` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Структура таблицы `cb_product_image`

CREATE TABLE IF NOT EXISTS `cb_product_image` (
  `image_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `real_size_image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `small_size_image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Структура таблицы `cb_user`

CREATE TABLE IF NOT EXISTS `cb_user` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_salt` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_role` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `verification_string` varchar(255) CHARACTER SET utf8 NOT NULL,
  `verification_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

3) Измените данные подлючения к базе данных.
    app/protected/config/main.php

 -- --------------------------------------------------------
--
-- Донастройка проекта
--

1) Создайте папку с правами доступа 777

    callboard/app/images

    callboard/app/images/products

-- --------------------------------------------------------

--
--Api Проекта
--

В корне проекта в папке appClient содержаться примеры работы api

Для работы примеров установите  разширение curl.

Установите библиотеку appClient/callboard/guzzle - (https://github.com/guzzle/guzzle)
-- --------------------------------------------------------
   
--
    * Авторизация
--
Метод авторизирует пользователя и отправляет token

* Url: app/index.php?r=api/login
* Method: POST
* Params:
    @param string email
    @param string pass
* Return:

    @return string token

* Example:
/appClient/callboard/login.php

Instruction:
Измените в файле следующие параметры
$url, $authForm.

--
    * Получить список всех товаров
--
Метод возвращает список всех товаров

* Url: app/index.php?r=api/getAllProductList
* Method: POST
* Params:
* Return:
    @return array(
        array(
          string 'productId',
          string 'productName',
          string 'productPrice',
          string 'productDate',
          integer 'userId',
          string 'userEmail',
          string 'productSmallImage',
          string 'productRealImage'
    )
)

* Example:
/appClient/callboard/allProduct.php

Instruction:
Измените в файле следующие параметры
$url

--
    * Получить один товар по его ID
--
Метод возвращает товар по id

* Url: app/index.php?r=api/getProductById
* Method: POST
* Params:

    @param integer productId

* Return:
    @return array(
          string 'productId',
          string 'productName',
          string 'productPrice',
          string 'productDate',
          integer 'userId',
          string 'userEmail',
          string 'productSmallImage',
          string 'productRealImage'
    )

* Example:
/appClient/callboard/productById.php

Instruction:
Измените в файле следующие параметры
$url, $data

--
    * Получить пользователя по его ID
--
Метод возвращает пользователя

* Url: app/index.php?r=api/getUserById
* Method: POST
* Params:

    @param integer userId

* Return:
    @return array(
          integer 'userId',
          string 'userEmail',
          string 'userName'
    )

* Example:
/appClient/callboard/getUserById.php

Instruction:
Измените в файле следующие параметры
$url, $data

--
    * Редактирование профиля
--

Метод редактирует профиль

* Url: app/index.php?r=api/updateProfile
* Method: POST
* Params:

    @param string token,

    @param string userEmail

    @param string userPass

    @param string userName

* Return:
    @return null

* Example:
/appClient/callboard/updateProfile.php

Instruction:
Измените в файле следующие параметры
$url, $url2, $data, $authForm

--
    * Удаление своего товара по его ID
--

Метод удаление товара по его ID

* Url: app/index.php?r=api/deleteProductById
* Method: POST
* Params:

    @param string token,

    @param integer productId


* Return:
    @return null

* Example:
/appClient/callboard/deleteProduct.php

Instruction:
Измените в файле следующие параметры
$url, $url2, $data, $authForm


--
    * Создание товара
--

Метод создает товара

* Url: app/index.php?r=api/createProduct
* Method: POST
* Params:

    @param string token,

    @param string productName
 
    @param integer productPrice

    @param base64 productImage

    @param string imageName
);


* Return:
    @return integer productId

* Example:
/appClient/callboard/createProduct.php

Instruction:
Измените в файле следующие параметры
$url, $url2, $data, $authForm


--
    * Обновление товара
--

Метод обновление товара

* Url: app/index.php?r=api/updateProduct
* Method: POST
* Params:

    @param string token,

    @param string productName
 
    @param integer productPrice

    @param base64 productImage

    @param string imageName

    @param integer productId
);


* Return:
    @return integer productId

* Example:
/appClient/callboard/updateProduct.php

Instruction:
Измените в файле следующие параметры
$url, $url2, $data, $authForm

--------------------------------------------
--
NOTE
--
Проверка типа данных и размера изображение ложится на плечи клиента