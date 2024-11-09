-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 08:28 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpims_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `aop_targets`
--

CREATE TABLE `aop_targets` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ma_code` varchar(250) NOT NULL,
  `business_unit` varchar(250) NOT NULL,
  `sub_business_unit` varchar(250) NOT NULL,
  `product_segment` varchar(250) NOT NULL,
  `product_type` varchar(250) NOT NULL,
  `target_quantity` int(11) NOT NULL,
  `target_gross_revenue` int(11) NOT NULL,
  `target_distribution` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `archived` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aop_targets`
--

INSERT INTO `aop_targets` (`id`, `transaction_id`, `ma_code`, `business_unit`, `sub_business_unit`, `product_segment`, `product_type`, `target_quantity`, `target_gross_revenue`, `target_distribution`, `created_by`, `date_created`, `updated_by`, `date_updated`, `archived`) VALUES
(1, 000001, 'NN1', 'TMD', 'TMD', 'Printed', 'math', 55, 500000, 500, 1, '2022-06-23 07:39:01', 1, '2022-06-23 15:40:45', '2022-06-23 15:40:45'),
(2, 000001, 'NN1', 'TMD', 'TMD', 'Printed', 'math', 55, 500000, 500, 1, '2022-06-23 07:40:42', 1, '2022-06-23 15:40:45', '2022-06-23 15:40:45'),
(3, 000001, 'NN1', 'TMD', 'TMD', 'Printed', 'math', 55, 500000, 500, 1, '2022-06-23 07:40:49', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 000001, 'aaas', 'asdas', 'asd', 'asd', 'sadasd', 50, 232, 33432, 1, '2022-06-23 07:44:18', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aop_targets`
--
ALTER TABLE `aop_targets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aop_targets`
--
ALTER TABLE `aop_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
