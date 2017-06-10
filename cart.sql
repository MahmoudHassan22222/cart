-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 06:31 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` varchar(75) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `cat_name`, `cat_desc`, `status`) VALUES
(1, 'Computer', 'Desktop and laptop', 1),
(10, 'Internet', 'WiFi and Wireless', 1),
(11, 'Mobiles', 'Andriod and iPhone', 0),
(12, 'Books', 'Arabic, English', 1),
(13, 'Games', 'All Games', 0),
(14, 'Accessories', 'computer, net', 0),
(15, 'Electronics', 'TV , LCD', 0),
(16, 'Cloths', 'Men and Woman', 0),
(18, 'Home Accessories', 'kitchen and Accessories', 0),
(19, 'Books2', '', 0),
(20, 'test cat', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_user` int(11) NOT NULL,
  `prod_cat` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `prod_desc`, `prod_user`, `prod_cat`, `date_created`, `images`) VALUES
(2, 'Laptop Dell', 'HP X2 Laptop is equipped with high end specs such as a powerful Intel Atom processor. This HP detachable laptop lets you do your computing tasks with ease.The HP X2 10 p000ne 2 in 1 Laptop features a multitude of features that exceed expectations. Sporting a beautiful red finish, this HP detachable laptop offers a pleasant computing experience on the go. The ability to detach the screen lets you go flexible while working or viewing multimedia. A 10.1inch IPS WXGA backlit touchscreen graces this device and renders pictures at 1280 x 800 pixels. The Intel HD Graphics 400 graphics card immerses you into enhanced viewing performance too. Additionally, the HP X2 is equipped with an Intel Atom processor and about 2GB RAM module that facilitates quick processing and multitasking results. Add to this an extensive 32GB internal drive storage capacity that ensures all your files are stored securely without any issue. Furthermore, this HP laptop with a detachable screen is equipped with a two cell, 32.5Wh Lithium Ion battery with support for fast charging to provide extended runtime so you can play games and work minus any lags. Preinstalled with Windows 10, this HP X2 laptop boosts your productivity and entertainment with its cutting edge features. Also, this device is ENERGY STAR certified, thus saving energy and keeping you environment friendly.\r\n\r\n', 5, 14, '0000-00-00 00:00:00', ''),
(3, 'LG Samsung', 'lg samsung', 2, 1, '0000-00-00 00:00:00', ''),
(4, 'toshiba', 'toshiba', 5, 14, '0000-00-00 00:00:00', ''),
(5, 'Hard Disk', 'HD 500 GB', 7, 14, '0000-00-00 00:00:00', ''),
(7, 'Sony 15x', 'Sony Mobile', 14, 11, '0000-00-00 00:00:00', ''),
(8, 'lcd', 'lcd', 2, 1, '0000-00-00 00:00:00', ''),
(9, 'test', 'test', 2, 1, '0000-00-00 00:00:00', ''),
(15, 'Speaker 100', '', 3, 1, '2017-06-03 20:06:52', ''),
(16, 'Speaker 200', '', 3, 1, '2017-06-03 20:07:14', ''),
(17, 'Speaker 300', '', 3, 1, '2017-06-03 20:07:34', ''),
(18, 'Speaker 400', '', 3, 1, '2017-06-03 20:07:48', ''),
(19, 'HP Computer 44', '', 3, 1, '2017-06-03 20:08:17', ''),
(20, 'Xperia', '', 3, 1, '2017-06-03 20:08:48', ''),
(26, 'LG Elaraby', 'lg', 2, 1, '2017-06-05 22:23:40', '72501_portfolio1.png'),
(27, 'Power Supply', 'Power supply 1000W', 2, 1, '2017-06-05 22:55:51', '80503_p4.jpg'),
(28, 'Hard Disk', '', 2, 10, '2017-06-07 01:13:29', '53595_code2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `user_group` int(11) NOT NULL DEFAULT '0',
  `avatars` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `activated`, `user_group`, `avatars`) VALUES
(2, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mmm', 'm@m.com', 1, 1, '15029908_p2.jpg'),
(3, 'mahmoud', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mahmoud Hassan', 'mahmoud@gmail.com', 1, 1, '34774781_header.png'),
(5, 'ramadanhassan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ramadan Hassan', 'ramadan@gmail.com', 1, 0, ''),
(6, 'AbdElgwad', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'AbdElgwad Hassan', 'abdoo@gmail.com', 1, 0, ''),
(7, 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mohamed Ali', 'mohamed@gmail.com', 1, 0, ''),
(8, 'Gamal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Gamal Ahmed', 'gamal@gmail.com', 1, 0, ''),
(10, 'Fatihy', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 'Fatihy Ali', 'fatihy@gmail.com', 0, 0, ''),
(11, 'Alaa', '42cfe854913594fe572cb9712a188e829830291f', 'Alaa Ali', 'alaa33@gmail.com', 1, 0, ''),
(12, 'Samah', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Samah Mohamed', 'samah@gmail.com', 0, 0, ''),
(13, 'Nesma', '8120772a457f8cc3900cf95039d9d89cfefd91a0', 'Nesma Radwan', 'nesma@gmail.com', 0, 0, ''),
(14, 'rady', '2ef964906723d9c66cc35a9d63b0ca34fde99086', 'Rady Gamal', 'rady@gmail.com', 0, 0, ''),
(15, 'Adel', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'AdelHASSAN', 'adel88h@gmail.com', 0, 0, ''),
(16, 'salem', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'MAHMOUD HASSAN', 'mahmoudhassan9933@gmail.com', 0, 0, ''),
(17, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Fatihy Ali', 'elkncssss@gmail.com', 0, 0, ''),
(19, 'hady', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Hady Ahmed', 'hady@gmail.com', 0, 0, ''),
(20, 'asmaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'AsmaaRadwan', 'asmaa@gmail.com', 0, 0, ''),
(22, 'fff', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', 0, 0, ''),
(24, 'doaa', '4bc0612643022f0f65462bfc2c8fc8ce89a867c4', 'Doaa HASSAN', 'doaa01@gmail.com', 0, 0, '34774781_header.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_usr` (`prod_user`),
  ADD KEY `prod_categ` (`prod_cat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `prod_categ` FOREIGN KEY (`prod_cat`) REFERENCES `cat` (`id`),
  ADD CONSTRAINT `prod_usr` FOREIGN KEY (`prod_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
