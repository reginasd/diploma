-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 11 2019 г., 10:55
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dione`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_flower_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `client_id`, `order_flower_id`, `packaging_id`, `quantity`, `sum`) VALUES
(33, 11, 19, 3, 1, 943),
(34, 6, 20, 1, 1, 239),
(35, 6, 21, 4, 1, 1391),
(36, 6, 22, 2, 1, 2342),
(38, 14, 24, 2, 1, 695);

-- --------------------------------------------------------

--
-- Структура таблицы `bouquets`
--

CREATE TABLE `bouquets` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `flower_color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bouquet_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bouquet_flower`
--

CREATE TABLE `bouquet_flower` (
  `id` int(11) NOT NULL,
  `bouquet_id` int(11) NOT NULL,
  `flower_color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color`) VALUES
(1, 'Белый', 'white.jpg'),
(2, 'Красный', 'red.jpg'),
(3, 'Розовый', 'pink.jpg'),
(4, 'Бордовый', 'bordeux.jpg'),
(5, 'Желтый', ''),
(6, 'Кремовый', ''),
(7, 'Сиреневый', ''),
(8, 'Оранжевый', ''),
(9, 'Синий', ''),
(10, 'Малиновый', '');

-- --------------------------------------------------------

--
-- Структура таблицы `flowers`
--

CREATE TABLE `flowers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flowers`
--

INSERT INTO `flowers` (`id`, `name`, `price`, `image`) VALUES
(1, 'Роза', 99, 'rose.png'),
(2, 'Тюльпан', 63, 'tulpan.png'),
(3, 'Пион', 630, 'pion.png'),
(4, 'Лизиантус (китайская роза)', 189, 'lizi.png'),
(5, 'Альстромерия', 120, 'alstro.png');

-- --------------------------------------------------------

--
-- Структура таблицы `flower_color`
--

CREATE TABLE `flower_color` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flower_color`
--

INSERT INTO `flower_color` (`id`, `flower_id`, `color_id`, `quantity`) VALUES
(1, 1, 1, 112),
(2, 1, 2, 3),
(3, 2, 2, 3),
(4, 2, 4, 1),
(5, 2, 3, 10),
(6, 1, 6, 2),
(7, 1, 10, 1),
(8, 1, 8, 11),
(9, 1, 4, 25),
(10, 1, 3, 5),
(11, 2, 5, 5),
(12, 3, 3, 20),
(13, 3, 1, 103),
(14, 3, 10, 20),
(15, 3, 4, 10),
(16, 4, 7, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_flower_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `florist_id` int(11) DEFAULT NULL,
  `status` enum('Обработка','Оплачен','Готов к самовывозу','Завершен','Отменен') DEFAULT NULL,
  `sum` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `duedate` varchar(20) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `order_flower_id`, `quantity`, `florist_id`, `status`, `sum`, `packaging_id`, `date`, `duedate`, `note`) VALUES
(1, 6, 1, 1, 11, 'Готов к самовывозу', 1040, 1, '2019-05-16 20:05:08', '2019-05-31', 'Самую большую и красивую розу, пожалуйста'),
(11, 6, 21, 2, NULL, 'Обработка', 2782, 4, '2019-05-30 17:05:16', '2019-06-08', 'isnt cool'),
(16, 14, 24, 4, NULL, 'Обработка', 2780, 2, '2019-06-06 18:27:54', '2019-06-19', 'Самые большие розы, пожалуйста');

-- --------------------------------------------------------

--
-- Структура таблицы `order_flower`
--

CREATE TABLE `order_flower` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `flower_color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_flower`
--

