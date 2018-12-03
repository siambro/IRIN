-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 11:18 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buyfromabroad`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_user`
--

CREATE TABLE `about_user` (
  `id` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `education` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `nid` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_user`
--

INSERT INTO `about_user` (`id`, `phone`, `address1`, `address2`, `education`, `description`, `nid`, `user_id`) VALUES
(1, '01730176622', 'Lichubagan, Kalachandpur', 'Gulshan 2', 'DIA', 'Description about user', '12345678', 3),
(2, '01730176622', 'GUlshan', 'Dhaka', 'DIA', 'No desc\r\n', '1235465768678', 4),
(3, '01734873473', 'Lichubagan, Kalachandpur', '1212', 'Daffodil', 'desc......', '12345678', 2),
(4, '01909988233', 'CP', 'CTG', 'Ju', 'NO desc. .......', '1234567890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `s_post_id` int(11) NOT NULL,
  `t_post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `s_post_id`, `t_post_id`, `user_id`, `time`) VALUES
(1, 'first comment to shopper post', 1, 0, 2, '2018-11-07 00:00:00'),
(2, 'comment on shopper post 2', 2, 0, 2, '2018-11-09 00:00:00'),
(3, 'first comment to shopper post', 1, 0, 2, '2018-11-07 00:00:00'),
(4, 'i can bring it for you', 3, 0, 4, '2018-11-11 21:43:29'),
(5, 'sorry i cant', 3, 0, 4, '2018-11-11 21:46:30'),
(6, 'i need some thing from there\r\n', 0, 1, 1, '2018-11-11 21:46:30'),
(7, 'Bring something for meeee T2', 0, 3, 1, '2018-11-13 23:30:15'),
(8, 'for mee also', 0, 3, 1, '2018-11-13 23:31:52'),
(9, 'bring me Zam Zam', 0, 2, 1, '2018-11-13 23:42:06'),
(10, 'bring me tooo ', 0, 2, 3, '2018-11-18 12:11:22'),
(11, 'bring me tooo ', 0, 3, 3, '2018-11-18 12:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `shopper_post`
--

CREATE TABLE `shopper_post` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `items` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `choose_country` varchar(30) NOT NULL,
  `c_id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopper_post`
--

INSERT INTO `shopper_post` (`id`, `title`, `items`, `description`, `choose_country`, `c_id`, `bidder_id`, `timestamp`) VALUES
(1, 'Need Lipsticks from US', 'Lipsticks', 'Lipsticks description', 'United_States', 1, 4, '2018-11-21 01:17:10'),
(2, 'Need Eye Shadow from Canad', 'Eye Shadow', 'Eye Shadow Description', 'Canada', 1, 0, '2018-11-21 00:01:20'),
(3, 'Need Lipliner from USA', 'Lipliner ', 'Lipliner description no', 'Jordan', 3, 0, '2018-11-19 13:53:00'),
(4, 'Need parts from BD', 'Motorcycle', 'i need motorcycle from BD ', 'Bangladesh', 3, 0, '2018-11-19 13:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `s_post_bid`
--

CREATE TABLE `s_post_bid` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_post_bid`
--

INSERT INTO `s_post_bid` (`id`, `post_id`, `t_id`, `timestamp`) VALUES
(13, 1, 4, '2018-11-19 17:33:13'),
(14, 4, 2, '2018-11-21 03:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `traveller_post`
--

CREATE TABLE `traveller_post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `going_country` varchar(20) NOT NULL,
  `going_date` varchar(30) NOT NULL,
  `t_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traveller_post`
--

INSERT INTO `traveller_post` (`id`, `title`, `description`, `going_country`, `going_date`, `t_id`, `timestamp`) VALUES
(1, 'Going America', 'If you need anything you can knock', 'Amarica', '2018-11-18', 2, '0000-00-00 00:00:00'),
(2, 'Going Saudi', 'If you need anything you can knock me ', 'Saudi', '2018-11-20', 4, '0000-00-00 00:00:00'),
(3, 'Going Saudi Arab', 'If you need anything you can knock me ', 'Saudi', '2018-11-29', 4, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `name`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '12345', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE `user_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Shopper 1', 'shopper1@gmail.com', '12345', 'shopper'),
(2, 'Traveller 1', 'traveller1@gmail.com', '12345', 'traveller'),
(3, 'Shopper 2', 'shopper2@gmail.com', '12345', 'shopper'),
(4, 'Traveller 2', 'traveller2@gmail.com', '12345', 'traveller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_user`
--
ALTER TABLE `about_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopper_post`
--
ALTER TABLE `shopper_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_post_bid`
--
ALTER TABLE `s_post_bid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traveller_post`
--
ALTER TABLE `traveller_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_customer`
--
ALTER TABLE `user_customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_user`
--
ALTER TABLE `about_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `shopper_post`
--
ALTER TABLE `shopper_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `s_post_bid`
--
ALTER TABLE `s_post_bid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `traveller_post`
--
ALTER TABLE `traveller_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_customer`
--
ALTER TABLE `user_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
