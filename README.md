CallBoard

--
-- Установка проекта
--

1)Наберите в консоле
git clone https://github.com/Tagarela76/callboard.git

2) Создайте папки с правами доступа 777
    callboard/app/protected/runtime
    callboard/app/assets

-- --------------------------------------------------------

Настройка базы данных

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
   
