-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2016 at 03:12 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.10-1+deb.sury.org~xenial+1

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
(5, 'UNDP', 'UN branch');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_admins`
--

CREATE TABLE `tbl_company_admins` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_people`
--

INSERT INTO `tbl_people` (`id`, `fName`, `lName`, `phone_no`, `type`, `user_id`) VALUES
(1, 'Kamau', 'Lexxy', 743678154, 2, 1),
(3, 'Ashley', 'Fernandez', 748731532, 1, 3),
(4, 'Willy', 'Pozzee', 723618522, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people_type`
--

CREATE TABLE `tbl_people_type` (
  `id` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'Motor Hallo', 'Motorola', 4),
(4, 'Metro Hallo', 'Motorola', 4),
(5, 'Motic Hallo', 'Motorola', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_people`
--

CREATE TABLE `tbl_project_people` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trips`
--

CREATE TABLE `tbl_trips` (
  `id` int(11) NOT NULL,
  `start_milage` int(11) NOT NULL,
  `end_milage` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `vehicle_driver` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `stop_time` datetime NOT NULL,
  `trip_creator` int(11) NOT NULL,
  `sart_coordinate` varchar(200) NOT NULL,
  `end_coordinates` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'a@b.c', '12345', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_tokens`
--

CREATE TABLE `tbl_user_tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_access_id` int(11) NOT NULL,
  `token` varchar(24) NOT NULL,
  `given_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_tokens`
--

INSERT INTO `tbl_user_tokens` (`token_id`, `user_id`, `api_access_id`, `token`, `given_date`, `expire_date`) VALUES
(2, 1, 1, '4bda64d7273f0ae8f11e8db8', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(11) NOT NULL,
  `plate` varchar(25) NOT NULL,
  `model_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `plate`, `model_id`, `capacity`) VALUES
(2, 'KAZ 123Y', 2, 5),
(3, 'KCC 123T', 2, 4),
(4, 'KBY 534T', 3, 4);

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
(2, 'Nissan');

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
(1, 'Fuga', 2),
(2, 'Noah', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tbl_api_access`
--
ALTER TABLE `tbl_api_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_companies`
--
ALTER TABLE `tbl_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_company_admins`
--
ALTER TABLE `tbl_company_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_people`
--
ALTER TABLE `tbl_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_people_type`
--
ALTER TABLE `tbl_people_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_project_people`
--
ALTER TABLE `tbl_project_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user_tokens`
--
ALTER TABLE `tbl_user_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_vehicle_make`
--
ALTER TABLE `tbl_vehicle_make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_vehicle_model`
--
ALTER TABLE `tbl_vehicle_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
