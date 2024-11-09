-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 05:45 PM
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
-- Database: `bpims_k12`
--

-- --------------------------------------------------------

--
-- Table structure for table `sobi_direct_invoice`
--

CREATE TABLE `sobi_direct_invoice` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `po_no` int(11) NOT NULL,
  `supplier_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `supplier_invoice_no` varchar(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `ref_doc_no` varchar(100) NOT NULL,
  `invoice_qty` int(11) NOT NULL,
  `invoice_rate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `cost_center` int(11) NOT NULL,
  `cost_center_description` varchar(100) NOT NULL,
  `po_pay_mode` varchar(100) NOT NULL,
  `account_code` int(11) NOT NULL,
  `account_description` varchar(100) NOT NULL,
  `customer_dimension` varchar(100) NOT NULL,
  `event_dimension` varchar(100) NOT NULL,
  `program_id_dimension` varchar(100) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `ou` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sobi_direct_invoice`
--
ALTER TABLE `sobi_direct_invoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sobi_direct_invoice`
--
ALTER TABLE `sobi_direct_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
