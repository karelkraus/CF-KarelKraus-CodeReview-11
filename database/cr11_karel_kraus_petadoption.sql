-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 21. lis 2020, 16:04
-- Verze serveru: 10.4.14-MariaDB
-- Verze PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cr11_karel_kraus_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_karel_kraus_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_karel_kraus_petadoption`;

-- --------------------------------------------------------

--
-- Struktura tabulky `adoption`
--

CREATE TABLE `adoption` (
  `id_adoption` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `adoption`
--

INSERT INTO `adoption` (`id_adoption`, `fk_user_id`, `fk_animal_id`) VALUES
(1, 3, 2),
(2, 3, 16);

-- --------------------------------------------------------

--
-- Struktura tabulky `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `size` enum('small','large') NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `fk_location` int(11) NOT NULL,
  `age` int(3) NOT NULL,
  `available` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `animal`
--

INSERT INTO `animal` (`id_animal`, `name`, `image`, `size`, `type`, `description`, `hobbies`, `fk_location`, `age`, `available`) VALUES
(1, 'Fred', 'https://cdn.pixabay.com/photo/2015/07/09/22/50/bear-838688_1280.jpg', 'large', 'bear', 'Fred is a very friendly bear. He does not eat people anymore.', 'watching tv, sleeping', 1, 9, 'yes'),
(2, 'TEST', 'image', 'large', 'test', 'test', 'test', 1, 10, 'no'),
(4, 'Eleanor', 'https://cdn.pixabay.com/photo/2014/04/13/20/49/cat-323262_1280.jpg', 'small', 'cat', 'Just a regular cat which thinks that she owns the whole world.', 'dreaming about being a tiger', 3, 20, 'yes'),
(6, 'Joey', 'https://cdn.pixabay.com/photo/2016/11/23/01/20/animal-1851671_1280.jpg', 'small', 'lemur', 'Joey is a nice little lemur. Originally from Madagascar but found a girlfriend in Europa. Unfortunately, his girlfriend left him.', 'fooling around', 4, 7, 'yes'),
(7, 'Alfred', 'https://cdn.pixabay.com/photo/2017/07/24/19/57/tiger-2535888_1280.jpg', 'large', 'tiger', 'Just don\'t let Alfred to be around kids alone. He likes them too much.', 'swimming, eating kids', 2, 8, 'yes'),
(8, 'Simon', 'https://cdn.pixabay.com/photo/2015/12/18/22/56/gorilla-1099264_1280.jpg', 'large', 'gorilla', 'Simon likes philosophy and universe. He often watches stars and think about other life forms outside Earth.', 'astronomy, philosophy', 1, 9, 'yes'),
(9, 'Julius', 'https://cdn.pixabay.com/photo/2014/10/17/12/57/sockeye-492258_1280.jpg', 'small', 'salmon', 'Julius only likes to swim. His big dream is to swim at Olympics Games.', 'swimming', 1, 1, 'yes'),
(10, 'Cedric', 'https://cdn.pixabay.com/photo/2015/07/02/10/44/crow-828944_1280.jpg', 'small', 'crow', 'Once Cedric was competting in Red Bull Air Race but he did not like the stress.', 'flying, pooping on people', 2, 2, 'yes'),
(11, 'Eugene', 'https://cdn.pixabay.com/photo/2016/01/19/17/38/kangaroo-1149807_1280.jpg', 'large', 'kangaroo', 'His favorite songs is Jump Around by House of Pain. His father owns the Guiness record in long jump.', 'jumping around', 1, 5, 'yes'),
(12, 'Franciska', 'https://cdn.pixabay.com/photo/2017/01/26/11/17/european-eagle-owl-2010346_1280.jpg', 'small', 'owl', 'Franciska like to stay up long at night and then she sleeps during the day.', 'flying in forest', 3, 12, 'yes'),
(13, 'Helmut', 'https://cdn.pixabay.com/photo/2015/11/10/08/13/ladybug-1036453_1280.jpg', 'small', 'ladybug', 'Altough Helmut is ladybug, he is no lady. He is a real macho man.', 'sunbathing', 2, 1, 'yes'),
(14, 'Ford', 'https://cdn.pixabay.com/photo/2017/08/29/01/13/animal-2691865_1280.jpg', 'large', 'horse', 'Other horses like to call him Mustang. This nickname has since he was a little horse. He is wild and free.', 'running', 4, 8, 'yes'),
(15, 'Louis', 'https://cdn.pixabay.com/photo/2019/07/02/10/25/giraffe-4312090_1280.jpg', 'large', 'giraffe', 'Originally from Africa but Louis moved to Europe because he likes the european style of life.', 'eating leaves ', 2, 6, 'yes'),
(16, 'tes', 'test', 'small', 'test', 'test', 'test', 4, 3, 'no'),
(19, 'Mario', 'https://cdn.pixabay.com/photo/2016/07/19/21/12/beaver-1528948_1280.jpg', 'small', 'beaver', 'Mario was living his whole life together with his brother Luigi in Italy.', 'wood chopping', 6, 3, 'yes'),
(23, 'test', 'tets', 'large', 'test', 'etst', 'test', 4, 2, 'yes');

-- --------------------------------------------------------

--
-- Struktura tabulky `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `location`
--

INSERT INTO `location` (`id_location`, `city`, `zip`, `address`, `country`) VALUES
(1, 'Wien', '1100', 'Laxenburger Straße 22', 'Austria'),
(2, 'Prague', '11000', 'Vodickova 22', 'Czech Republic'),
(3, 'Brno', '2000', 'Dlouha 23', 'Czech Republic'),
(4, 'Brno', '49000', 'Ulice 9', 'Czech Republic'),
(5, 'test', 'test', 'test', 'test'),
(6, 'Rome', '12134', 'Spaghetti 94', 'Italy');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userType` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `userType`) VALUES
(1, 'User', 'user@mail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a', 'user'),
(3, 'Karel', 'karel@mail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'user'),
(4, 'admin', 'admin@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'admin'),
(5, 'superadmin', 'superadmin@mail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'superadmin');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id_adoption`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`);

--
-- Klíče pro tabulku `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `fk_location` (`fk_location`);

--
-- Klíče pro tabulku `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id_adoption` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `animal`
--
ALTER TABLE `animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `adoption_ibfk_2` FOREIGN KEY (`fk_animal_id`) REFERENCES `animal` (`id_animal`);

--
-- Omezení pro tabulku `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`fk_location`) REFERENCES `location` (`id_location`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
