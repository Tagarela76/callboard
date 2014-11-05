-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 05 2014 г., 16:44
-- Версия сервера: 5.5.40-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `callboard`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cb_user`
--

CREATE TABLE IF NOT EXISTS `cb_user` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_salt` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_role` varchar(255) CHARACTER SET utf8 NOT NULL,
  `verification_string` varchar(255) CHARACTER SET utf8 NOT NULL,
  `verification_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `cb_user`
--

INSERT INTO `cb_user` (`user_id`, `user_email`, `user_password`, `user_salt`, `user_name`, `user_role`, `verification_string`, `verification_flag`) VALUES
(1, 'DisidentD@mail.ru', 'bb3cf80efa986216266c0d5762e4f327', '5459cedab37e41.60941021', 'Denis', 'user', '', 0),
(8, 'denis.kv@kttsoft.com', 'ad6ec0ca1b91efd7fb97c8c782a53f38', '5459eab236e3f6.14947151', 'developer', 'user', '4UEjySoxN3YKDZQmYdbhNsXy6cTEfrh9hNiFuy6a', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
