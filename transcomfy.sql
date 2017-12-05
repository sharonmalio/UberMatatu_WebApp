-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 09:37 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transcomfy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocation`
--

CREATE TABLE `tbl_allocation` (
  `allocation_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `collect_time` datetime DEFAULT NULL,
  `return_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'site_key', 'this verifys requests from the site', '1111'),
(2, 'app_key', 'this verifys requests from the site Mobile App', '2222');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buses`
--

CREATE TABLE `tbl_buses` (
  `id` int(11) NOT NULL,
  `plate` varchar(25) NOT NULL,
  `capacity` int(11) NOT NULL,
  `sacco_id` int(11) NOT NULL,
  `route_number` varchar(50) NOT NULL,
  `assigned_driver` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buses`
--

INSERT INTO `tbl_buses` (`id`, `plate`, `capacity`, `sacco_id`, `route_number`, `assigned_driver`) VALUES
(7, 'KCD456B', 55, 10, '23', 7),
(8, 'KBX 455H', 50, 10, '33', NULL),
(9, 'KAZ 123A', 20, 10, '44', NULL),
(10, 'KAA 553B', 50, 10, '33', NULL),
(11, 'KCC 123R', 23, 10, '23', NULL),
(12, 'KBZ 155J', 62, 10, '58', NULL),
(13, 'KCD 665B', 50, 10, '58', NULL),
(14, 'KBY 223S', 23, 10, '58', NULL),
(16, 'KCS 453S', 23, 12, '42', NULL),
(18, 'KBA 891M', 50, 12, '58', NULL),
(19, 'KLS 223Q', 30, 10, '30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus_locations`
--

CREATE TABLE `tbl_bus_locations` (
  `bus_locations_id` int(11) NOT NULL,
  `checkin_time` datetime NOT NULL,
  `chechin_coordinates` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus_routes`
--

CREATE TABLE `tbl_bus_routes` (
  `bus_routes_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bus_routes`
--

INSERT INTO `tbl_bus_routes` (`bus_routes_id`, `bus_id`, `route_id`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 4, 1),
(4, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus_stops`
--

CREATE TABLE `tbl_bus_stops` (
  `bus_stop_id` int(11) NOT NULL,
  `bus_stop_name` varchar(50) NOT NULL,
  `bus_stop_lat` varchar(100) NOT NULL,
  `bus_stop_long` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bus_stops`
--

INSERT INTO `tbl_bus_stops` (`bus_stop_id`, `bus_stop_name`, `bus_stop_lat`, `bus_stop_long`) VALUES
(1, 'Chiromo', '-1.2735893', '36.8047411'),
(2, 'Westlands Delta', '-1.2676158', '36.8017138'),
(3, 'Westlands Stage', '-1.2641727', '36.7999596'),
(4, 'Odeon CBD', '-1.2833108', '36.8250464'),
(5, 'Kikuyu Town', '-1.2409059', '36.6540349'),
(6, 'Othaya Road, Lavington', '-1.2852005', '36.7732444');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bus_trips`
--

CREATE TABLE `tbl_bus_trips` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trip_date` date NOT NULL,
  `trip_time` time NOT NULL,
  `allocation_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `stop_time` datetime DEFAULT NULL,
  `start_stage` int(11) DEFAULT NULL,
  `end_stage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_conductors`
--

CREATE TABLE `tbl_conductors` (
  `conductor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conductor_license` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers`
--

CREATE TABLE `tbl_drivers` (
  `driver_id` int(11) NOT NULL,
  `sacco_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `drivers_license` varchar(20) NOT NULL,
  `has_assigned_bus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_drivers`
--

INSERT INTO `tbl_drivers` (`driver_id`, `sacco_id`, `first_name`, `last_name`, `phone_number`, `drivers_license`, `has_assigned_bus`) VALUES
(7, 10, 'Joe', 'Mfalme', '653745354', 'TDB22312343', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `trip_commuter_ids` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `payment_time` datetime NOT NULL,
  `transaction_id` varchar(30) NOT NULL
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
(5, 'ZAZA', 'LAem', 743678154, 3, 3, 0),
(6, 'Mark', '', 721234567, 3, 5, 0),
(7, '', '', 0, 1, 6, 0),
(8, '', '', 0, 1, 7, 0),
(9, 'bsnsn', 'bsbsb', 879794, 1, 9, 0),
(10, 'bsnsn', 'bsbsb', 879794, 1, 10, 0),
(11, 'bsnsn', 'bsbsb', 879794, 1, 11, 0),
(12, 'bsnsn', 'bsbsb', 879794, 1, 12, 0),
(13, 'bsnsn', 'bsbsb', 879794, 1, 13, 0),
(14, 'bsnsn', 'bsbsb', 879794, 1, 14, 0),
(15, 'bsnsn', 'bsbsb', 879794, 1, 15, 0),
(16, 'bsnsn', 'bsbsb', 879794, 1, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_routes`
--

CREATE TABLE `tbl_routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(30) NOT NULL,
  `stage_from` int(11) NOT NULL,
  `stage_to` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_routes`
--

INSERT INTO `tbl_routes` (`route_id`, `route_name`, `stage_from`, `stage_to`, `description`) VALUES
(1, 'Kikuyu 105', 4, 5, ''),
(2, 'Kileleshwa 48A', 4, 6, '48 A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route_stops`
--

CREATE TABLE `tbl_route_stops` (
  `route_stop_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_route_stops`
--

INSERT INTO `tbl_route_stops` (`route_stop_id`, `route_id`, `stop_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(7, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saccos`
--

CREATE TABLE `tbl_saccos` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_saccos`
--

INSERT INTO `tbl_saccos` (`id`, `name`, `description`) VALUES
(5, 'ROG', ''),
(6, 'Kileton', ''),
(7, 'Compliant', ''),
(8, 'Ngokana', ''),
(9, 'MOA', '4'),
(10, 'Mwamba Sacco', 'This is a sacco located in Nairobi'),
(11, 'Umoinner Sacco', 'This is a sacco located in Umoja,Nairobi.'),
(12, 'Indimanje Sacco', 'This is a sacco that operates along the Nairobi industrial Area route.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saccos_admins`
--

CREATE TABLE `tbl_saccos_admins` (
  `id` int(11) NOT NULL,
  `sacco_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_saccos_admins`
--

INSERT INTO `tbl_saccos_admins` (`id`, `sacco_id`, `first_name`, `last_name`, `phone_number`, `email_address`, `password`) VALUES
(3, 10, 'Ken', 'Mokaya', '+254722123456', 'km@g.com', '$2y$10$8qEtfE6E1YRBy3tXSwro4eiKHOHRmNRdsksODA1kftTP.cRs0TIQa'),
(4, 11, 'Janet', 'Macharia', '+254711098765', 'jmach@gmail.com', '$2y$10$ELSpQ87oWpgopJB3lEtxoeFpXseR2klTxrai/.8voHeTHdSNiwOui'),
(5, 12, 'Lawrence', 'Maina', '+254765432188', 'lawrence@gmail.com', '$2y$10$VjG6IbZv/9uodqlDJq2OjuCjI8FxaCyBTxM4jwGKNpuz6jHBo0GF6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_commuters`
--

CREATE TABLE `tbl_trip_commuters` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fare` int(11) NOT NULL,
  `start_coordinate` varchar(100) DEFAULT NULL,
  `stop_coordinate` varchar(100) DEFAULT NULL,
  `board_time` datetime DEFAULT NULL,
  `alight_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trip_commuters`
--

INSERT INTO `tbl_trip_commuters` (`id`, `trip_id`, `user_id`, `fare`, `start_coordinate`, `stop_coordinate`, `board_time`, `alight_time`) VALUES
(2, 1, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 2, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 2, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 2, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 19, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 19, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 20, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 20, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 24, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 29, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 29, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 3, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 3, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 37, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 37, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 38, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 38, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 39, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 39, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 40, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 40, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 40, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 41, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 41, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 41, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 46, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 46, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 46, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 47, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 47, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 47, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 48, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 48, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 48, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 37, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 37, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 37, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 51, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 52, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 53, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 54, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 54, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 55, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 55, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 56, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 56, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 57, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 57, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 58, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 58, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 59, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 59, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 60, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 60, 0, 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(4, 'as@f.com', '1234', 0),
(5, 'markwahome@live.com', '11032', 0),
(6, 't@trans.com', '12345678', 0),
(7, 't1@trans.com', '12345678', 0),
(8, '1', '1', 0),
(9, 't21@trans.com', '12345678', 0),
(10, 't4@trans.com', '12345678', 0),
(11, 't3@trans.com', '12345678', 0),
(12, 't5@trans.com', '12345678', 0),
(13, 't6@trans.com', '12345678', 0),
(14, 't7@trans.com', '12345678', 0),
(15, 't8@trans.com', '12345678', 0),
(16, 't9@trans.com', '12345678', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_tokens`
--

CREATE TABLE `tbl_user_tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_access_id` int(11) NOT NULL,
  `token` varchar(24) NOT NULL,
  `given_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_tokens`
--

INSERT INTO `tbl_user_tokens` (`token_id`, `user_id`, `api_access_id`, `token`, `given_date`, `expire_date`) VALUES
(6, 1, 1, '3f77c6ae7b2c3bd3e0ece178', '2016-09-18 10:35:26', '2016-09-18 10:35:26'),
(7, 2, 1, '15d87df32abfc1f11563a250', '2016-09-20 13:59:10', '2016-09-20 13:59:10'),
(10, 5, 1, 'e5064cf921cea2fa37601166', '2016-09-30 12:32:22', NULL),
(12, 4, 1, '08747c9e50331011d81a5a1e', '2016-10-29 14:49:06', NULL),
(16, 16, 1, 'c42eef6cd39b688dbca4a6c4', '2017-11-23 11:35:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `user_type_id` int(11) NOT NULL,
  `type_name` varchar(15) NOT NULL,
  `type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allocation`
--
ALTER TABLE `tbl_allocation`
  ADD PRIMARY KEY (`allocation_id`);

--
-- Indexes for table `tbl_api_access`
--
ALTER TABLE `tbl_api_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_buses`
--
ALTER TABLE `tbl_buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bus_locations`
--
ALTER TABLE `tbl_bus_locations`
  ADD PRIMARY KEY (`bus_locations_id`);

--
-- Indexes for table `tbl_bus_routes`
--
ALTER TABLE `tbl_bus_routes`
  ADD PRIMARY KEY (`bus_routes_id`);

--
-- Indexes for table `tbl_bus_stops`
--
ALTER TABLE `tbl_bus_stops`
  ADD PRIMARY KEY (`bus_stop_id`);

--
-- Indexes for table `tbl_bus_trips`
--
ALTER TABLE `tbl_bus_trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_conductors`
--
ALTER TABLE `tbl_conductors`
  ADD PRIMARY KEY (`conductor_id`);

--
-- Indexes for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `tbl_people`
--
ALTER TABLE `tbl_people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_routes`
--
ALTER TABLE `tbl_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `tbl_route_stops`
--
ALTER TABLE `tbl_route_stops`
  ADD PRIMARY KEY (`route_stop_id`);

--
-- Indexes for table `tbl_saccos`
--
ALTER TABLE `tbl_saccos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_saccos_admins`
--
ALTER TABLE `tbl_saccos_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_trip_commuters`
--
ALTER TABLE `tbl_trip_commuters`
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
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allocation`
--
ALTER TABLE `tbl_allocation`
  MODIFY `allocation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_api_access`
--
ALTER TABLE `tbl_api_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_buses`
--
ALTER TABLE `tbl_buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_bus_locations`
--
ALTER TABLE `tbl_bus_locations`
  MODIFY `bus_locations_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_bus_routes`
--
ALTER TABLE `tbl_bus_routes`
  MODIFY `bus_routes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_bus_stops`
--
ALTER TABLE `tbl_bus_stops`
  MODIFY `bus_stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_bus_trips`
--
ALTER TABLE `tbl_bus_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_conductors`
--
ALTER TABLE `tbl_conductors`
  MODIFY `conductor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_people`
--
ALTER TABLE `tbl_people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_routes`
--
ALTER TABLE `tbl_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_route_stops`
--
ALTER TABLE `tbl_route_stops`
  MODIFY `route_stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_saccos`
--
ALTER TABLE `tbl_saccos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_saccos_admins`
--
ALTER TABLE `tbl_saccos_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_trip_commuters`
--
ALTER TABLE `tbl_trip_commuters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_user_tokens`
--
ALTER TABLE `tbl_user_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
