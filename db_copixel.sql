-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 30, 2021 at 06:28 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_copixel`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id_comment` int(11) NOT NULL,
  `body` varchar(50) NOT NULL,
  `timestamp` date NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Liked`
--

CREATE TABLE `Liked` (
  `id_users` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_post` varchar(100) NOT NULL,
  `description` longtext,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `about` varchar(50) DEFAULT NULL,
  `img_profile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id_users`, `name`, `email`, `password`, `about`, `img_profile`) VALUES
(75938662, 'Angga Ady Pratama', 'anggaadypratama@outlook.com', '$2y$10$4Ji1hkZi3Ehx7/gFdji92uozGBKKgC1BDGNG9l8hiT0Gp7ke9YGIC', 'I love myself', ''),
(87583428, 'Maharani', 'apangga24@gmail.com', '$2y$10$xuGd3hFkdIkJ/F02Y83UX.Q0LjE2YNbzqYuVowE7e72AzL./w5/jG', 'Testing aja lah', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `Liked`
--
ALTER TABLE `Liked`
  ADD PRIMARY KEY (`id_users`,`id_post`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `Post` (`id_post`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `Users` (`id_users`);

--
-- Constraints for table `Liked`
--
ALTER TABLE `Liked`
  ADD CONSTRAINT `liked_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `Users` (`id_users`),
  ADD CONSTRAINT `liked_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `Post` (`id_post`);

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `Users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
