-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2021 at 03:00 PM
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
  `body` varchar(256) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_post` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id_comment`, `body`, `timestamp`, `id_post`, `id_users`) VALUES
(235876160, 'hai', '2021-12-03 14:42:00', 912848179, 18531905),
(522801795, 'hai', '2021-12-03 14:42:10', 55918442, 18531905),
(538129728, 'hai sayang', '2021-12-03 14:21:56', 55918442, 14799331),
(968187365, 'udin', '2021-12-03 14:35:07', 912848179, 14799331);

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `img_post` varchar(100) NOT NULL,
  `description` longtext,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_users` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id_post`, `title`, `img_post`, `description`, `created_time`, `id_users`, `views`) VALUES
(55918442, 'Zhong Xina kasjfldajsdlfkjalksdfjlaksjdflkajsdflk', 'image/post/_yuPWpNo.jpeg', 'your social credit is -999999999999', '2021-12-03 14:21:22', 14799331, 26),
(171007235, 'Psycho', 'image/post/16385426880911929138a71d9c3d1ebae79e1ca505.jpeg', '', '2021-12-03 14:44:48', 18531905, 0),
(218610358, 'BALI', 'image/post/1638542662aron-visuals-ycyLUcEoalE-unsplash.jpg', 'ITS A WONDERFULL LAND IN INDONESIA', '2021-12-03 14:44:22', 18531905, 36),
(912848179, 'the wok', 'image/post/16385412575c5.jpeg', '', '2021-12-03 14:20:57', 14799331, 30),
(963275130, 'Kanon jaga kape', 'image/post/1638542713shibuya kanon.jpg', '', '2021-12-03 14:45:13', 18531905, 0);

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
  `img_profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id_users`, `name`, `email`, `password`, `about`, `img_profile`) VALUES
(14799331, 'Angga Ady Pratama', 'anggaadypratama@outlook.com', '$2y$10$NVMxwdhrwm77XqSKpekQ7e/3mKFrebKYpgtMJwijFGXMeKVUeG5Be', NULL, 'image/profile/1638540891_angga ady pratama.svg'),
(18531905, 'Intan Kustanti', 'intanks9898@gmail.com', '$2y$10$ru0FmO1T7gJYSZI5eFbqbuxdwDihZeSLPkopd2QkzYbmkzNyj.LB2', NULL, 'image/profile/1638542146_Intan Kustanti.svg');

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
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `Users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
