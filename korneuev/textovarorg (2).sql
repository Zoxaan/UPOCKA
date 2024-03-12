-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 21 2024 г., 15:20
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `textovarorg`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `order_date`, `product_price`) VALUES
(3, 0, 3, '0000-00-00 00:00:00', 0),
(4, 0, 4, '0000-00-00 00:00:00', 0),
(5, 0, 5, '0000-00-00 00:00:00', 0),
(6, 0, 3, '0000-00-00 00:00:00', 0),
(7, 0, 3, '0000-00-00 00:00:00', 0),
(8, 0, 3, '0000-00-00 00:00:00', 0),
(9, 0, 3, '2024-02-21 14:59:46', 0),
(10, 38, 3, '0000-00-00 00:00:00', 0),
(11, 38, 0, '0000-00-00 00:00:00', 0),
(12, 38, 3, '0000-00-00 00:00:00', 0),
(13, 38, 3, '2024-02-21 15:15:05', 0),
(14, 38, 3, '2024-02-21 15:18:25', 1000),
(15, 38, 5, '2024-02-21 15:18:48', 5001);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(3, 'машина', 'фывофыовлдфыовдлфыовфлдывофдлыводлфывофлыдвфыо', '1000', 'uploads/2.jpg'),
(4, '1231231', '1221qweqweweqwewqeqw', '10001', 'uploads/Принтер.jpg.webp'),
(5, 'стиралка', '123321', '5001', 'uploads/a-bouquet-of-peonies-on-transparent-background-png-clipart_88754-450.avif');

-- --------------------------------------------------------

--
-- Структура таблицы `rolles`
--

CREATE TABLE `rolles` (
  `user` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rolles`
--

INSERT INTO `rolles` (`user`, `admin`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `serviceorders`
--

CREATE TABLE `serviceorders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `bigdescription` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `image`, `bigdescription`, `service_id`) VALUES
(7, 'IT аутсорсинг', 'Обслуживание компьютерной инфраструктуры и торгового оборудования.', '1231', 'uploads/e63ac07ddb3bda49708fe77cf11b7322.jpg', 'Обслуживание компьютеров (рабочие станции, ноутбуки, моноблоки)\r\nОбслуживание офисной техники (МФУ, принтеры, сканеры, телефонные аппараты, ИБП)\r\nОбслуживание и администрирование программного обеспечения\r\nОбслуживание серверного оборудования (серверы и си', 0),
(8, 'Юрий', 'qweqweqweqw', '1231', 'uploads/e984da4a06d0d6f09db6b240c533e907.jpg', 'qwewqeqweqweqweqweq', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `password`, `user_id`) VALUES
(38, 'Юрий', '112312331@mail.ru', '123123', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rolles`
--
ALTER TABLE `rolles`
  ADD PRIMARY KEY (`user`);

--
-- Индексы таблицы `serviceorders`
--
ALTER TABLE `serviceorders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `rolles`
--
ALTER TABLE `rolles`
  MODIFY `user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `serviceorders`
--
ALTER TABLE `serviceorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
