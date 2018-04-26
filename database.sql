-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2018 at 12:04 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokedawn_hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL,
  `pts` int(11) NOT NULL,
  `word` varchar(50) NOT NULL,
  `opposite` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dictionary`
--

INSERT INTO `dictionary` (`id`, `pts`, `word`, `opposite`) VALUES
(1, 1, 'good', 'bad'),
(2, -1, 'bad', 'good'),
(3, 1, 'nice', 'shit'),
(4, -2, 'worst', 'best'),
(5, 2, 'best', 'worst'),
(6, -1, 'overpriced', 'best price'),
(7, 2, 'excellent', 'very bad'),
(8, -1, 'poor', 'great'),
(9, 1, 'worthy', 'unworthy'),
(10, 1, 'like', 'dislike'),
(11, -1, 'fake', 'real'),
(12, 1, 'expected', 'unexpected'),
(13, 2, 'awesome', 'worst'),
(14, 2, 'terrific', 'terrible'),
(15, 2, 'terrible', 'terrific'),
(16, 2, 'fabulous', 'weird');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `company` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `review` text NOT NULL,
  `time_searched` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `company`, `url`, `review`, `time_searched`, `product_name`) VALUES
(3, 'Amazon', '', 'Just Awesome , nothing else...Gold is better than graphite...\n', 0, 'OnePlus 3'),
(4, 'Amazon', '', 'Pretty good..', 0, 'Iphone 6s'),
(5, 'Flipkart', '', 'Everything is good about this iPhone except its Price :( People out there waiting for this iPhone including me from a very long time but unable to buy this due its overprice. I hope Apple India will realise  excellent this and soon bring its price down good and will see some happy customers :)  Cheers to those who are enjoying there brand new iPhone 6s (y) ', 0, 'Iphone 6s'),
(1, 'Amazon', '', 'I have used OnePlus One, then OnePlus 2 and now OnePlus 3. OnePlus was an experimental startup project from OPPO and now It has turned into a brand name. All three devices have the killer hardware but we all know that powerful hardware alone not enough to make a good piece of technology, software plays an important role too. iPhone is the example and this is where OnePlus failed in beginning. OnePlus started with Cyanogen OS then they had to move on Hydrogen & Oxygen OS but now they are merging both Hydrogen and Oxygen OS. What will be the result? In this review, I will share everything about OnePlus 3 including some good and bad things about OnePlus 3 based on my 3 months experience.', 0, 'OnePlus 3'),
(2, 'Amazon', '', 'One of the worst phone, even basics calling also have issues.Many time it is not getting disconnected and needed to restart phone.Please don\'t throw your money in water.', 0, 'OnePlus 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `steamId32` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `steamId64` bigint(20) NOT NULL,
  `tradeToken` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dictionary`
--
ALTER TABLE `dictionary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
