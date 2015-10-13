-- phpMyAdmin SQL Dump
-- version 4.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2014 at 07:32 AM
-- Server version: 5.5.37-MariaDB-log
-- PHP Version: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `memusage`
--

-- --------------------------------------------------------

--
-- Table structure for table `memstats`
--

CREATE TABLE IF NOT EXISTS `memstats` (
`id` int(11) NOT NULL,
  `memfree` mediumint(9) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='stores the amount of free memory available to server' AUTO_INCREMENT=48 ;

--
-- Dumping data for table `memstats`
--

INSERT INTO `memstats` (`id`, `memfree`, `timestamp`) VALUES
(1, 45565, '2014-07-23 04:13:08'),
(2, 45565, '2014-07-23 04:13:08'),
(9, 103340, '2014-06-29 02:43:01'),
(10, 102768, '2014-06-29 04:20:56'),
(11, 102264, '2014-06-29 04:23:11'),
(12, 101744, '2014-06-29 07:41:04'),
(13, 105120, '2014-06-29 10:00:01'),
(14, 112980, '2014-06-29 16:00:01'),
(15, 107960, '2014-06-29 22:00:01'),
(16, 107248, '2014-06-30 04:00:01'),
(17, 105692, '2014-06-30 10:00:01'),
(18, 161680, '2014-06-30 16:00:01'),
(19, 159884, '2014-06-30 22:00:01'),
(20, 157028, '2014-07-01 04:00:01'),
(21, 98160, '2014-07-01 06:57:25'),
(22, 97752, '2014-07-01 06:58:21'),
(23, 96948, '2014-07-01 07:03:49'),
(24, 92304, '2014-07-01 10:00:01'),
(25, 145476, '2014-07-01 16:00:01'),
(26, 140608, '2014-07-01 22:00:01'),
(27, 143888, '2014-07-02 04:00:01'),
(28, 133104, '2014-07-02 06:42:02'),
(29, 32452, '2014-07-02 10:00:01'),
(30, 102876, '2014-07-02 16:00:01'),
(31, 95264, '2014-07-02 21:17:43'),
(32, 98324, '2014-07-02 22:00:01'),
(33, 96396, '2014-07-03 04:00:01'),
(34, 95756, '2014-07-03 10:00:01'),
(35, 163968, '2014-07-03 16:00:01'),
(36, 157400, '2014-07-03 22:00:01'),
(37, 98320, '2014-07-04 01:30:51'),
(38, 96672, '2014-07-04 01:31:12'),
(39, 100372, '2014-07-04 04:00:01'),
(40, 83328, '2014-07-04 10:00:01'),
(41, 131612, '2014-07-04 16:00:01'),
(42, 125660, '2014-07-04 22:00:01'),
(43, 125060, '2014-07-05 04:00:01'),
(44, 66048, '2014-07-05 07:45:46'),
(45, 64508, '2014-07-05 10:00:01'),
(46, 168276, '2014-07-05 16:00:01'),
(47, 145020, '2014-07-06 08:26:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memstats`
--
ALTER TABLE `memstats`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memstats`
--
ALTER TABLE `memstats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
