-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 06:24 PM
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
-- Database: `bpims_k12_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_mapping`
--

CREATE TABLE `ac_mapping` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `product_segment` varchar(100) NOT NULL,
  `gross_deliveries_account_code` int(11) NOT NULL,
  `gross_deliveries_account_description` varchar(100) NOT NULL,
  `sales_return_account_code` int(11) NOT NULL,
  `sales_return_account_description` varchar(100) NOT NULL,
  `sales_discount_account_code` int(11) NOT NULL,
  `sales_discount_account_description` varchar(100) NOT NULL,
  `cost_of_sales_account_code` int(11) NOT NULL,
  `cost_of_sales_account_description` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `cur_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `new_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bpim_transactions`
--

CREATE TABLE `bpim_transactions` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `description` varchar(225) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `previous_year` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `next_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bpim_transaction_status`
--

CREATE TABLE `bpim_transaction_status` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `status` varchar(50) NOT NULL,
  `locked` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bp_initiative`
--

CREATE TABLE `bp_initiative` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `bp_initiative` varchar(100) NOT NULL,
  `account_code` int(11) NOT NULL,
  `account_description` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `sub_bu` varchar(100) NOT NULL,
  `product_objective` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `charged_to`
--

CREATE TABLE `charged_to` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `charged_to_code` varchar(100) NOT NULL,
  `charged_to_description` varchar(100) NOT NULL,
  `activation` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `account_code` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `account_group` varchar(100) NOT NULL,
  `account_classification` varchar(100) NOT NULL,
  `control_account_type` varchar(100) DEFAULT NULL,
  `automatic_posting_account_type` varchar(100) DEFAULT NULL,
  `effective_period_from` date NOT NULL,
  `effective_period_to` date NOT NULL,
  `consolidation_account_code` varchar(100) DEFAULT NULL,
  `layout_heading` varchar(100) DEFAULT NULL,
  `revised_layout_heading` varchar(100) DEFAULT NULL,
  `schedule_heading` varchar(100) DEFAULT NULL,
  `revised_schedule_heading` varchar(100) DEFAULT NULL,
  `layout_heading_for_negative_balances` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `cost_center`
--

