-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2017 at 02:56 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cbot_campaign`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `email`) VALUES
(1, 'adarsh@medpicky.com'),
(2, 'abhyaya@medpicky.com'),
(3, 'ambady@medpicky.com'),
(4, 'das@medpicky.com'),
(5, 'nandu@medpicky.com'),
(6, 'aiswarya@medpicky.com'),
(7, 'arjun@medpicky.com'),
(8, 'asokan@medpicky.com'),
(9, 'aswathy@medpicky.com'),
(10, 'bhagwandas@medpicky.com'),
(11, 'campaign@medpicky.com'),
(12, 'deepak@medpicky.com');

-- --------------------------------------------------------

--
-- Table structure for table `email_sent_status`
--

CREATE TABLE IF NOT EXISTS `email_sent_status` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `mail_type_id` tinyint(1) NOT NULL,
  `send_status_id` tinyint(1) DEFAULT NULL COMMENT '0 : not send; 1: sent',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `email_sent_status`
--

INSERT INTO `email_sent_status` (`id`, `to_email`, `subject`, `mail_type_id`, `send_status_id`) VALUES
(1, 'jishnu2292@gmail.com', '1', 1, 1),
(2, 'jishnu2292@gmail.com', 'Low cost Premium website from Team Medpicky', 1, 1),
(3, 'jishnu2292@gmail.com', 'Low cost Premium website from Team Medpicky', 1, 1),
(4, 'jishnu2292@gmail.com', 'Low cost Premium website from Team Medpicky', 1, 1),
(5, 'jishnu2292@gmail.com', 'Low cost Premium website from Team Medpicky', 1, 1),
(6, 'sujith.s.89@gmail.com,jishnu2292@gmail.com,rcdeepak5412@gmail.com', 'Low cost Premium website from Team Medpicky', 1, 1),
(7, 'adarsh@medpicky.com', '2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!', 1, 1),
(8, 'abhyaya@medpicky.com', '2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!', 1, 1),
(9, 'adarsh@medpicky.com', '2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!', 1, 1),
(10, 'adarsh@medpicky.com', '2nd-anniversary big offer, Doctors Premium website for Rs 4999/- only Hurry!', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `is_admin`, `is_confirmed`, `is_deleted`) VALUES
(1, 'jishnu2292', 'jishnu2292@gmail.com', '$2y$10$/WbRP5z53Jg602uQvCEj5uDA3x2dVcoQ6O5V7Xll4IGztVkNWGm.i', 'default.jpg', '2017-08-03 14:53:16', NULL, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;