INSERT INTO `order_flower` (`id`, `order_id`, `flower_color_id`, `quantity`) VALUES
(1, 1, 1, 1),
(60, 18, 1, 8),
(62, 19, 1, 7),
(63, 20, 16, 1),
(64, 21, 1, 9),
(65, 22, 5, 1),
(66, 22, 12, 2),
(67, 22, 13, 1),
(68, 22, 16, 1),
(69, 23, 1, 0),
(70, 23, 2, 3),
(71, 23, 7, 0),
(72, 23, 9, 1),
(73, 23, 10, 1),
(74, 24, 2, 3),
(75, 24, 9, 1),
(76, 24, 10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `packaging`
--

CREATE TABLE `packaging` (
  `id` int(11) NOT NULL,
  `packname` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `packaging`
--

INSERT INTO `packaging` (`id`, `packname`, `image`, `price`) VALUES
(1, 'Атласная лента', 'lenta.jpg', 50),
(2, 'Натуральное оформление', 'natural.jpg', 200),
(3, 'Подарочная упаковка', 'podarok.jpg', 250),
(4, 'Корзина', 'korzina.jpg', 500);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, 'Земляничный сорбет', 'strawberry-sorbet', 0, '1.jpeg', 'Моно-букет из 35 розовидных пионов - настоящий земляничный сорбет!\r\n', 1, '2019-06-06 17:20:41', '2019-05-12 16:06:02'),
(2, 1, 'Для самых романтичных', 'for_romantics', 0, '2.jpeg', 'Кремовый букет из нежнейших ранункулюсов.', 1, '2019-06-06 17:20:41', '2019-05-12 14:17:30'),
(11, 1, 'Алые паруса', 'buket-3', 0, '3.jpeg', '&lt;p&gt;Букет 3&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:13:50'),
(12, 1, 'Весенняя нежность', 'buket-4', 0, '4.jpeg', '&lt;p&gt;Букет 4&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:14:06'),
(13, 1, 'Розовая лаванда', 'buket-5', 0, '5.jpeg', '&lt;p&gt;Букет 5&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:14:23'),
(14, 1, 'Вечерняя загадка', 'buket-6', 0, '6.jpeg', '&lt;p&gt;Букет 6&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:14:38'),
(15, 1, 'Узор волны', 'buket-7', 0, '7.jpeg', '&lt;p&gt;Букет 7&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:14:57'),
(16, 1, 'Воздушная акварель', 'buket-8', 0, '8.jpeg', '&lt;p&gt;Букет 8&lt;/p&gt;\r\n', 1, '2019-06-06 17:20:41', '2019-05-14 22:15:11');

-- --------------------------------------------------------

--
-- Структура таблицы `post_topic`
--

CREATE TABLE `post_topic` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post_topic`
--

INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(6, 11, 1),
(7, 12, 2),
(8, 13, 1),
(9, 14, 2),
(10, 15, 1),
(11, 16, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `supply`
--

CREATE TABLE `supply` (
  `id` int(11) NOT NULL,
  `supply_flower` int(11) NOT NULL,
  `supplydate` varchar(20) DEFAULT NULL,
  `supplier` varchar(255) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `supply`
--

INSERT INTO `supply` (`id`, `supply_flower`, `supplydate`, `supplier`, `sum`) VALUES
(1, 1, '2019-05-23', 'ООО \"Цветочный рай\"', 5200),
(2, 2, '2019-05-25', 'Радуга', 2500),
(11, 10, '2019-05-23', 'поставка', 10),
(12, 11, '2019-05-22', 'Моя поставка', 200),
(13, 12, '2019-05-26', 'Чек чек чек', 555),
(29, 13, '2019-06-13', 'аааааа', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `supply_flower`
--

CREATE TABLE `supply_flower` (
  `id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `flower_color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `supply_flower`
--

INSERT INTO `supply_flower` (`id`, `supply_id`, `flower_color_id`, `quantity`, `sum`) VALUES
(1, 1, 1, 20, 2500),
(2, 1, 2, 20, 2700),
(3, 2, 2, 2, 2),
(4, 3, 4, 2, 200),
(5, 3, 5, 1, 1),
(6, 3, 4, 1, 1),
(7, 3, 5, 1, 1),
(8, 3, 11, 1, 10),
(9, 3, 11, 1, 10),
(10, 3, 4, 100, 1000),
(11, 3, 11, 100, 10),
(12, 3, 4, 100, 10),
(13, 3, 4, 100, 10),
(14, 3, 4, 100, 10),
(15, 3, 11, 10, 10),
(16, 3, 4, 5, 200),
(17, 3, 13, 1, 200),
(18, 3, 4, 10, 10),
(19, 4, 13, 10, 500),
(20, 3, 4, 10, 10),
(21, 4, 11, 10, 1000),
(22, 4, 13, 10, 2000),
(23, 4, 13, 10, 1000),
(24, 4, 13, 1, 100),
(25, 4, 11, 1, 1),
(26, 4, 11, 0, 0),
(30, 5, 4, 1, 10),
(31, 5, 11, 1, 10),
(32, 6, 13, 0, 0),
(33, 6, 13, 1, 20),
(34, 6, 13, 1, 10),
(35, 6, 11, 1, 1),
(36, 6, 13, 1, 1),
(37, 6, 13, 10, 1),
(38, 7, 11, 1, 100),
(39, 7, 1, 20, 100),
(40, 7, 13, 1, 100),
(41, 7, 13, 4, 400),
(42, 7, 13, 1, 10),
(43, 8, 15, 1, 100),
(44, 8, 13, 1, 1000),
(45, 8, 15, 22, 22),
(46, 9, 13, 1, 505),
(47, 9, 11, 10, 500),
(48, 9, 13, 1, 100),
(49, 9, 13, 1, 1),
(50, 9, 13, 1, 42),
(51, 10, 13, 1, 1),
(52, 10, 5, 1, 10),
(53, 10, 13, 1, 200),
(54, 11, 11, 10, 200),
(55, 12, 13, 1, 1),
(56, 12, 11, 20, 20),
(57, 13, 13, 1, 1),
(58, 14, 11, 10, 10),
(59, 10, 12, 1, 1),
(60, 15, 1, 100, 1000),
(61, 16, 2, 100, 1000),
(62, 16, 3, 100, 4000),
(63, 17, 1, 1000, 1),
(64, 17, 5, 1000, 20),
(65, 18, 11, 1000, 10),
(66, 18, 13, 1000, 1),
(67, 19, 11, 1000, 10),
(68, 19, 3, 1000, 20),
(69, 19, 11, 1000, 10),
(70, 19, 3, 1000, 20),
(71, 20, 13, 1000, 1),
(72, 20, 11, 1000, 2),
(73, 20, 13, 1000, 1),
(74, 20, 11, 1000, 2),
(75, 21, 13, 1000, 1),
(76, 21, 4, 1000, 1),
(77, 22, 11, 1000, 1),
(78, 22, 4, 1000, 2),
(79, 13, 13, 100, 2),
(80, 13, 11, 200, 5),
(81, 14, 13, 1, 100),
(82, 14, 11, 10, 100),
(83, 15, 12, 10, 10),
(84, 15, 5, 100, 1),
(85, 15, 13, 100, 10000),
(86, 13, 13, 1, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `name`, `slug`) VALUES
(1, '8 марта', '8-march'),
(2, 'День рождения', 'den-rojdeniya'),
(3, 'День матери', 'den-materi'),
(5, 'Первое сентября', 'pervoe-sentyabrya'),
(6, '14 февраля', '14-fevralya'),
(7, 'Последний звонок', 'posledniy-zvonok'),
(8, 'Свадьба', 'svadba');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Author','Admin') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`, `user_name`, `user_phone`) VALUES
(1, 'regina', 'nasyrievaregina@gmail.com', 'Admin', '12345', '2019-05-10 14:31:44', NULL, 'Насыриева Регина', '89179214578'),
(2, 'regina1', 'tfhyth@h', NULL, '698d51a19d8a121ce581499d7b701668', '2019-05-10 17:16:33', '2019-05-10 17:16:33', 'Романова Регина', '89179214578'),
(5, 'uiyi', 'ui@d', NULL, '698d51a19d8a121ce581499d7b701668', '2019-05-10 17:35:43', '2019-05-10 17:35:43', 'Кочалова Юлия', '89175682323'),
(6, 'elsa', '76@tap', NULL, '698d51a19d8a121ce581499d7b701668', '2019-05-10 20:39:54', '2019-05-30 17:21:28', 'Хуснутдинова Эльза', '89195269874'),
(10, 'admin', 'admin@example.com', 'Admin', '3fde6bb0541387e4ebdadf7c2ff31123', '2019-05-11 13:31:21', '2019-05-11 13:31:21', 'Насыриева Регина', '89179214578'),
(11, 'klaus', 'golubevklaus@dione.ru', 'Author', '202cb962ac59075b964b07152d234b70', '2019-05-12 13:55:57', '2019-05-28 22:10:42', 'Голубев Клаус', '89175248659'),
(12, 'kotova', 'kotov@mail.ru', NULL, '3fde6bb0541387e4ebdadf7c2ff31123', '2019-05-16 19:23:05', '2019-05-16 19:23:05', 'Котова Таисия', '89521456874'),
(14, 'shamgunova', 'miss.shamgunova@gmail.com', NULL, 'b0baee9d279d34fa1dfd71aadb908c3f', '2019-06-06 17:52:04', '2019-06-06 18:31:44', 'Шамгунова Гузель', '88005553535');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `packaging_id` (`packaging_id`),
  ADD KEY `order_flower_id` (`order_flower_id`);

