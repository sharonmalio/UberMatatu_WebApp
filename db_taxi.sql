-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2016 at 12:38 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocation`
--

CREATE TABLE IF NOT EXISTS `tbl_allocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `collect_time` datetime NOT NULL,
  `return_time` datetime DEFAULT NULL,
  `start_mileage` int(11) NOT NULL,
  `return_mileage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_allocation`
--

INSERT INTO `tbl_allocation` (`id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_mileage`, `return_mileage`) VALUES
(1, 3, 1, '2016-09-05 19:07:38', '2016-09-08 18:49:01', 32841, 234),
(2, 2, 2, '2016-09-05 19:14:48', '2016-09-06 00:07:53', 32841, 22774),
(4, 5, 2, '2016-09-05 22:57:54', '2016-09-06 00:06:50', 22712, 22774),
(5, 1, 2, '2016-09-06 14:42:50', '2016-09-08 18:48:30', 32841, 234),
(6, 3, 3, '2016-09-06 14:44:15', NULL, 23871, NULL),
(7, 4, 1, '2016-09-06 15:14:23', NULL, 32841, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_api_access`
--

CREATE TABLE IF NOT EXISTS `tbl_api_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `api_key` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_api_access`
--

INSERT INTO `tbl_api_access` (`id`, `name`, `description`, `api_key`) VALUES
(1, 'api_key', 'this verifys the app', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE IF NOT EXISTS `tbl_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_companies`
--

INSERT INTO `tbl_companies` (`id`, `name`, `description`) VALUES
(5, 'UNDP', 'UN branch'),
(6, 'UN', 'Master branch'),
(7, 'WHO', 'Health'),
(8, 'UNICEF', 'CLIMATE'),
(9, 'Kakaka', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_admins`
--

CREATE TABLE IF NOT EXISTS `tbl_company_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_company_admins`
--

INSERT INTO `tbl_company_admins` (`id`, `company_id`, `user_id`) VALUES
(1, 5, 4),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_trip`
--

CREATE TABLE IF NOT EXISTS `tbl_group_trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tbl_group_trip`
--

INSERT INTO `tbl_group_trip` (`id`, `trip_id`, `email`) VALUES
(2, 1, 'a@d.com'),
(3, 2, 'toniecairow@gmail.com'),
(4, 1, 'as@f.com'),
(5, 1, 'toniecairow@gmail.com'),
(20, 2, 'a@d.com'),
(21, 2, 'toniecairow@gmail.com'),
(22, 2, 'as@f.com'),
(23, 19, '1'),
(24, 19, 'w'),
(25, 20, '1'),
(26, 20, 'w'),
(27, 24, 'a@d.com'),
(28, 29, 'a@d.com'),
(29, 29, 'as@f.com'),
(30, 3, 'a@d.com'),
(31, 3, 'as@f.com'),
(32, 25, 'a@d.com'),
(33, 26, 'a@d.com'),
(34, 27, 'a@d.com'),
(35, 28, 'as@f.com'),
(36, 28, 'a@d.com'),
(37, 30, 'as@f.com'),
(38, 30, 'a@d.com'),
(39, 31, 'as@f.com'),
(40, 31, 'a@d.com'),
(41, 32, 'as@f.com'),
(42, 32, 'a@d.com'),
(43, 33, 'as@f.com'),
(44, 33, 'a@d.com'),
(45, 34, 'as@f.com'),
(46, 34, 'a@d.com'),
(47, 35, 'as@f.com'),
(48, 35, 'a@d.com'),
(49, 36, 'as@f.com'),
(50, 36, 'a@d.com'),
(51, 37, 'as@f.com'),
(52, 37, 'a@d.com'),
(53, 38, 'as@f.com'),
(54, 38, 'a@d.com'),
(55, 39, 'as@f.com'),
(56, 39, 'a@d.com'),
(57, 40, 'as@f.com'),
(58, 40, 'a@d.com'),
(59, 41, 'as@f.com'),
(60, 41, 'a@d.com'),
(61, 42, 'as@f.com'),
(62, 42, 'a@d.com'),
(63, 43, 'as@f.com'),
(64, 43, 'a@d.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people`
--

CREATE TABLE IF NOT EXISTS `tbl_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(200) NOT NULL,
  `lName` varchar(200) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `allocation_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_people`
--

INSERT INTO `tbl_people` (`id`, `fName`, `lName`, `phone_no`, `type`, `user_id`, `allocation_status`) VALUES
(1, 'Kamau', 'Lexxy', 743678154, 1, 1, 0),
(3, 'Ashley', 'Fernandez', 748731532, 3, 2, 0),
(4, 'Willy', 'Pozzee', 723618522, 1, 4, 1),
(5, 'ZAZA', 'LAem', 743678154, 3, 3, 0),
(6, '', '', 0, 3, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people_type`
--

CREATE TABLE IF NOT EXISTS `tbl_people_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(300) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_people_type`
--

INSERT INTO `tbl_people_type` (`id`, `description`, `type_name`) VALUES
(1, 'Company''s manager', 'Operations Manager  '),
(2, 'Drives the cabs', 'Driver'),
(3, 'In charge of all projects', 'Project Manager'),
(4, 'Runs cab company', 'Dispatcher  '),
(5, 'Works in a company project', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE IF NOT EXISTS `tbl_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id`, `name`, `description`, `company_id`) VALUES
(1, 'Turkana Project', 'Food aid and health services', 2),
(2, 'Motor Hallo', 'Motorola', 4),
(4, 'Metropolitan', 'Allah', 3),
(5, 'Motic Hallo', 'Motorola', 4),
(6, 'BYOB', 'Bring your own Buzz', 7),
(7, 'Huduma', 'service to all', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_people`
--

CREATE TABLE IF NOT EXISTS `tbl_project_people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_project_people`
--

INSERT INTO `tbl_project_people` (`id`, `project_id`, `user_id`, `accepted`) VALUES
(1, 1, 1, 0),
(2, 4, 4, 0),
(3, 7, 3, 0),
(4, 7, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trips`
--

CREATE TABLE IF NOT EXISTS `tbl_trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_mileage` int(11) DEFAULT NULL,
  `end_mileage` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trip_date` date NOT NULL,
  `trip_time` time NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `stop_time` datetime DEFAULT NULL,
  `trip_creator` int(11) NOT NULL,
  `start_coordinate` varchar(200) NOT NULL,
  `end_coordinate` varchar(200) NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0',
  `enroute` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tbl_trips`
--

INSERT INTO `tbl_trips` (`id`, `start_mileage`, `end_mileage`, `date`, `trip_date`, `trip_time`, `vehicle_id`, `start_time`, `stop_time`, `trip_creator`, `start_coordinate`, `end_coordinate`, `approval`, `enroute`) VALUES
(1, NULL, NULL, '2016-09-18 20:26:21', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(2, NULL, NULL, '2016-09-18 20:26:43', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(3, NULL, NULL, '2016-09-18 20:28:21', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(4, NULL, NULL, '2016-09-18 20:29:16', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(5, NULL, NULL, '2016-09-18 20:29:25', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(6, NULL, NULL, '2016-09-18 20:30:06', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(7, NULL, NULL, '2016-09-18 20:30:37', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(8, NULL, NULL, '2016-09-18 20:31:08', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(9, NULL, NULL, '2016-09-18 20:31:31', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(10, NULL, NULL, '2016-09-18 20:32:07', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(11, NULL, NULL, '2016-09-18 20:32:25', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(12, NULL, NULL, '2016-09-18 20:33:58', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(13, NULL, NULL, '2016-09-18 20:34:14', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(14, NULL, NULL, '2016-09-18 20:34:39', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(15, NULL, NULL, '2016-09-18 20:35:31', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(16, NULL, NULL, '2016-09-18 20:35:41', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(17, NULL, NULL, '2016-09-18 20:36:31', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(18, NULL, NULL, '2016-09-18 20:36:40', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(19, NULL, NULL, '2016-09-18 20:37:25', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(20, NULL, NULL, '2016-09-18 20:39:28', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(21, NULL, NULL, '2016-09-18 20:40:22', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(22, NULL, NULL, '2016-09-18 20:40:48', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(23, NULL, NULL, '2016-09-18 20:41:06', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(24, NULL, NULL, '2016-09-18 20:41:30', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(25, NULL, NULL, '2016-09-18 20:46:11', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(26, NULL, NULL, '2016-09-18 20:50:27', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(27, NULL, NULL, '2016-09-18 20:53:25', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(28, NULL, NULL, '2016-09-18 20:54:20', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(29, NULL, NULL, '2016-09-18 20:58:01', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(30, NULL, NULL, '2016-09-18 21:08:28', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(31, NULL, NULL, '2016-09-18 21:08:50', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(32, NULL, NULL, '2016-09-18 21:09:16', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(33, NULL, NULL, '2016-09-18 21:10:02', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(34, NULL, NULL, '2016-09-18 21:10:49', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(35, NULL, NULL, '2016-09-18 21:10:55', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(36, NULL, NULL, '2016-09-18 21:11:15', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(37, NULL, NULL, '2016-09-18 21:12:22', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(38, NULL, NULL, '2016-09-18 21:17:16', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(39, NULL, NULL, '2016-09-18 21:18:07', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(40, NULL, NULL, '2016-09-18 21:18:40', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(41, NULL, NULL, '2016-09-18 22:30:20', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(42, NULL, NULL, '2016-09-18 22:30:25', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL),
(43, NULL, NULL, '2016-09-18 22:31:49', '2016-09-18', '20:06:47', NULL, NULL, NULL, 1, '-1.3256680999999997,36.950165399999996', '-0.29641530000000005,36.0689852', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_level_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `password`, `user_level_id`) VALUES
(1, 'toniecairow@gmail.com', 'Shoulder1$', 0),
(2, 'a@b.c', '12345', 0),
(3, 'a@d.com', '12345', 0),
(4, 'as@f.com', '1234', 0),
(5, 'markwahome@live.com', '11032', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_tokens`
--

CREATE TABLE IF NOT EXISTS `tbl_user_tokens` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `api_access_id` int(11) NOT NULL,
  `token` varchar(24) NOT NULL,
  `given_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_user_tokens`
--

INSERT INTO `tbl_user_tokens` (`token_id`, `user_id`, `api_access_id`, `token`, `given_date`, `expire_date`) VALUES
(4, 1, 1, '353c065b7d72b7617056e375', '2016-09-13 10:03:30', '2016-09-13 10:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE IF NOT EXISTS `tbl_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate` varchar(25) NOT NULL,
  `model_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `vehicle_use` int(11) NOT NULL DEFAULT '0',
  `vehicle_dispatched` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `plate`, `model_id`, `capacity`, `vehicle_use`, `vehicle_dispatched`) VALUES
(2, 'KAZ 123Y', 2, 5, 0, 0),
(3, 'KAZ 123Y', 1, 4, 0, 0),
(4, 'KBY 534T', 3, 4, 1, 0),
(5, 'KBZ 327X', 5, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_make`
--

CREATE TABLE IF NOT EXISTS `tbl_vehicle_make` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_vehicle_make`
--

INSERT INTO `tbl_vehicle_make` (`id`, `make`) VALUES
(1, 'Toyota'),
(2, 'Nissan'),
(3, 'Mitsubishi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_model`
--

CREATE TABLE IF NOT EXISTS `tbl_vehicle_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(25) NOT NULL,
  `make_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_vehicle_model`
--

INSERT INTO `tbl_vehicle_model` (`id`, `model`, `make_id`) VALUES
(1, 'Xtrail', 2),
(2, 'Noah', 1),
(3, 'Wish', 3),
(4, 'Prado', 1),
(5, 'Colt', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
