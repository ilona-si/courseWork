-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 06 2016 г., 11:41
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shop_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
`id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `good_id`, `url`) VALUES
(1, 1, 'img\\item-2\\2.jpg'),
(2, 1, 'img\\item-2\\3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `size` varchar(5) NOT NULL,
  `color` varchar(100) CHARACTER SET cp1251 NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `img` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `ordered` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Goods of this shop';

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `desc`, `size`, `color`, `price`, `img`, `views`, `ordered`, `created`) VALUES
(1, 'Футболка мужская Modern', 'Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни.', 'XS', 'зелёный', 736000, 'img\\item-1\\1.jpg', 16, 0, '2016-04-29 16:28:30'),
(2, 'Футболка красная Muscle', 'Новое описание товара.', 'L', 'Красный', 480500, 'img/item-2/1.jpg', 0, 0, '2016-04-29 18:24:55'),
(3, 'Футболка мужская Envy Bear', 'Новое описание футболки Envy Bear', 'S', 'Коричневый', 350000, 'img/item-3/1.jpg', 1, 0, '2016-04-29 18:24:55'),
(4, 'Футболка унисекс Dark Space', 'Новое описание футболки Dark Space', 'XS', 'Красно-синий', 480600, 'img/item-4/1.jpg', 30, 55, '2016-04-29 18:24:55'),
(5, 'Футболка молодежная Triangles', 'Новое описание футболки Triangles', 'M', 'Синий', 212900, 'img/item-5/1.jpg', 0, 0, '2016-04-29 18:24:55'),
(6, 'Футболка женская Wolf', 'Новое описание футболки Wolf', 'XXXL', 'Черно-белый', 142900, 'img/item-6/1.jpg', 0, 0, '2016-04-29 18:24:55'),
(7, 'Футболка мужская Stripes', 'Новое описание футболки Stripes', 'XL', 'Синий', 202900, 'img/item-7/1.jpg', 3, 0, '2016-04-29 18:24:55'),
(8, 'Футболка мужская Modern Jeans', 'Новое описание футболки Modern Jeans', 'M', 'Синий', 358500, 'img/item.jpg', 1, 0, '2016-04-29 18:24:55');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
