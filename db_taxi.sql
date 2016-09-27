-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 03:30 PM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.11-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_taxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocation`
--

CREATE TABLE `tbl_allocation` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `collect_time` datetime NOT NULL,
  `return_time` datetime DEFAULT NULL,
  `start_mileage` int(11) NOT NULL,
  `return_mileage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allocation`
--

INSERT INTO `tbl_allocation` (`id`, `vehicle_id`, `driver_id`, `collect_time`, `return_time`, `start_mileage`, `return_mileage`) VALUES
(1, 3, 1, '2016-09-05 19:07:38', '2016-09-08 18:49:01', 32841, 234),
(2, 2, 2, '2016-09-05 19:14:48', '2016-09-06 00:07:53', 32841, 22774),
(4, 5, 2, '2016-09-05 22:57:54', '2016-09-06 00:06:50', 22712, 22774),
(5, 1, 2, '2016-09-06 14:42:50', '2016-09-08 18:48:30', 32841, 234),
(6, 3, 3, '2016-09-06 14:44:15', NULL, 23871, NULL),
(7, 4, 1, '2016-09-06 15:14:23', NULL, 32841, NULL),
(8, 5, 3, '2016-09-20 00:11:09', NULL, 5256, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_api_access`
--

CREATE TABLE `tbl_api_access` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `api_key` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_api_access`
--

INSERT INTO `tbl_api_access` (`id`, `name`, `description`, `api_key`) VALUES
(1, 'api_key', 'this verifys the app', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companies`
--

CREATE TABLE `tbl_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_company_admins` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_group_trip` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(32, 37, 'a@d.com'),
(33, 37, 'as@f.com'),
(34, 38, 'a@d.com'),
(35, 38, 'as@f.com'),
(36, 39, 'a@d.com'),
(37, 39, 'as@f.com'),
(38, 40, 'a@d.com'),
(39, 40, 'as@f.com'),
(40, 40, 'toniecairow@gmail.com'),
(41, 41, 'a@d.com'),
(42, 41, 'as@f.com'),
(43, 41, 'toniecairow@gmail.com'),
(44, 46, 'a@d.com'),
(45, 46, 'as@f.com'),
(46, 46, 'toniecairow@gmail.com'),
(47, 47, 'a@d.com'),
(48, 47, 'as@f.com'),
(49, 47, 'toniecairow@gmail.com'),
(50, 48, 'a@d.com'),
(51, 48, 'as@f.com'),
(52, 48, 'toniecairow@gmail.com'),
(53, 37, 'sad@gwa.com'),
(56, 37, 'asdf@gmail.com'),
(57, 37, 'asdf@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people`
--

