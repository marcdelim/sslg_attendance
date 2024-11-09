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
-- Table structure for table `price_list`
--

CREATE TABLE `price_list` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `item_type` varchar(250) NOT NULL,
  `item_code` varchar(250) NOT NULL,
  `item_variant` varchar(250) DEFAULT NULL,
  `uom` varchar(250) DEFAULT NULL,
  `item_variant_desc` varchar(250) NOT NULL,
  `price_attrib_grp` varchar(250) DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `threshold_qty` int(11) DEFAULT NULL,
  `standard_cost` decimal(65,30) NOT NULL,
  `rate` decimal(65,30) NOT NULL,
  `computed_rate` decimal(65,30) NOT NULL,
  `mark_up_pct` decimal(65,30) DEFAULT NULL,
  `mark_up_amt` decimal(65,30) DEFAULT NULL,
  `mark_down_amt` decimal(65,30) DEFAULT NULL,
  `mark_down_pct` decimal(65,30) DEFAULT NULL,
  `priority` varchar(250) DEFAULT NULL,
  `active` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `archived` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `price_list`
--

INSERT INTO `price_list` (`id`, `transaction_id`, `item_type`, `item_code`, `item_variant`, `uom`, `item_variant_desc`, `price_attrib_grp`, `min_qty`, `max_qty`, `threshold_qty`, `standard_cost`, `rate`, `computed_rate`, `mark_up_pct`, `mark_up_amt`, `mark_down_amt`, `mark_down_pct`, `priority`, `active`, `created_by`, `date_created`, `updated_by`, `date_updated`, `archived`) VALUES
(1, 000001, 'asd', 'asdas', 'asd', 'meter', 'asd', 'asd', 123, 123, 1123, '342.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', 'me', 'active', 1, '2022-06-21 10:22:02', 1, '2022-06-21 18:33:04', '2022-06-21 18:33:04'),
(2, 000001, 'asd', 'asdas', 'asd', 'meter', 'asd', 'asd', 123, 123, 1123, '342.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', '123.000000000000000000000000000000', 'me', 'active', 1, '2022-06-21 10:42:32', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 000001, 'asdas', 'dsa', 'asd', 'asd', 'asdas', 'asd', 1, 1, 1, '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', '1.000000000000000000000000000000', 'you', 'active', 1, '2022-06-23 00:34:27', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