CREATE TABLE `cost_center` (
  `id` int(11) NOT NULL,
  `cost_center_id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `level` int(11) NOT NULL,
  `cc_unit` int(11) NOT NULL,
  `description_1` varchar(100) NOT NULL,
  `parent_cc_unit` int(11) NOT NULL,
  `description_2` varchar(100) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `effective_period_from` date NOT NULL,
  `effective_period_to` date NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `b2b_b2c` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `credit_management`
--

CREATE TABLE `credit_management` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `macola_id_k10` varchar(100) NOT NULL,
  `macola_id_shs` varchar(100) NOT NULL,
  `macola_id_tmd` varchar(100) NOT NULL,
  `macola_id_lmd` varchar(100) NOT NULL,
  `ramco_code` varchar(100) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `ar_status` varchar(100) NOT NULL,
  `balance_amount` int(11) NOT NULL,
  `transaction_year` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ctsr_bcr`
--

CREATE TABLE `ctsr_bcr` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `tier_description` varchar(100) NOT NULL,
  `cost_center` int(11) NOT NULL,
  `cc_description` varchar(100) NOT NULL,
  `material_advisor` varchar(100) NOT NULL,
  `gross_revenue` int(11) NOT NULL,
  `ctsr` float NOT NULL,
  `as_of_month` varchar(100) NOT NULL,
  `percentage` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `customer_stage`
--

CREATE TABLE `customer_stage` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `customer_stage_code` varchar(100) NOT NULL,
  `customer_stage_description` varchar(100) NOT NULL,
  `activation` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discount_master`
--

CREATE TABLE `discount_master` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `lead_id` int(11) NOT NULL,
  `macola_code_k10` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_code_shs` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_code_tmd` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_code_lmd` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `ramco_code` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `slspn_no` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `sub_bu` varchar(100) NOT NULL,
  `business_unit` varchar(100) CHARACTER SET latin1 NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `discount_rate` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estimated_return_rates`
--

CREATE TABLE `estimated_return_rates` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `sub_business_unit` varchar(100) NOT NULL,
  `deped_code` varchar(100) NOT NULL,
  `ramco_code` varchar(100) NOT NULL,
  `macola_code_k10` varchar(100) DEFAULT NULL,
  `macola_code_shs` varchar(100) DEFAULT NULL,
  `macola_code_tmd` varchar(100) DEFAULT NULL,
  `macola_code_lmd` varchar(100) DEFAULT NULL,
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
  `macola_code_k10` varchar(100) DEFAULT NULL,
  `macola_code_shs` varchar(100) DEFAULT NULL,
  `macola_code_tmd` varchar(100) DEFAULT NULL,
  `macola_code_lmd` varchar(100) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `item_master_maintenance`
--

CREATE TABLE `item_master_maintenance` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `short_description` int(11) NOT NULL,
  `market_segment` varchar(100) NOT NULL,
  `product_segment` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `grade_level` varchar(100) NOT NULL,
  `track_program` varchar(100) NOT NULL,
  `learning_area` varchar(100) NOT NULL,
  `strand_discipline` varchar(100) NOT NULL,
  `subject_course` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `copyright` varchar(100) NOT NULL,
  `author1` varchar(100) DEFAULT NULL,
  `author2` varchar(100) DEFAULT NULL,
  `author3` varchar(100) DEFAULT NULL,
  `prod_class_disposition` varchar(100) NOT NULL,
  `product_format` varchar(100) NOT NULL,
  `pfp_scc_itemcode` varchar(100) NOT NULL,
  `pfp_scc_item_description` varchar(100) NOT NULL,
  `pfp_scc_prod_category` varchar(100) NOT NULL,
  `pfp_scc_prod_category2` varchar(100) NOT NULL,
  `pfp_tc_item_code` varchar(100) NOT NULL,
  `pfp_tc_item_description` varchar(100) NOT NULL,
  `pfp_tc_prod_category` varchar(100) NOT NULL,
  `pfp_tc_prod_category2` varchar(100) NOT NULL,
  `pfp_ec_item_code` varchar(100) NOT NULL,
  `pfp_ec_item_description` varchar(100) NOT NULL,
  `pfp_ec_prod_category` varchar(100) NOT NULL,
  `pfp_ec_prod_category2` varchar(100) NOT NULL,
  `pfnp_scc_item_code` varchar(100) NOT NULL,
  `pfnp_scc_item_description` varchar(100) NOT NULL,
  `pfnp_scc_prod_category` varchar(100) NOT NULL,
  `pfnp_scc_prod_category2` varchar(100) NOT NULL,
  `pfnp_tc_item_code` varchar(100) NOT NULL,
  `pfnp_tc_item_description` varchar(100) NOT NULL,
  `pfnp_tc_prod_category` varchar(100) NOT NULL,
  `pfnp_tc_prod_category2` varchar(100) NOT NULL,
  `pfnp_ec_item_code` varchar(100) NOT NULL,
  `pfnp_ec_item_description` varchar(100) NOT NULL,
  `pfnp_ec_prod_category` varchar(100) NOT NULL,
  `pfnp_ec_prod_category2` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_type`
--

CREATE TABLE `maintenance_type` (
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(225) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_type`
--

INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES
('bp_initiative_category', 'BP Initiative Category', 'BP Initiative Category', 1, '2022-07-02 15:30:53', NULL),
('bp_initiative_sub_category', 'BP Initiative Sub-Category', 'BP Initiative Sub-Category', 1, '2022-07-02 15:30:53', NULL),
('charged_to_activation', 'Charged to Activation', 'Charged to Activation', 1, '2022-07-02 15:31:14', NULL),
('charged_to_code', 'Charged to Code', 'Charged to Code', 1, '2022-07-02 15:31:14', NULL),
('charged_to_description', 'Charged to Description', 'Charged to Description', 1, '2022-07-02 15:31:14', NULL),
('cost_center_activation', 'Cost Center Activation', 'Cost Center Activation', 1, '2022-06-20 23:01:45', NULL),
('cost_center_b2b_b2c', 'Cost Center B2B/B2C', 'Cost Center B2B/B2C', 1, '2022-06-20 23:01:45', NULL),
('cost_center_sub_category', 'Cost Center Sub Category', 'Cost Center Sub Category', 1, '2022-06-20 23:01:45', NULL),
('credit_management_status', 'credit_management_status', 'Credit Management Status', 1, '2022-06-30 10:07:52', NULL),
('credit_management_sub_bu', 'credit_management_sub_bu', 'Credit Management Sub BU', 1, '2022-06-30 10:07:12', NULL),
('customer_stage_activation', 'Customer Stage Activation', 'Customer Stage Activation', 1, '2022-07-02 15:35:09', NULL),
('customer_stage_code', 'Customer Stage Code', 'Customer Stage Code', 1, '2022-07-02 15:35:09', NULL),
('customer_stage_description', 'Customer Stage Description', 'Customer Stage Description', 1, '2022-07-02 15:35:09', NULL),
('discount_master_product_type', 'discount_master_product_type', 'Discount Master Product Type', 1, '2022-06-29 22:36:05', NULL),
('discount_master_sub_bu', 'discount_master_sub_bu', 'Discount Master Sub BU', 0, '2022-06-27 23:51:25', NULL),
('item_master_product_classification', 'item_master_product_classification', 'Item Master Product Classification', 1, '2022-06-29 23:14:38', NULL),
('occurrence', 'Occurrence', 'Occurrence', 1, '2022-06-29 07:13:40', NULL),
('occurrence_activation', 'Occurrence Activation', 'Occurrence Activation', 1, '2022-06-29 07:13:40', NULL),
('return_rates_product_type', 'Return Rates Product Type', 'Return Rates Product Type', 1, '2022-07-02 15:37:15', NULL),
('return_rates_sub_bu', 'return_rates_sub_bu', 'Return Rates Sub Business Unit', 1, '2022-07-02 15:37:15', NULL),
('sales_report_product_format', 'sales_report_product_format', 'Sales Report Product Format', 1, '2022-06-30 06:03:09', NULL),
('sales_report_semester', 'sales_report_semester', 'Sales Report Semester', 1, '2022-06-30 09:27:59', NULL),
('sales_report_sub_bu', 'sales_report_sub_bu', 'Sales Report Sub BU', 1, '2022-06-30 03:59:24', NULL),
('target_end_user', 'Target End User', 'Target End User', 1, '2022-07-02 15:42:25', NULL),
('target_end_user_activation', 'Target End User Activation', 'Target End User Activation', 1, '2022-07-02 15:42:25', NULL),
('threshold_computation_bu', 'Threshold Computation Business Unit', 'Threshold Computation Business Unit', 1, '2022-07-02 15:42:44', NULL),
('threshold_computation_color_code', 'Threshold Computation Color Code', 'Threshold Computation Color Code', 1, '2022-07-02 15:42:44', NULL),
('threshold_computation_data_filter', 'Threshold Computation Data Filter', 'Threshold Computation Data Filter', 1, '2022-07-02 15:42:44', NULL),
('threshold_computation_reference_point', 'Threshold Computation Reference Point', 'Threshold Computation Reference Point', 1, '2022-07-02 15:42:44', NULL),
('threshold_computation_sub_bu', 'Threshold Computation Sub-Business Unit', 'Threshold Computation Sub-Business Unit', 1, '2022-07-02 15:42:44', NULL),
('transaction_status', 'transaction_status', 'Transaction Status', 1, '2022-06-20 05:26:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_value`
--

CREATE TABLE `maintenance_value` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `maintenance_type_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(225) DEFAULT NULL,
  `parent_code` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_value`
--

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES
(1, 'EXPENSE', 'BP_INITIATIVE_CATEGORY', 'EXPENSE', 'EXPENSE', NULL, 0, '2022-06-28 22:55:54', NULL),
(2, 'MARKETING', 'BP_INITIATIVE_SUB_CATEGORY', 'MARKETING', 'MARKETING', NULL, 0, '2022-06-28 23:00:31', NULL),
(3, 'SELLING', 'BP_INITIATIVE_SUB_CATEGORY', 'SELLING', 'SELLING', NULL, 0, '2022-06-28 23:02:20', NULL),
(4, 'charged_to_code_nsm', 'charged_to_code', 'NSM Fund', 'NSM Fund', NULL, 1, '2022-07-02 15:31:14', NULL),
(5, 'charged_to_code_rsm', 'charged_to_code', 'RSM Fund', 'RSM Fund', NULL, 1, '2022-07-02 15:31:14', NULL),
(6, 'charged_to_code_school_rbsi', 'charged_to_code', 'School Fund (RBSI)', 'School Fund (RBSI)', NULL, 1, '2022-07-02 15:31:14', NULL),
(7, 'charged_to_code_school_adb', 'charged_to_code', 'School Fund (ADB)', 'School Fund (ADB)', NULL, 1, '2022-07-02 15:31:14', NULL),
(8, 'charged_to_description_nsm', 'charged_to_description', 'NSM Fund', 'NSM Fund', NULL, 1, '2022-07-02 15:31:14', NULL),
(9, 'charged_to_description_rsm', 'charged_to_description', 'RSM Fund', 'RSM Fund', NULL, 1, '2022-07-02 15:31:14', NULL),
(10, 'charged_to_description_school_rbsi', 'charged_to_description', 'School Fund (RBSI)', 'School Fund (RBSI)', NULL, 1, '2022-07-02 15:31:14', NULL),
(11, 'charged_to_description_school_adb', 'charged_to_description', 'School Fund (ADB)', 'School Fund (ADB)', NULL, 1, '2022-07-02 15:31:15', NULL),
(12, 'activation_yes', 'charged_to_activation', 'Yes', 'Yes', NULL, 1, '2022-07-02 15:31:15', NULL),
(13, 'activation_no', 'charged_to_activation', 'No', 'No', NULL, 1, '2022-07-02 15:31:15', NULL),
(14, 'YES', 'CHART_OF_ACCOUNTS_ACTIVATION', 'YES', 'ACTIVATION', NULL, 0, '2022-06-21 02:16:14', NULL),
(15, 'NO', 'CHART_OF_ACCOUNTS_ACTIVATION', 'NO', 'ACTIVATION', NULL, 0, '2022-06-21 04:06:59', NULL),
(16, 'YES', 'COST_CENTER_ACTIVATION', 'YES', 'YES', NULL, 0, '2022-06-20 23:20:08', NULL),
(17, 'NO', 'COST_CENTER_ACTIVATION', 'NO', 'NO', NULL, 0, '2022-06-20 23:20:25', NULL),
(18, 'REVENUE', 'COST_CENTER_SUB_CATEGORY', 'REVENUE', 'REVENUE', NULL, 0, '2022-06-20 23:24:31', NULL),
(19, 'SELLING', 'COST_CENTER_SUB_CATEGORY', 'SELLING', 'SELLING', NULL, 0, '2022-06-20 23:25:55', NULL),
(20, 'MARKETING', 'COST_CENTER_SUB_CATEGORY', 'MARKETING', 'MARKETING', NULL, 0, '2022-06-20 23:26:07', NULL),
(21, 'B2B', 'COST_CENTER_B2B_B2C', 'B2B', 'B2B', NULL, 0, '2022-06-20 23:26:50', NULL),
(22, 'B2C', 'COST_CENTER_B2B_B2C', 'B2C', 'B2C', NULL, 0, '2022-06-20 23:27:04', NULL),
(23, 'K10', 'CREDIT_MANAGEMENT_SUB_BU', 'K10', 'SUB_BU', NULL, 0, '2022-06-30 10:08:41', NULL),
(24, 'TMD', 'CREDIT_MANAGEMENT_SUB_BU', 'TMD', 'SUB_BU', NULL, 0, '2022-06-30 10:08:53', NULL),
(25, 'SHS', 'CREDIT_MANAGEMENT_SUB_BU', 'SHS', 'SUB_BU', NULL, 0, '2022-06-30 10:09:00', NULL),
(26, 'LMD', 'CREDIT_MANAGEMENT_SUB_BU', 'LMD', 'SUB_BU', NULL, 0, '2022-06-30 10:09:12', NULL),
(27, 'DEFAULT', 'CREDIT_MANAGEMENT_STATUS', 'DEFAULT', 'STATUS', NULL, 0, '2022-06-30 10:09:52', NULL),
(28, 'customer_stage_code_nsm', 'customer_stage_code', 'AWARENESS/DISCOVERY', 'AWARENESS/DISCOVERY', NULL, 1, '2022-07-02 15:35:09', NULL),
(29, 'customer_stage_code_rsm', 'customer_stage_code', 'INTEREST BUILDING', 'INTEREST BUILDING', NULL, 1, '2022-07-02 15:35:09', NULL),
(30, 'customer_stage_code_school_rbsi', 'customer_stage_code', 'PURCHASE ', 'PURCHASE ', NULL, 1, '2022-07-02 15:35:09', NULL),
(31, 'customer_stage_code_school_adb', 'customer_stage_code', 'CONSIDERATION', 'CONSIDERATION', NULL, 1, '2022-07-02 15:35:09', NULL),
(32, 'customer_stage_code_school_adb', 'customer_stage_code', 'CONVERSION/ADOPTION', 'CONVERSION/ADOPTION', NULL, 1, '2022-07-02 15:35:09', NULL),
(33, 'customer_stage_code_school_adb', 'customer_stage_code', 'USAGE SATISFACTION', 'USAGE SATISFACTION', NULL, 1, '2022-07-02 15:35:09', NULL),
(34, 'customer_stage_code_school_adb', 'customer_stage_code', 'LOYALTY', 'LOYALTY', NULL, 1, '2022-07-02 15:35:09', NULL),
(35, 'customer_stage_code_school_adb', 'customer_stage_code', 'ADVOCACY', 'ADVOCACY', NULL, 1, '2022-07-02 15:35:09', NULL),
(36, 'customer_stage_description_nsm', 'customer_stage_description', 'AWARENESS/DISCOVERY', 'AWARENESS/DISCOVERY', NULL, 1, '2022-07-02 15:35:09', NULL),
(37, 'customer_stage_description_rsm', 'customer_stage_description', 'INTEREST BUILDING', 'INTEREST BUILDING', NULL, 1, '2022-07-02 15:35:09', NULL),
(38, 'customer_stage_description_school_rbsi', 'customer_stage_description', 'PURCHASE', 'PURCHASE', NULL, 1, '2022-07-02 15:35:09', NULL),
(39, 'customer_stage_description_school_adb', 'customer_stage_description', 'CONSIDERATION', 'CONSIDERATION', NULL, 1, '2022-07-02 15:35:09', NULL),
(40, 'customer_stage_description_school_adb', 'customer_stage_description', 'CONVERSION/ADOPTION', 'CONVERSION/ADOPTION', NULL, 1, '2022-07-02 15:35:09', NULL),
(41, 'customer_stage_description_school_adb', 'customer_stage_description', 'USAGE SATISFACTION', 'USAGE SATISFACTION', NULL, 1, '2022-07-02 15:35:09', NULL),
(42, 'customer_stage_description_school_adb', 'customer_stage_description', 'LOYALTY', 'LOYALTY', NULL, 1, '2022-07-02 15:35:09', NULL),
(43, 'customer_stage_description_school_adb', 'customer_stage_description', 'ADVOCACY', 'ADVOCACY', NULL, 1, '2022-07-02 15:35:09', NULL),
(44, 'activation_yes', 'customer_stage_activation', 'Yes', 'Yes', NULL, 1, '2022-07-02 15:35:09', NULL),
(45, 'activation_no', 'customer_stage_activation', 'No', 'No', NULL, 1, '2022-07-02 15:35:09', NULL),
(46, 'K10', 'DISCOUNT_MASTER_SUB_BU', 'K10', 'SUB_BU', NULL, 0, '2022-06-27 23:53:04', NULL),
(47, 'SHS', 'DISCOUNT_MASTER_SUB_BU', 'SHS', 'SUB_BU', NULL, 0, '2022-06-27 23:53:41', NULL),
(48, 'ECE', 'DISCOUNT_MASTER_SUB_BU', 'ECE', 'SUB_BU', NULL, 0, '2022-06-27 23:54:01', NULL),
(49, 'TMD', 'DISCOUNT_MASTER_SUB_BU', 'TMD', 'SUB_BU', NULL, 0, '2022-06-27 23:54:47', NULL),
(50, 'LMD', 'DISCOUNT_MASTER_SUB_BU', 'LMD', 'SUB_BU', NULL, 0, '2022-06-27 23:55:08', NULL),
(51, 'DEFAULT', 'DISCOUNT_MASTER_PRODUCT_TYPE', 'DEFAULT', 'PRODUCT TYPE', NULL, 0, '2022-06-29 22:38:42', NULL),
(52, 'return_rates_sub_bu_k10', 'return_rates_sub_bu', 'K10', 'K10', NULL, 1, '2022-07-02 15:37:15', NULL),
(53, 'return_rates_sub_bu_shs', 'return_rates_sub_bu', 'SHS', 'SHS', NULL, 1, '2022-07-02 15:37:15', NULL),
(54, 'return_rates_sub_bu_ece', 'return_rates_sub_bu', 'ECE', 'ECE', NULL, 1, '2022-07-02 15:37:15', NULL),
(55, 'return_rates_sub_bu_tmd', 'return_rates_sub_bu', 'TMD', 'TMD', NULL, 1, '2022-07-02 15:37:15', NULL),
(56, 'return_rates_sub_bu_lmd', 'return_rates_sub_bu', 'LMD', 'LMD', NULL, 1, '2022-07-02 15:37:15', NULL),
(57, 'DEFAULT', 'ITEM_MASTER_PRODUCT_CLASSIFICATION', 'DEFAULT', 'PRODUCT CLASSIFICATION', NULL, 0, '2022-06-29 23:15:35', NULL),
(58, 'ISA PA', 'ITEM_MASTER_PRODUCT_CLASSIFICATION', 'ISA PA', 'PRODUCT CLASSIFICATION', NULL, 0, '2022-06-29 23:49:24', NULL),
(59, 'TWO', 'ITEM_MASTER_PRODUCT_CLASSIFICATION', 'TWO', 'PRODUCT CLASSIFICATION', NULL, 0, '2022-06-30 00:07:10', NULL),
(60, 'ONE TIME', 'OCCURRENCE', 'ONE TIME', 'ONE TIME', NULL, 0, '2022-06-29 20:54:39', NULL),
(61, 'RECURRING', 'OCCURRENCE', 'RECURRING', 'RECURRING', NULL, 0, '2022-06-29 20:54:46', NULL),
(62, 'YES', 'OCCURRENCE_ACTIVATION', 'YES', 'YES', NULL, 0, '2022-06-29 20:54:39', NULL),
(63, 'NO', 'OCCURRENCE_ACTIVATION', 'NO', 'NO', NULL, 0, '2022-06-29 20:54:46', NULL),
(64, 'K10', 'SALES_REPORT_SUB_BU', 'K10', 'SUB_BU', NULL, 0, '2022-06-30 04:01:56', NULL),
(65, 'SHS', 'SALES_REPORT_SUB_BU', 'SHS', 'SUB_BU', NULL, 0, '2022-06-30 04:02:30', NULL),
(66, 'ECE', 'SALES_REPORT_SUB_BU', 'ECE', 'SUB_BU', NULL, 0, '2022-06-30 04:02:40', NULL),
(67, 'TMD', 'SALES_REPORT_SUB_BU', 'TMD', 'SUB_BU', NULL, 0, '2022-06-30 04:02:51', NULL),
(68, 'LMD', 'SALES_REPORT_SUB_BU', 'LMD', 'SUB_BU', NULL, 0, '2022-06-30 04:03:02', NULL),
(69, 'DEFAULT', 'SALES_REPORT_PRODUCT_FORMAT', 'DEFAULT', 'PRODUCT FORMAT', NULL, 0, '2022-06-30 06:03:38', NULL),
(70, 'ANNUAL', 'SALES_REPORT_SEMESTER', 'ANNUAL', 'SEMESTER', NULL, 0, '2022-06-30 09:28:42', NULL),
(71, 'SCHOOL', 'TARGET_END_USER', 'SCHOOL', 'SCHOOL', NULL, 0, '2022-06-28 23:55:54', NULL),
(72, 'ADMINISTRATOR', 'TARGET_END_USER', 'ADMINISTRATOR', 'ADMINISTRATOR', NULL, 0, '2022-06-28 23:56:01', NULL),
(73, 'FACULTY', 'TARGET_END_USER', 'FACULTY', 'FACULTY', NULL, 0, '2022-06-28 23:56:07', NULL),
(74, 'PARENTS', 'TARGET_END_USER', 'PARENTS', 'PARENTS', NULL, 0, '2022-06-28 23:56:14', NULL),
(75, 'STUDENTS', 'TARGET_END_USER', 'STUDENTS', 'STUDENTS', NULL, 0, '2022-06-28 23:56:21', NULL),
(76, 'PERSONAL', 'TARGET_END_USER', 'PERSONAL', 'PERSONAL', NULL, 0, '2022-06-28 23:56:29', NULL),
(77, 'YES', 'TARGET_END_USER_ACTIVATION', 'YES', 'YES', NULL, 0, '2022-06-28 23:57:24', NULL),
(78, 'NO', 'TARGET_END_USER_ACTIVATION', 'NO', 'NO', NULL, 0, '2022-06-28 23:57:29', NULL),
(79, 'K12', 'THRESHOLD_COMPUTATION_BU', 'K12', 'K12', NULL, 0, '2022-06-27 22:36:13', NULL),
(80, 'RED', 'THRESHOLD_COMPUTATION_COLOR_CODE', 'RED', 'RED', NULL, 0, '2022-06-27 22:36:37', NULL),
(81, 'GREEN', 'THRESHOLD_COMPUTATION_COLOR_CODE', 'GREEN', 'GREEN', NULL, 0, '2022-06-27 22:36:44', NULL),
(82, 'WITHIN', 'THRESHOLD_COMPUTATION_DATA_FILTER', 'WITHIN', 'WITHIN', NULL, 0, '2022-06-27 22:36:55', NULL),
(83, 'BELOW', 'THRESHOLD_COMPUTATION_DATA_FILTER', 'BELOW', 'BELOW', NULL, 0, '2022-06-27 22:37:05', NULL),
(84, 'ABOVE', 'THRESHOLD_COMPUTATION_DATA_FILTER', 'ABOVE', 'ABOVE', NULL, 0, '2022-06-27 22:37:14', NULL),
(85, 'BP TARGET', 'THRESHOLD_COMPUTATION_REFERENCE_POINT', 'BP TARGET', 'BP TARGET', NULL, 0, '2022-06-27 22:37:41', NULL),
(86, 'K10', 'THRESHOLD_COMPUTATION_SUB_BU', 'K10', 'K10', NULL, 0, '2022-06-27 22:37:52', NULL),
(87, 'SHS', 'THRESHOLD_COMPUTATION_SUB_BU', 'SHS', 'SHS', NULL, 0, '2022-06-27 22:37:57', NULL),
(88, 'active', 'transaction_status', 'Active', 'Active', NULL, 1, '2022-06-20 05:26:03', NULL),
(89, 'inactive', 'transaction_status', 'Inactive', 'Inactive', NULL, 1, '2022-06-20 05:26:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `module_name` varchar(225) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `controller_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `label_display` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `order_index` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `module_name`, `name`, `controller_name`, `description`, `label_display`, `icon`, `url`, `parent`, `order_index`, `level`, `status`) VALUES
(1, 'manage_users', 'users', 'users', 'Users', 'Users', NULL, '/users', 3, 1, 2, 0),
(2, 'manage_users', 'user_roles', 'user_roles', 'User Roles', 'User Roles', NULL, '/user_roles', 3, 2, 2, 0),
(3, 'manage_users', 'manage_users', 'manage_users', 'Manage Users and Roles', 'Manage Users', 'fa-group', 'manage_users', NULL, 2, 1, 0),
(4, 'home', 'dashboard', '', 'Dashboard', 'Dashboard', 'fa-dashboard', NULL, NULL, 1, 1, 0),
(5, 'maintenance', 'maintenance', 'maintenance', 'Maintenance', 'Maintenance', 'fa-cogs', 'maintenance', NULL, 3, 1, 0),
(6, 'maintenance', 'general_maintenance', 'general', 'General', 'General Maintenance', NULL, '/general', 5, 1, 2, 0),
(7, 'maintenance', 'cost_center', 'cost_center', 'Cost Center', 'Cost Center', NULL, '/cost_center', 5, 1, 2, 0),
(8, 'maintenance', 'ac_mapping', 'ac_mapping', 'Item Master Account Code Mapping', 'Item Master Account Code Mapping', NULL, '/ac_mapping', 5, 1, 2, 0),
(9, 'maintenance', 'aop_targets', 'aop_targets', 'AOP Targets', 'AOP Targets', NULL, '/aop_targets', 5, 1, 2, 0),
(10, 'maintenance', 'bp_initiative', 'bp_initiative', 'Business Plan Initiatives', 'Business Plan Initiatives', NULL, '/bp_initiative', 5, 1, 2, 0),
(11, 'maintenance', 'charged_to', 'charged_to', 'Charged To', 'Charged To', NULL, '/charged_to', 5, 1, 2, 0),
(12, 'maintenance', 'chart_of_accounts', 'chart_of_accounts', 'Chart of Accounts', 'Chart of Accounts', NULL, '/chart_of_accounts', 5, 1, 2, 0),
(13, 'maintenance', 'ctsr_bcr', 'ctsr_bcr', 'CTSR Budget Release Control', 'CTSR Budget Release Control', NULL, '/ctsr_bcr', 5, 1, 2, 0),
(14, 'maintenance', 'customer_stage', 'customer_stage', 'Customer Stage', 'Customer Stage', NULL, '/customer_stage', 5, 1, 2, 0),
(15, 'maintenance', 'estimated_return_rates', 'estimated_return_rates', 'Estimated Return Rates', 'Estimated Return Rates', NULL, '/estimated_return_rates', 5, 1, 2, 0),
(16, 'maintenance', 'historical_return_rates', 'historical_return_rates', 'Historical Return Rates', 'Historical Return Rates', NULL, '/historical_return_rates', 5, 1, 2, 0),
(17, 'maintenance', 'occurrence', 'occurrence', 'Occurrence', 'Occurrence', NULL, '/occurrence', 5, 1, 2, 0),
(18, 'maintenance', 'price_list', 'price_list', 'Price List', 'Price List', NULL, '/price_list', 5, 1, 2, 0),
(19, 'maintenance', 'target_end_user', 'target_end_user', 'Target End User', 'Target End User', NULL, '/target_end_user', 5, 1, 2, 0),
(20, 'maintenance', 'threshold', 'threshold', 'Threshold', 'Threshold', NULL, '/threshold', 5, 1, 2, 0),
(21, 'maintenance', 'item_master_maintenance', 'item_master_maintenance', 'Item Master Maintenance', 'Item Master Maintenance', NULL, '/item_master_maintenance', 5, 1, 2, 0),
(22, 'maintenance', 'credit_management', 'credit_management', 'Credit Management', 'Credit Management', NULL, '/credit_management', 5, 1, 2, 0),
(23, 'maintenance', 'customers', 'customers', 'Customers', 'Customers', NULL, '/customers', 5, 1, 2, 0),
(24, 'maintenance', 'discount_master', 'discount_master', 'Discount Master', 'Discount Master', NULL, '/discount_master', 5, 1, 2, 0),
(25, 'maintenance', 'sales_report', 'sales_report', 'Sales Report', 'Sales Report', NULL, '/sales_report', 5, 1, 2, 0),
(26, 'maintenance', 'sobi_direct_invoice', 'sobi_direct_invoice', 'SOBI Direct Invoice', 'SOBI Direct Invoice', NULL, '/sobi_direct_invoice', 5, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`) VALUES
(1, 'manage_users', 'Manage Users'),
(2, 'modules', 'Modules'),
(3, 'menu', 'Menu'),
(4, 'home', 'Home Module'),
(5, 'maintenance', 'Maintenance File');

-- --------------------------------------------------------

--
-- Table structure for table `module_functions`
--

CREATE TABLE `module_functions` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_functions`
--

INSERT INTO `module_functions` (`id`, `menu_name`, `name`, `description`) VALUES
(1, 'users', 'view', 'View'),
(2, 'users', 'create', 'Create'),
(3, 'users', 'edit', 'Edit'),
(4, 'user_roles', 'view', 'View'),
(5, 'user_roles', 'create', 'Create'),
(6, 'user_roles', 'edit', 'Edit'),
(7, 'maintenance', 'no_restriction', 'No Restriction'),
(8, 'general_maintenance', 'no_restriction', 'No Restriction'),
(9, 'dashboard', 'no_restriction', 'No Restriction'),
(10, 'cost_center', 'view', 'View'),
(11, 'cost_center', 'create', 'Create'),
(12, 'ac_mapping', 'view', 'View'),
(13, 'ac_mapping', 'create', 'Create'),
(14, 'aop_targets', 'view', 'View'),
(15, 'aop_targets', 'create', 'Create'),
(16, 'bp_initiative', 'view', 'View'),
(17, 'bp_initiative', 'create', 'Create'),
(18, 'charged_to', 'view', 'View'),
(19, 'charged_to', 'create', 'Create'),
(20, 'chart_of_accounts', 'view', 'View'),
(21, 'chart_of_accounts', 'create', 'Create'),
(22, 'ctsr_bcr', 'view', 'View'),
(23, 'ctsr_bcr', 'create', 'Create'),
(24, 'customer_stage', 'view', 'View'),
(25, 'customer_stage', 'create', 'Create'),
(26, 'estimated_return_rates', 'view', 'View'),
(27, 'estimated_return_rates', 'create', 'Create'),
(28, 'historical_return_rates', 'view', 'View'),
(29, 'historical_return_rates', 'create', 'Create'),
(30, 'occurrence', 'view', 'View'),
(31, 'occurrence', 'create', 'Create'),
(32, 'price_list', 'view', 'View'),
(33, 'price_list', 'create', 'Create'),
(34, 'target_end_user', 'view', 'View'),
(35, 'target_end_user', 'create', 'Create'),
(36, 'threshold', 'view', 'View'),
(37, 'threshold', 'create', 'Create'),
(38, 'item_master_maintenance', 'view', 'View'),
(39, 'item_master_maintenance', 'create', 'Create'),
(40, 'credit_management', 'view', 'View'),
(41, 'credit_management', 'create', 'Create'),
(42, 'customers', 'view', 'View'),
(43, 'customers', 'create', 'Create'),
(44, 'discount_master', 'view', 'View'),
(45, 'discount_master', 'create', 'Create'),
(46, 'sales_report', 'view', 'View'),
(47, 'sales_report', 'create', 'Create'),
(48, 'sobi_direct_invoice', 'view', 'View'),
(49, 'sobi_direct_invoice', 'create', 'Create');

-- --------------------------------------------------------

--
-- Table structure for table `occurrence`
--

CREATE TABLE `occurrence` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `occurrence_code` varchar(100) NOT NULL,
  `occurrence_description` varchar(100) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` tinyint(4) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `role_functions`
--

CREATE TABLE `role_functions` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `module_function_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_functions`
--

INSERT INTO `role_functions` (`id`, `user_role_id`, `module_function_id`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 6),
(4, 1, 2),
(5, 1, 3),
(6, 1, 1),
(10, 1, 9),
(11, 1, 8),
(12, 1, 7),
(43, 1, 14),
(44, 1, 15),
(45, 1, 16),
(46, 1, 17),
(47, 1, 18),
(48, 1, 19),
(49, 1, 20),
(50, 1, 21),
(51, 1, 10),
(52, 1, 11),
(53, 1, 40),
(54, 1, 41),
(55, 1, 22),
(56, 1, 23),
(57, 1, 24),
(58, 1, 25),
(59, 1, 42),
(60, 1, 43),
(61, 1, 44),
(62, 1, 45),
(63, 1, 26),
(64, 1, 27),
(65, 1, 28),
(66, 1, 29),
(67, 1, 12),
(68, 1, 13),
(69, 1, 38),
(70, 1, 39),
(71, 1, 30),
(72, 1, 31),
(73, 1, 32),
(74, 1, 33),
(75, 1, 46),
(76, 1, 47),
(77, 1, 48),
(78, 1, 49),
(79, 1, 34),
(80, 1, 35),
(81, 1, 36),
(82, 1, 37);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `macola_id_k10` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_id_shs` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_id_tmd` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `macola_id_lmd` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `deped_id` varchar(100) NOT NULL,
  `ched_id` varchar(100) NOT NULL,
  `ramco_code` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `ma_code` varchar(100) NOT NULL,
  `sales_channel` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `customer_objective` varchar(100) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `sub_business_unit` varchar(100) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_description` varchar(100) NOT NULL,
  `grade_level` varchar(100) NOT NULL,
  `strand` varchar(100) NOT NULL,
  `track_program` varchar(100) NOT NULL,
  `strand_discipline` varchar(100) NOT NULL,
  `product_disposition` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_format` varchar(100) NOT NULL,
  `market_owner` varchar(100) NOT NULL,
  `qty_to_ship` int(11) NOT NULL,
  `return_to_stk` int(11) NOT NULL,
  `net_delivery` int(11) NOT NULL,
  `ship_in_peso` int(11) NOT NULL,
  `return_in_peso` int(11) NOT NULL,
  `gross_revenue` int(11) NOT NULL,
  `discount_in_peso` int(11) NOT NULL,
  `net_delivery_in_peso` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `b2b_b2c` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slspn_mapping`
--

CREATE TABLE `slspn_mapping` (
  `id` int(11) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `ma_code` varchar(100) NOT NULL,
  `ma_id` int(11) NOT NULL,
  `rsm_bu` varchar(100) NOT NULL,
  `rsm_code` varchar(100) NOT NULL,
  `rsm_id` int(11) NOT NULL,
  `nsm_code` varchar(100) NOT NULL,
  `nsm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `target_end_user`
--

CREATE TABLE `target_end_user` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `busines_unit` varchar(100) NOT NULL,
  `target_end_user` varchar(100) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `threshold_computation`
--

CREATE TABLE `threshold_computation` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `percentage` float NOT NULL,
  `data_filter` varchar(100) NOT NULL,
  `reference_point` varchar(100) NOT NULL,
  `color_code` varchar(100) NOT NULL,
  `business_unit` varchar(100) NOT NULL,
  `sub_bu` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `employee_no` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `sales_person_code` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `slspn_bu` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `position_code` varchar(100) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `department_code` varchar(100) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `company_code` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `employee_status` varchar(100) NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `employee_no`, `fullname`, `first_name`, `middle_name`, `last_name`, `email_address`, `sales_person_code`, `region`, `slspn_bu`, `module`, `position_code`, `position_name`, `department_code`, `department_name`, `company_code`, `company_name`, `employee_status`, `expiration_date`, `created_by`, `date_created`, `updated_by`, `date_updated`) VALUES
(1, 1, 'super_user', 'RBSI-85-003-TMP-001', 'Adriano, Robin-And', 'Robin-And', 'Rodriguez', 'Adriano', 'rradriano@rex.com.ph', NULL, NULL, '', '', 'RBSI-85-003', 'Sr. Application Developer', 'RBSI-85', 'IT - Solutions and Development', 'RBSI', 'Rex Book Store, Inc', 'Probationary', NULL, 0, '2020-07-04 07:03:11', 1, '2020-08-14 14:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `landing_page` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `description`, `landing_page`, `created_by`, `date_created`, `active`) VALUES
(1, 'super_user', 'Super User', 'home', 1, '2022-07-02 16:06:42', 1),
(2, 'K12_MA', 'K12 Material Advisor', 'home', 1, '2020-12-07 00:10:22', 1),
(3, 'K12_RSM', 'K12 Regional Sales Manager', 'home', 1, '2020-12-07 00:10:35', 1),
(4, 'K12_NSM', 'K12 National Sales Manager', 'home', 1, '2020-12-07 00:10:46', 1),
(5, 'LMD_MA', 'LMD Material Advisor', 'home', 1, '2020-12-07 00:15:34', 1),
(6, 'LMD_RSM', 'LMD Regional Sales Manager', 'home', 1, '2020-12-07 00:19:02', 1),
(7, 'LMD_NSM', 'LMD National Sales Manager', 'home', 1, '2020-12-07 00:19:41', 1),
(8, 'TMD_MA', 'TMD Material Advisor', 'home', 1, '2020-12-07 00:20:29', 1),
(9, 'TMD_RSM', 'TMD Regional Sales Manager', 'home', 1, '2020-12-07 00:21:43', 1),
(10, 'TMD_NSM', 'TMD National Sales Manager', 'home', 1, '2020-12-07 00:22:20', 1),
(11, 'LSG_MA', 'LSG Material Advisor', 'home', 1, '2020-12-07 00:23:03', 1),
(12, 'LSG_RSM', 'LSG Regional Sales Manager', 'home', 1, '2020-12-07 00:23:42', 1),
(13, 'LSG_NSM', 'LSG National Sales Manager', 'home', 1, '2020-12-07 00:24:13', 1),
(14, 'TMD_LMD_MA', 'TMD/LMD Material Advisor', NULL, 1, '2020-12-14 17:04:46', 1),
(15, 'TMD_LMD_RSM', 'TMD/LMD Regional Sales Manager', NULL, 1, '2020-12-14 17:06:24', 1),
(16, 'CSR', 'Customer Service Representative', NULL, 1, '2021-01-31 16:18:20', 1),
(17, 'CSR-TMD', 'Customer Representative TMD', NULL, 1, '2021-06-22 20:30:37', 1),
(18, 'CSR-LMD', 'Customer Representative LMD', NULL, 1, '2021-06-22 20:30:44', 1),
(19, 'CSR-TMD-LMD', 'Customer Representative TMD and LMD', NULL, 1, '2021-06-22 20:30:58', 1),
(20, 'CSR-K12-TMD-LMD', 'Customer Service Representative - K12-TMD-LMD', NULL, 1, '2021-06-22 22:49:48', 1),
(21, 'CSR-RBSI', 'CSR - K12, TMD, LMD for Ma\'am Onnie', NULL, 1, '2021-06-30 22:18:35', 1),
(22, 'DISTRIBUTOR_MA', 'DISTRIBUTOR Material Advisor', 'home', 1, '2020-12-07 00:10:22', 1),
(23, 'DISTRIBUTOR_RSM', 'DISTRIBUTOR Regional Sales Manager', 'home', 1, '2020-12-07 00:10:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` longtext NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `date_created`) VALUES
(1, 1, '021c6cd3a69730ac97d0b65576a9004f', '2022-06-15 07:42:10'),
(2, 1, 'b3063f8c0b04435ed2b10a4d9cf1efa5', '2022-06-16 07:11:40'),
(3, 1, '62c1514a1482b512060e23db78325441', '2022-06-20 01:39:45'),
(4, 1, 'e98d1f55017791d46c0150e4324fb6e2', '2022-06-20 04:27:28'),
(5, 1, '80176e3e465b7bcd86a77531811a03ea', '2022-06-21 02:30:44'),
(6, 1, 'e260c59cf76472298e7c7ea476fd42a0', '2022-06-28 06:19:43'),
(7, 1, '302d6b3a2ecd683c26e1f731897271ca', '2022-06-30 02:06:36'),
(8, 1, '7f642e7bff6909fac7b055ec70129e47', '2022-07-02 14:51:33'),
(9, 1, 'cb48cdee4c8f75300f78263ec620902d', '2022-07-02 15:49:33'),
(10, 1, 'ddcadbc8430c4e671849b81bafd7ab20', '2022-07-02 15:51:54'),
(11, 1, '1daa71a4caa5d90165fc9cb4faab465b', '2022-07-02 15:59:14'),
(12, 1, 'b2d788831e574923738e41c7f80b645f', '2022-07-02 16:02:45'),
(13, 1, '2c249bc0ad162295325988aee5fa150e', '2022-07-02 16:05:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_mapping`
--
ALTER TABLE `ac_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aop_targets`
--
ALTER TABLE `aop_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bpim_transactions`
--
ALTER TABLE `bpim_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bpim_transaction_status`
--
ALTER TABLE `bpim_transaction_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bp_initiative`
--
ALTER TABLE `bp_initiative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charged_to`
--
ALTER TABLE `charged_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_code` (`school_code`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `cost_center`
--
ALTER TABLE `cost_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_management`
--
ALTER TABLE `credit_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctsr_bcr`
--
ALTER TABLE `ctsr_bcr`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `customer_stage`
--
ALTER TABLE `customer_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_master`
--
ALTER TABLE `discount_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimated_return_rates`
--
ALTER TABLE `estimated_return_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hed_grms`
--
ALTER TABLE `hed_grms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historical_return_rates`
--
ALTER TABLE `historical_return_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_master_maintenance`
--
ALTER TABLE `item_master_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_type`
--
ALTER TABLE `maintenance_type`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `maintenance_value`
--
ALTER TABLE `maintenance_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `maintenance_type_code` (`maintenance_type_code`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_name`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_functions`
--
ALTER TABLE `module_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occurrence`
--
ALTER TABLE `occurrence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_functions`
--
ALTER TABLE `role_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slspn_mapping`
--
ALTER TABLE `slspn_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sobi_direct_invoice`
--
ALTER TABLE `sobi_direct_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_end_user`
--
ALTER TABLE `target_end_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threshold_computation`
--
ALTER TABLE `threshold_computation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_mapping`
--
ALTER TABLE `ac_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aop_targets`
--
ALTER TABLE `aop_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bpim_transactions`
--
ALTER TABLE `bpim_transactions`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bpim_transaction_status`
--
ALTER TABLE `bpim_transaction_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bp_initiative`
--
ALTER TABLE `bp_initiative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charged_to`
--
ALTER TABLE `charged_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost_center`
--
ALTER TABLE `cost_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_management`
--
ALTER TABLE `credit_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctsr_bcr`
--
ALTER TABLE `ctsr_bcr`
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

--
-- AUTO_INCREMENT for table `customer_stage`
--
ALTER TABLE `customer_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount_master`
--
ALTER TABLE `discount_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimated_return_rates`
--
ALTER TABLE `estimated_return_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hed_grms`
--
ALTER TABLE `hed_grms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `historical_return_rates`
--
ALTER TABLE `historical_return_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_master_maintenance`
--
ALTER TABLE `item_master_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_value`
--
ALTER TABLE `maintenance_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_functions`
--
ALTER TABLE `module_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `occurrence`
--
ALTER TABLE `occurrence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_functions`
--
ALTER TABLE `role_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slspn_mapping`
--
ALTER TABLE `slspn_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sobi_direct_invoice`
--
ALTER TABLE `sobi_direct_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target_end_user`
--
ALTER TABLE `target_end_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `threshold_computation`
--
ALTER TABLE `threshold_computation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
