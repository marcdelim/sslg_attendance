-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 06:59 AM
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
-- Table structure for table `historical_return_rates`
--

CREATE TABLE `historical_return_rates` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `sub_business_unit` varchar(100) NOT NULL,
  `deped_code` varchar(100) NOT NULL,
  `ramco_code` varchar(100) NOT NULL,
  `macola_code_k10` varchar(100) NOT NULL,
  `macola_code_shs` varchar(100) NOT NULL,
  `macola_code_tmd` varchar(100) NOT NULL,
  `macola_code_lmd` varchar(100) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `ma_code` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `returns_rate` double NOT NULL,
  `year` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historical_return_rates`
--
ALTER TABLE `historical_return_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historical_return_rates`
--
ALTER TABLE `historical_return_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
