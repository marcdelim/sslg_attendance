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
-- Table structure for table `hed_grms`
--

CREATE TABLE `hed_grms` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `business_unit` varchar(250) NOT NULL,
  `sub_business_unit` varchar(250) NOT NULL,
  `january` double NOT NULL,
  `february` double NOT NULL,
  `march` double NOT NULL,
  `april` double NOT NULL,
  `may` double NOT NULL,
  `june` double NOT NULL,
  `july` double NOT NULL,
  `august` double NOT NULL,
  `september` double NOT NULL,
  `october` double NOT NULL,
  `november` double NOT NULL,
  `december` double NOT NULL,
  `library_january` double NOT NULL,
  `library_february` double NOT NULL,
  `library_march` double NOT NULL,
  `library_april` double NOT NULL,
  `library_may` double NOT NULL,
  `library_june` double NOT NULL,
  `library_july` double NOT NULL,
  `library_august` double NOT NULL,
  `library_september` double NOT NULL,
  `library_october` double NOT NULL,
  `library_november` double NOT NULL,
  `library_december` double NOT NULL,
  `created_by` double NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` datetime NOT NULL,
  `archived` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hed_grms`
--

INSERT INTO `hed_grms` (`id`, `transaction_id`, `business_unit`, `sub_business_unit`, `january`, `february`, `march`, `april`, `may`, `june`, `july`, `august`, `september`, `october`, `november`, `december`, `library_january`, `library_february`, `library_march`, `library_april`, `library_may`, `library_june`, `library_july`, `library_august`, `library_september`, `library_october`, `library_november`, `library_december`, `created_by`, `date_created`, `updated_by`, `date_updated`, `archived`) VALUES
(1, 000001, 'asd', 'asd', 12, 12, 123, 121, 11, 11, 11, 123, 123, 11, 112, 123, 13, 112, 11, 1232, 123, 143, 1123, 11, 123, 1143, 135, 153, 1, '2022-06-23 13:30:19', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 000001, 'bed', 'k10', 213, 12, 213, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 123, 1, '2022-06-23 14:16:35', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hed_grms`
--
ALTER TABLE `hed_grms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hed_grms`
--
ALTER TABLE `hed_grms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
