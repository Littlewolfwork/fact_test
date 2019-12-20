
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(400) NOT NULL,
  `login` varchar(400) NOT NULL,
  `mail` varchar(400) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `mail`, `password`, `date`, `deleted`) VALUES
(1, 'petr1', 'petrov1', 'petrov1@test.com', 'password', '2019-12-20 09:17:37', 0),
(2, 'petr2', 'petrov2', 'petrov2@test.com', 'password', '2019-12-20 09:17:37', 0),
(3, 'petr3', 'petrov3', 'petrov3@test.com', 'password', '2019-12-19 09:17:37', 1),
(4, 'petr4', 'petrov4', 'petrov4@test.com', 'password', '2019-12-19 09:17:37', 0),
(5, 'petr5', 'petrov5', 'petrov5@test.com', 'password', '2019-12-19 09:17:37', 0),
(6, 'petr6', 'petrov6', 'petrov6@test.com', 'password', '2019-12-19 09:17:37', 1),
(7, 'petr7', 'petrov7', 'petrov7@test.com', 'password', '2019-12-20 09:17:37', 0),
(8, 'petr8', 'petrov8', 'petrov8@test.com', 'password', '2019-12-20 09:17:37', 0),
(9, 'petr9', 'petrov9', 'petrov9@test.com', 'password', '2019-12-20 09:17:37', 1),
(10, 'petr10', 'petrov10', 'petrov10@test.com', 'password', '2019-12-20 09:17:37', 0),
(11, 'petr11', 'petrov11', 'petrov11@test.com', 'password', '2019-12-20 09:17:37', 0),
(12, 'petr12', 'petrov12', 'petrov12@test.com', 'password', '2019-12-20 09:17:37', 0),
(13, 'petr13', 'petrov13', 'petrov13@test.com', 'password', '2019-12-20 09:17:37', 0),
(14, 'petr14', 'petrov14', 'petrov14@test.com', 'password', '2019-12-20 09:17:37', 0),
(15, 'petr15', 'petrov15', 'petrov15@test.com', 'password', '2019-12-20 09:17:37', 0),
(16, 'ivan1', 'ivanov1', 'ivanov1@test.com', 'password', '2019-12-20 09:18:05', 0),
(17, 'ivan2', 'ivanov2', 'ivanov2@test.com', 'password', '2019-12-20 09:18:05', 0),
(18, 'ivan3', 'ivanov3', 'ivanov3@test.com', 'password', '2019-12-20 09:18:05', 0),
(19, 'ivan4', 'ivanov4', 'ivanov4@test.com', 'password', '2019-12-20 09:18:05', 0),
(20, 'ivan5', 'ivanov5', 'ivanov5@test.com', 'password', '2019-12-20 09:18:05', 0),
(21, 'ivan6', 'ivanov6', 'ivanov6@test.com', 'password', '2019-12-20 09:18:05', 0),
(22, 'ivan7', 'ivanov7', 'ivanov7@test.com', 'password', '2019-12-20 09:18:05', 0),
(23, 'ivan8', 'ivanov8', 'ivanov8@test.com', 'password', '2019-12-20 09:18:05', 0),
(24, 'ivan9', 'ivanov9', 'ivanov9@test.com', 'password', '2019-12-20 09:18:05', 0),
(25, 'ivan10', 'ivanov10', 'ivanov10@test.com', 'password', '2019-12-20 09:18:05', 0),
(26, 'ivan11', 'ivanov11', 'ivanov11@test.com', 'password', '2019-12-20 09:18:05', 0),
(27, 'ivan12', 'ivanov12', 'ivanov12@test.com', 'password', '2019-12-20 09:18:05', 0),
(28, 'ivan13', 'ivanov13', 'ivanov13@test.com', 'password', '2019-12-20 09:18:05', 0),
(29, 'ivan14', 'ivanov14', 'ivanov14@test.com', 'password', '2019-12-20 09:18:05', 0),
(30, 'ivan15', 'ivanov15', 'ivanov15@test.com', 'password', '2019-12-20 09:18:05', 0),
(31, 'ivan16', 'ivanov16', 'ivanov16@test.com', 'password', '2019-12-20 09:18:05', 0),
(32, 'ivan17', 'ivanov17', 'ivanov17@test.com', 'password', '2019-12-20 09:18:05', 0),
(33, 'ivan18', 'ivanov18', 'ivanov18@test.com', 'password', '2019-12-20 09:18:05', 0),
(34, 'ivan19', 'ivanov19', 'ivanov19@test.com', 'password', '2019-12-20 09:18:05', 0),
(35, 'ivan20', 'ivanov20', 'ivanov20@test.com', 'password', '2019-12-20 09:18:05', 1),
(36, 'ivan21', 'ivanov21', 'ivanov21@test.com', 'password', '2019-12-20 09:18:05', 0),
(37, 'ivan22', 'ivanov22', 'ivanov22@test.com', 'password', '2019-12-20 09:18:05', 0),
(38, 'ivan23', 'ivanov23', 'ivanov23@test.com', 'password', '2019-12-20 09:18:05', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

