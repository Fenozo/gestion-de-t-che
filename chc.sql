-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 03:02 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contenu_projet`
--

CREATE TABLE `contenu_projet` (
  `id` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `id_projet` int(11) NOT NULL,
  `legende` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `url_image` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contenu_projet`
--

INSERT INTO `contenu_projet` (`id`, `code`, `user_id`, `created_on`, `updated_on`, `id_projet`, `legende`, `description`, `url_image`) VALUES
(1, 'X8OXO0', 1, '2017-05-04 08:02:02', '0000-00-00 00:00:00', 1, 'dfg', '', 'upload/5/Capture du 2017-03-22 20-28-52.png'),
(2, '79OCEQ', 1, '2017-05-04 02:02:19', '0000-00-00 00:00:00', 1, 'Titre de contenu 01', 'Déscription du contenu 01', 'upload/5/Capture du 2017-03-22 20-28-52.png'),
(3, 'B67N04', 1, '2017-05-04 02:07:10', '0000-00-00 00:00:00', 3, 'test1', 'test2', 'upload/4/Capture du 2017-03-11 19-30-08.png'),
(4, 'Z95K2C', 1, '2017-05-04 02:11:50', '0000-00-00 00:00:00', 3, 'Titre numéro 01', 'déscription numéro 01', 'upload/5/Capture du 2017-03-22 20-28-52.png'),
(5, 'U1P1WI', 1, '2017-05-04 02:37:39', '0000-00-00 00:00:00', 4, 'Le titre qui fait marer', 'Déscription ff', 'upload/4/chmod 777.png'),
(6, 'Y0N41I', 1, '2017-05-04 02:46:52', '0000-00-00 00:00:00', 5, 'Casque', 'Casque déscription', 'upload/5/3AS52-AGW9N-510_primary_3.jpg'),
(7, '218O4S', 1, '2017-05-04 03:19:20', '0000-00-00 00:00:00', 1, 'gfh', 'fghf', 'upload/1/4_header_2015MBM01139_1_RGB_1422x800.jpg'),
(8, '730UZG', 1, '2017-05-04 03:25:01', '0000-00-00 00:00:00', 1, 'sdfgf', 'dfg', 'upload/1/1-ville.jpg'),
(9, 'W837MS', 1, '2017-05-04 03:26:34', '0000-00-00 00:00:00', 1, 'dfg', 'fdg', 'upload/1/6b3a3e375737c983ee67c767ea530098.jpg'),
(10, 'AWC5D6', 1, '2017-05-04 03:29:00', '0000-00-00 00:00:00', 5, 'dsf', 'dsf', 'upload/5/29edc732847571.56960d063cb90.jpg'),
(12, '669GK4', 1, '2017-05-04 03:36:12', '0000-00-00 00:00:00', 4, 'dsf', 'dsf', 'upload/4/Ford-GT-2017-Paris-6.jpg'),
(13, '1F4G5F', 1, '2017-05-04 03:36:38', '0000-00-00 00:00:00', 5, 'dsf', 'dsf', 'upload/5/glc-x4.jpg'),
(14, 'T3M90I', 1, '2017-05-04 03:38:36', '0000-00-00 00:00:00', 5, 'sdf', 'sdf', 'upload/5/Mercedes ELK6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `code` varchar(6) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id`, `user_id`, `created_on`, `updated_on`, `code`, `titre`, `description`) VALUES
(1, 1, '2017-05-04 05:48:00', '0000-00-00 00:00:00', '9FT4GV', 'Titre du terrain', 'Déscription du projet'),
(2, 1, '2017-05-04 05:52:16', '0000-00-00 00:00:00', '2NB55G', 'Titre projet numéro 02', 'Déscription numéro 03'),
(3, 1, '2017-05-04 06:26:18', '0000-00-00 00:00:00', '29G44V', 'dfgd', 'dfgdfg'),
(4, 1, '2017-05-04 07:13:29', '0000-00-00 00:00:00', '35951S', 'sdfsd', 'sdfsdfsdfsdfsdfsdfs'),
(5, 1, '2017-05-04 07:15:47', '0000-00-00 00:00:00', '6IMMVS', 'Titre Numéro 05', 'Déscription numéro 05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contenu_projet`
--
ALTER TABLE `contenu_projet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contenu_projet`
--
ALTER TABLE `contenu_projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
