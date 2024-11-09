-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 08:39 PM
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
-- Table structure for table `customer_program`
--

CREATE TABLE `customer_program` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `contact_id` varchar(100) DEFAULT NULL,
  `business_unit` varchar(100) NOT NULL,
  `school_code` varchar(100) NOT NULL,
  `target_user` varchar(100) NOT NULL,
  `initiative` varchar(100) DEFAULT NULL,
  `occurrence` varchar(100) NOT NULL,
  `b2b_b2c` varchar(100) NOT NULL,
  `expense_sub_category` int(11) NOT NULL,
  `customer_stage` varchar(100) DEFAULT NULL,
  `month_of` varchar(100) DEFAULT NULL,
  `rbsi` decimal(65,30) DEFAULT NULL,
  `adb` decimal(65,30) DEFAULT NULL,
  `digital` decimal(65,30) DEFAULT NULL,
  `charge_to` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_program`
--

INSERT INTO `customer_program` (`id`, `transaction_id`, `contact_id`, `business_unit`, `school_code`, `target_user`, `initiative`, `occurrence`, `b2b_b2c`, `expense_sub_category`, `customer_stage`, `month_of`, `rbsi`, `adb`, `digital`, `charge_to`, `created_by`, `date_created`, `updated_by`, `date_updated`, `archived`) VALUES
(5, 000001, '', 'LMD', '1000019756', '1', 'Off Site Selling (All)', '1', 'Adoption', 11, 'AWARENESS/DISCOVERY', 'december', '100.000000000000000000000000000000', '100.000000000000000000000000000000', '100.000000000000000000000000000000', NULL, 1, '2022-07-27 17:59:23', 1, '2022-07-28 18:58:06', NULL),
(6, 000001, '', 'LMD', '1000019756', '1', 'Online Freshmen Orientation (LL)', '1', 'Adoption', 12, 'AWARENESS/DISCOVERY', 'january', '300.000000000000000000000000000000', '300.000000000000000000000000000000', '300.000000000000000000000000000000', NULL, 1, '2022-07-28 10:50:48', NULL, NULL, NULL),
(7, 000001, '', 'LMD', '1000019756', '1', 'Online Freshmen Orientation (LL)', '1', 'Adoption', 11, 'AWARENESS/DISCOVERY', 'january', '100.000000000000000000000000000000', '100.000000000000000000000000000000', '100.000000000000000000000000000000', NULL, 1, '2022-07-28 10:54:56', NULL, NULL, NULL),
(8, 000001, '', 'LMD', '1000019756', '1', 'Initiative 1', '1', 'Library', 11, 'AWARENESS/DISCOVERY', 'january', '100.000000000000000000000000000000', '100.000000000000000000000000000000', '100.000000000000000000000000000000', NULL, 1, '2022-07-28 17:22:57', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_program`
--
ALTER TABLE `customer_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_code` (`school_code`),
  ADD KEY `month_of` (`month_of`),
  ADD KEY `school_code_2` (`school_code`),
  ADD KEY `month_of_2` (`month_of`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_program`
--
ALTER TABLE `customer_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