CREATE TABLE `tbl_people` (
  `id` int(11) NOT NULL,
  `fName` varchar(200) NOT NULL,
  `lName` varchar(200) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `allocation_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_people`
--

INSERT INTO `tbl_people` (`id`, `fName`, `lName`, `phone_no`, `type`, `user_id`, `allocation_status`) VALUES
(1, 'Kamau', 'Lexxy', 743678154, 1, 1, 0),
(3, 'Ashley', 'Fernandez', 748731532, 3, 2, 0),
(4, 'Willy', 'Pozzee', 723618522, 1, 4, 1),
(5, 'ZAZA', 'LAem', 743678154, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people_type`
--

CREATE TABLE `tbl_people_type` (
  `id` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_people_type`
--

INSERT INTO `tbl_people_type` (`id`, `description`, `type_name`) VALUES
(1, 'Company\'s manager', 'Operations Manager  '),
(2, 'Drives the cabs', 'Driver'),
(3, 'In charge of all projects', 'Project Manager'),
(4, 'Runs cab company', 'Dispatcher  '),
(5, 'Works in a company project', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_project_people` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_project_people`
--

INSERT INTO `tbl_project_people` (`id`, `project_id`, `user_id`, `accepted`) VALUES
(1, 1, 1, 1),
(2, 4, 4, 3),
(3, 7, 3, 5),
(4, 7, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trips`
--

CREATE TABLE `tbl_trips` (
  `id` int(11) NOT NULL,
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
  `start_location` varchar(100) DEFAULT NULL,
  `end_coordinate` varchar(200) NOT NULL,
  `end_location` varchar(100) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '0',
  `enroute` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trips`
--

INSERT INTO `tbl_trips` (`id`, `start_mileage`, `end_mileage`, `date`, `trip_date`, `trip_time`, `vehicle_id`, `start_time`, `stop_time`, `trip_creator`, `start_coordinate`, `start_location`, `end_coordinate`, `end_location`, `project_id`, `approval`, `enroute`) VALUES
(3, NULL, NULL, '2016-08-28 13:48:56', '0000-00-00', '00:00:00', NULL, NULL, NULL, 2, '54321465232E', NULL, '643236547N', NULL, 0, 0, NULL),
(4, NULL, NULL, '2016-09-08 16:19:40', '0000-00-00', '00:00:00', 2, NULL, NULL, 1, '67321465232E', NULL, '139236547N', NULL, 0, 0, NULL),
(5, NULL, NULL, '2016-08-30 11:22:08', '0000-00-00', '00:00:00', NULL, NULL, NULL, 1, '67321465232E', NULL, '139236547N', NULL, 0, 0, NULL),
(6, 1249, NULL, '2016-09-19 20:21:44', '0000-00-00', '00:00:00', NULL, '2016-09-06 17:37:13', NULL, 1, '88321E', NULL, '98947N', NULL, 0, 0, NULL),
(31, NULL, NULL, '2016-09-15 05:33:53', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 0, NULL),
(32, NULL, NULL, '2016-09-15 07:37:08', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 0, NULL),
(33, NULL, NULL, '2016-09-19 20:24:22', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 1, NULL),
(34, NULL, NULL, '2016-09-15 07:40:15', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 0, NULL),
(37, NULL, NULL, '2016-09-25 18:43:14', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 1, NULL),
(40, NULL, NULL, '2016-09-19 20:25:22', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', NULL, '234234E', NULL, 0, 1, NULL),
(41, NULL, NULL, '2016-09-19 20:33:50', '2016-10-12', '13:00:00', 2, NULL, NULL, 1, '35264N', 'Nairobi', 'Kisumu', '234234E', 0, 1, NULL),
(42, NULL, NULL, '2016-09-19 13:58:38', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(43, NULL, NULL, '2016-09-19 14:00:21', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(44, NULL, NULL, '2016-09-19 14:01:07', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(45, NULL, NULL, '2016-09-19 14:03:43', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(46, NULL, NULL, '2016-09-19 14:04:25', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(47, NULL, NULL, '2016-09-19 14:07:30', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 0, NULL),
(48, NULL, NULL, '2016-09-19 21:16:22', '2016-10-12', '13:00:00', 4, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Nairobi', 0, 1, NULL),
(49, NULL, NULL, '2016-09-20 15:38:34', '2016-10-12', '13:00:00', NULL, NULL, NULL, 1, '35264N', 'Nakuru', '234234E', 'Eldoret', 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_level_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `password`, `user_level_id`) VALUES
(1, 'toniecairow@gmail.com', 'Shoulder1$', 0),
(2, 'a@b.c', '12345', 0),
(3, 'a@d.com', '12345', 0),
(4, 'as@f.com', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_tokens`
--

CREATE TABLE `tbl_user_tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_access_id` int(11) NOT NULL,
  `token` varchar(24) NOT NULL,
  `given_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_tokens`
--

INSERT INTO `tbl_user_tokens` (`token_id`, `user_id`, `api_access_id`, `token`, `given_date`, `expire_date`) VALUES
(6, 1, 1, '3f77c6ae7b2c3bd3e0ece178', '2016-09-18 13:35:26', '2016-09-18 13:35:26'),
(7, 2, 1, '15d87df32abfc1f11563a250', '2016-09-20 16:59:10', '2016-09-20 16:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(11) NOT NULL,
  `plate` varchar(25) NOT NULL,
  `model_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `vehicle_use` int(11) NOT NULL DEFAULT '0',
  `vehicle_dispatched` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `plate`, `model_id`, `capacity`, `vehicle_use`, `vehicle_dispatched`) VALUES
(2, 'KAZ 123Y', 2, 5, 0, 1),
(3, 'KAZ 123Y', 1, 4, 0, 0),
(4, 'KBY 534T', 3, 4, 1, 1),
(5, 'KBZ 327X', 5, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_make`
--

CREATE TABLE `tbl_vehicle_make` (
  `id` int(11) NOT NULL,
  `make` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_vehicle_model` (
  `id` int(11) NOT NULL,
  `model` varchar(25) NOT NULL,
  `make_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_model`
--

INSERT INTO `tbl_vehicle_model` (`id`, `model`, `make_id`) VALUES
(1, 'Xtrail', 2),
(2, 'Noah', 1),
(3, 'Wish', 3),
(4, 'Prado', 1),
(5, 'Colt', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allocation`
--
ALTER TABLE `tbl_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_api_access`
--
ALTER TABLE `tbl_api_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company_admins`
--
ALTER TABLE `tbl_company_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_trip`
--
ALTER TABLE `tbl_group_trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_people`
--
ALTER TABLE `tbl_people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_people_type`
--
ALTER TABLE `tbl_people_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project_people`
--
ALTER TABLE `tbl_project_people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_tokens`
--
ALTER TABLE `tbl_user_tokens`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle_make`
--
ALTER TABLE `tbl_vehicle_make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle_model`
--
ALTER TABLE `tbl_vehicle_model`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allocation`
--
ALTER TABLE `tbl_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_api_access`
--
ALTER TABLE `tbl_api_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_company_admins`
--
ALTER TABLE `tbl_company_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_group_trip`
--
ALTER TABLE `tbl_group_trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tbl_people`
--
ALTER TABLE `tbl_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_people_type`
--
ALTER TABLE `tbl_people_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_project_people`
--
ALTER TABLE `tbl_project_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user_tokens`
--
ALTER TABLE `tbl_user_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_vehicle_make`
--
ALTER TABLE `tbl_vehicle_make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_vehicle_model`
--
ALTER TABLE `tbl_vehicle_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
