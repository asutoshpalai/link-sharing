-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2015 at 05:41 PM
-- Server version: 5.5.41
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `palai`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `linkid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `link` varchar(200) NOT NULL,
  `votes` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`linkid`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`linkid`, `userid`, `link`, `votes`, `datetime`) VALUES
(1, 1, 'www.google.com', 71, '2015-01-21 13:01:20'),
(7, 4, 'google.com', 6, '2015-01-21 20:32:02'),
(9, 1, 'msn.com', 88, '2015-01-25 11:49:16'),
(11, 2, 'ping.com', 88, '2015-01-25 11:54:31'),
(12, 2, 'sdslabs.co.in', 106, '2015-01-25 11:54:48'),
(13, 2, 'kjfdashjk.fdjkj', 53, '2015-01-25 17:07:24'),
(14, 7, 'cc', 88, '2015-01-25 18:49:28'),
(15, 7, 'aa', 8, '2015-01-25 18:49:45'),
(16, 7, 'mnmn', 7, '2015-01-26 20:23:22'),
(17, 8, 'yo%21', 14, '2015-01-26 21:10:24'),
(18, 8, '12', 88, '2015-01-26 21:10:36'),
(19, 8, 'ajax+in+action', 103, '2015-01-26 21:10:52'),
(20, 9, 'afddg', 77, '2015-01-27 20:23:18'),
(40, 2, 'hello.com', 88, '2015-01-28 11:58:53'),
(41, 2, 'nawfnewkanf', 88, '2015-01-29 06:31:37'),
(42, 2, 'gmklsengklsrnglkse', 112, '2015-01-29 06:35:05'),
(43, 2, '+fjkesf+kjesnfl', 0, '2015-01-29 06:35:10'),
(44, 2, 'dsknvksj', 0, '2015-01-29 06:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`) VALUES
(1, 'asutosh', 'qwerty'),
(2, 'dummy', 'dummy'),
(3, '1', '1'),
(4, 'name', 'namer'),
(5, 'test', '12345'),
(6, 'gvaibhav21', '1234'),
(7, 'zz', 'zz'),
(8, 'hey', 'hi'),
(9, 'gvaibhav', 'justdoit');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
