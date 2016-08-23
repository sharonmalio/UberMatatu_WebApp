-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2016 at 02:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `class_asst`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `description` text,
  `type` int(11) NOT NULL COMMENT 'from act_types tables',
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `act_times`
--

CREATE TABLE IF NOT EXISTS `act_times` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_id` int(11) NOT NULL COMMENT 'from activities',
  `start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stop` datetime NOT NULL,
  `recur_type` int(11) NOT NULL COMMENT 'from recur_types',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `act_types`
--

CREATE TABLE IF NOT EXISTS `act_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `act_types`
--

INSERT INTO `act_types` (`id`, `name`, `description`) VALUES
(1, 'Class', 'Unit in course'),
(2, 'CAT', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_lists`
--

CREATE TABLE IF NOT EXISTS `admin_lists` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `admin_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `api_access`
--

CREATE TABLE IF NOT EXISTS `api_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `api_key` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `api_access`
--

INSERT INTO `api_access` (`id`, `name`, `description`, `api_key`) VALUES
(1, 'AndroidApp', 'API key for the android app', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `group_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `year` date NOT NULL,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `name` int(15) NOT NULL,
  `course_code` varchar(7) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_lists`
--

CREATE TABLE IF NOT EXISTS `group_lists` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'student or lecturer id',
  `blocked` bit(1) NOT NULL DEFAULT b'0',
  `admin` bit(1) NOT NULL DEFAULT b'0' COMMENT 'boolean for groups that can have admins',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_types`
--

CREATE TABLE IF NOT EXISTS `group_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_type_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `group_types`
--

INSERT INTO `group_types` (`type_id`, `group_type_name`, `description`) VALUES
(1, 'Class', ''),
(2, 'School', ''),
(3, 'Student Group', '');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recur_types`
--

CREATE TABLE IF NOT EXISTS `recur_types` (
  `recur_id` int(11) NOT NULL,
  `recur_name` varchar(15) NOT NULL,
  `description` text,
  PRIMARY KEY (`recur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recur_types`
--

INSERT INTO `recur_types` (`recur_id`, `recur_name`, `description`) VALUES
(0, 'None', NULL),
(1, 'Daily', NULL),
(2, 'Weekly', NULL),
(3, 'Monthly', NULL),
(4, 'Annually', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `group_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `user_id` int(11) NOT NULL,
  `student_id_no` varchar(20) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(25) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `fname`, `lname`) VALUES
(1, 'markwahome@live.com', NULL, '11032', '', ''),
(2, 'markwahom@live.com', NULL, '11032', '', ''),
(3, 'test@c.com', NULL, '11032', '', ''),
(4, 'test@cc.com', NULL, '11032', '', ''),
(5, 'a@b.c', NULL, '11111', '', ''),
(6, 'a@b.com', NULL, 'aaaaa', '', ''),
(7, 'pres@c.com', NULL, '12345', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `api_access_id` int(11) NOT NULL,
  `token` varchar(20) NOT NULL,
  `date_given` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `user_id` (`user_id`,`api_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`token_id`, `user_id`, `api_access_id`, `token`, `date_given`, `expiry_date`) VALUES
(42, 4, 1, 'b99188d67a44a52dd1c0', '2016-05-19 08:57:02', NULL),
(44, 5, 1, '97df4e6ce5139da8798a', '2016-05-19 09:10:56', NULL),
(45, 6, 1, '5d90514dda9ffe663ea4', '2016-05-19 09:12:56', NULL),
(47, 1, 1, '58d9689c3efdf117548e', '2016-05-19 10:04:46', NULL),
(48, 2, 1, '44f5f64c059cda4a13e7', '2016-08-19 12:08:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `priviledge` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`type_id`, `name`, `priviledge`, `description`) VALUES
(1, 'Student', NULL, ''),
(2, 'Lecturer', NULL, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