--
-- Индексы таблицы `bouquets`
--
ALTER TABLE `bouquets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_color_id` (`flower_color_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Индексы таблицы `bouquet_flower`
--
ALTER TABLE `bouquet_flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bouquet_id` (`bouquet_id`),
  ADD KEY `flower_color_id` (`flower_color_id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flower_color`
--
ALTER TABLE `flower_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_id` (`flower_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `florist_id` (`florist_id`),
  ADD KEY `packaging_id` (`packaging_id`),
  ADD KEY `order_flower_id` (`order_flower_id`);

--
-- Индексы таблицы `order_flower`
--
ALTER TABLE `order_flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `flower_color_id` (`flower_color_id`);

--
-- Индексы таблицы `packaging`
--
ALTER TABLE `packaging`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `post_topic`
--
ALTER TABLE `post_topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_topic_ibfk_1` (`post_id`),
  ADD KEY `post_topic_ibfk_2` (`topic_id`);

--
-- Индексы таблицы `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supply_flower` (`supply_flower`);

--
-- Индексы таблицы `supply_flower`
--
ALTER TABLE `supply_flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_color_id` (`flower_color_id`),
  ADD KEY `supply_id` (`supply_id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `bouquets`
--
ALTER TABLE `bouquets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bouquet_flower`
--
ALTER TABLE `bouquet_flower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `flower_color`
--
ALTER TABLE `flower_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `order_flower`
--
ALTER TABLE `order_flower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT для таблицы `packaging`
--
ALTER TABLE `packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `post_topic`
--
ALTER TABLE `post_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `supply_flower`
--
ALTER TABLE `supply_flower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`packaging_id`) REFERENCES `packaging` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_3` FOREIGN KEY (`order_flower_id`) REFERENCES `order_flower` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bouquets`
--
ALTER TABLE `bouquets`
  ADD CONSTRAINT `bouquets_ibfk_1` FOREIGN KEY (`flower_color_id`) REFERENCES `flower_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bouquets_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bouquet_flower`
--
ALTER TABLE `bouquet_flower`
  ADD CONSTRAINT `bouquet_flower_ibfk_1` FOREIGN KEY (`bouquet_id`) REFERENCES `bouquets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bouquet_flower_ibfk_2` FOREIGN KEY (`flower_color_id`) REFERENCES `flower_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flower_color`
--
ALTER TABLE `flower_color`
  ADD CONSTRAINT `flower_color_ibfk_1` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flower_color_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`florist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`packaging_id`) REFERENCES `packaging` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`order_flower_id`) REFERENCES `order_flower` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_flower`
--
ALTER TABLE `order_flower`
  ADD CONSTRAINT `order_flower_ibfk_2` FOREIGN KEY (`flower_color_id`) REFERENCES `flower_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `post_topic`
--
ALTER TABLE `post_topic`
  ADD CONSTRAINT `post_topic_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_ibfk_1` FOREIGN KEY (`supply_flower`) REFERENCES `supply_flower` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `supply_flower`
--
ALTER TABLE `supply_flower`
  ADD CONSTRAINT `supply_flower_ibfk_1` FOREIGN KEY (`flower_color_id`) REFERENCES `flower_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
