-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 03:53 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpims_10`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `contact_id` varchar(101) NOT NULL,
  `school_code` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `school_code` varchar(225) DEFAULT NULL,
  `macola_id_k10` varchar(100) DEFAULT NULL,
  `macola_id_shs` varchar(100) DEFAULT NULL,
  `macola_id_tmd` varchar(100) DEFAULT NULL,
  `macola_id_lmd` varchar(100) DEFAULT NULL,
  `deped_id` varchar(100) DEFAULT NULL,
  `bu_code` varchar(100) NOT NULL,
  `school_name` varchar(150) NOT NULL,
  `ma_code` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `number_and_street` varchar(225) DEFAULT NULL,
  `zipcode` varchar(225) DEFAULT NULL,
  `province` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `barangay` varchar(225) DEFAULT NULL,
  `tin` varchar(225) DEFAULT NULL,
  `market_segmentation` varchar(100) DEFAULT NULL,
  `customer_objective` varchar(200) DEFAULT NULL,
  `customer_stage` varchar(500) DEFAULT NULL,
  `province_code` int(11) DEFAULT NULL,
  `city_code` int(11) DEFAULT NULL,
  `brgy_code` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_population`
--

CREATE TABLE `customer_population` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `school_code` varchar(250) NOT NULL,
  `grade_level` varchar(100) DEFAULT NULL,
  `strand` varchar(250) DEFAULT NULL,
  `population` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_code` (`school_code`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `macola_id` (`macola_id_k10`),
  ADD KEY `deped_id` (`deped_id`),
  ADD KEY `school_code` (`school_code`) USING BTREE,
  ADD KEY `macola_id_shs` (`macola_id_shs`),
  ADD KEY `macola_id_tmd` (`macola_id_tmd`),
  ADD KEY `macola_id_lmd` (`macola_id_lmd`);

--
-- Indexes for table `customer_population`
--
ALTER TABLE `customer_population`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_population`
--
ALTER TABLE `customer_population`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
