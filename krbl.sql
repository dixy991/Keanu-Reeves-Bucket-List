-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 09:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14060703_krbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `bucket`
--

CREATE TABLE `bucket` (
  `id_bucket` int(255) NOT NULL,
  `user_ID` int(255) NOT NULL,
  `list_ID` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bucket`
--

INSERT INTO `bucket` (`id_bucket`, `user_ID`, `list_ID`, `date`, `done`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 1),
(2, 1, 3, '0000-00-00 00:00:00', 0),
(3, 1, 2, '2020-06-10 15:38:30', 0),
(4, 1, 9, '2020-06-10 19:05:59', 1),
(6, 1, 23, '2020-06-11 00:00:41', 0),
(7, 2, 3, '2020-06-11 21:50:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'travel'),
(2, 'new skill'),
(3, 'diy'),
(4, 'sports'),
(5, 'food'),
(6, 'health');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int(255) NOT NULL,
  `src_small` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_image`, `src_small`, `src`, `alt`) VALUES
(1, 'default_small.jpg', 'default.jpg', 'slika tebra'),
(2, 'small_1591823582230-2303898_dark-night-moon.jpg', 'big_1591823582230-2303898_dark-night-moon.jpg', '230-2303898_dark-night-moon.jpg'),
(3, 'small_1591825832230-2303898_dark-night-moon.jpg', 'big_1591825832230-2303898_dark-night-moon.jpg', '230-2303898_dark-night-moon.jpg'),
(4, 'small_159182630768456473-pc-wallpapers.jpg', 'big_159182630768456473-pc-wallpapers.jpg', '68456473-pc-wallpapers.jpg'),
(5, 'small_1591826418maxresdefault.jpg', 'big_1591826418maxresdefault.jpg', 'maxresdefault.jpg'),
(6, 'small_159197968468456473-pc-wallpapers.jpg', 'big_159197968468456473-pc-wallpapers.jpg', '68456473-pc-wallpapers.jpg'),
(7, 'small_159198017536hld1.jpg', 'big_159198017536hld1.jpg', '36hld1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id_list` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_ID` int(50) NOT NULL,
  `category_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id_list`, `name`, `image_ID`, `category_ID`) VALUES
(1, 'visit hawaii', 1, 1),
(2, 'stand in sistine chapel', 1, 1),
(3, 'experience the grand canyon', 1, 1),
(4, 'visit havana, cuba', 1, 1),
(5, 'visit easter island', 1, 1),
(6, 'swim in the mediterranean sea', 1, 1),
(7, 'go to the olympics', 1, 1),
(8, 'ride a double decker bus in london', 1, 1),
(9, 'plant a tree', 1, 2),
(10, 'learn to say \"hello\" in 50 languages', 1, 2),
(11, 'be able to do the splits', 1, 2),
(12, 'learn how to use chopstics', 1, 2),
(13, 'make a time capsule', 1, 3),
(14, 'build a blanket fort (with kids)', 1, 3),
(15, 'make a piñata', 1, 3),
(16, 'go skydiving', 1, 4),
(17, 'ride a mechanical bull', 1, 4),
(18, 'try durian', 1, 5),
(19, 'eat gelato in italy', 1, 5),
(20, 'donate blood', 1, 6),
(21, 'pizdim', 3, 6),
(23, 'tajp tip type', 5, 2),
(24, 'znaci brate', 6, 5),
(25, 'znaci cilj', 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(150) NOT NULL,
  `parent` int(50) DEFAULT NULL,
  `position` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `name`, `path`, `parent`, `position`) VALUES
(1, 'home', 'index.php?page=home', NULL, 1),
(2, 'steps', 'index.php?page=steps', NULL, 2),
(3, 'list', 'index.php?page=list', NULL, 3),
(4, 'contact', 'index.php?page=contact', NULL, 4),
(5, 'ikonica', '#', NULL, 5),
(6, 'log in', 'index.php?page=login', 5, 6),
(7, 'register', 'index.php?page=register', 5, 7),
(8, 'log out', 'index.php?page=logout', 5, 8),
(9, 'my bucket', 'index.php?page=bucket', 5, 9),
(10, 'admin panel', 'index.php?page=admin-panel', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `last_visit` datetime NOT NULL,
  `error` int(50) NOT NULL,
  `role_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `active`, `last_visit`, `error`, `role_ID`) VALUES
(1, 'korisnik', 'korisnik@gmail.com', '716b64c0f6bad9ac405aab3f00958dd1', 0, '2020-06-11 20:29:03', 13, 2),
(2, 'admin99', 'admin@gmail.com', '72f4f10a40c4be8fbf63b79cbf21abca', 0, '2020-06-12 18:35:28', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bucket`
--
ALTER TABLE `bucket`
  ADD PRIMARY KEY (`id_bucket`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `list_ID` (`list_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id_list`),
  ADD KEY `image_ID` (`image_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_ID` (`role_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bucket`
--
ALTER TABLE `bucket`
  MODIFY `id_bucket` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `id_list` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bucket`
--
ALTER TABLE `bucket`
  ADD CONSTRAINT `bucket_ibfk_1` FOREIGN KEY (`list_ID`) REFERENCES `list` (`id_list`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bucket_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`image_ID`) REFERENCES `image` (`id_image`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_ibfk_2` FOREIGN KEY (`category_ID`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_ID`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
