-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 07:05 PM
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
-- Database: `bpimsv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `sps_care`
--

CREATE TABLE `sps_care` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `macola_code_k10` varchar(100) DEFAULT NULL,
  `macola_code_shs` varchar(100) DEFAULT NULL,
  `macola_code_tmd` varchar(100) DEFAULT NULL,
  `macola_code_lmd` varchar(100) DEFAULT NULL,
  `ramco_code` varchar(100) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `slspn_no` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `sub_business_unit` varchar(100) DEFAULT NULL,
  `business_unit` varchar(100) DEFAULT NULL,
  `initiative` varchar(100) DEFAULT NULL,
  `sub_category` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sps_care`
--

INSERT INTO `sps_care` (`id`, `transaction_id`, `lead_id`, `macola_code_k10`, `macola_code_shs`, `macola_code_tmd`, `macola_code_lmd`, `ramco_code`, `school_name`, `slspn_no`, `region`, `sub_business_unit`, `business_unit`, `initiative`, `sub_category`, `created_by`, `date_created`, `updated_by`, `date_updated`, `archived`) VALUES
(1, 1, NULL, NULL, NULL, NULL, 'NCR-QUE-1-00420', NULL, 'School 1', NULL, NULL, 'LMD', 'LMD', 'Initiative 1', NULL, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL),
(3, 1, NULL, NULL, NULL, NULL, 'NCR-QUE-1-00420', NULL, 'School 1', NULL, NULL, 'LMD', 'LMD', 'Initiative 2', NULL, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sps_care`
--
ALTER TABLE `sps_care`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sps_care`
--
ALTER TABLE `sps_care`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
