-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 09:58 AM
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
-- Database: `bpims_k12`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `cis_id` int(11) NOT NULL,
  `contact_id` varchar(100) NOT NULL,
  `school_code` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(100) DEFAULT NULL,
  `local_number` varchar(100) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL
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
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `id` int(11) NOT NULL,
  `previous_code` varchar(100) DEFAULT NULL,
  `item_no` varchar(100) NOT NULL,
  `item_desc_1` varchar(100) DEFAULT NULL,
  `item_desc_2` varchar(100) DEFAULT NULL,
  `grade_level` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_category_2` varchar(100) NOT NULL,
  `product_segment` varchar(100) DEFAULT NULL,
  `product_format` varchar(100) NOT NULL,
  `item_weight` float DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `prod_cat` int(11) DEFAULT NULL,
  `mat_cost_type` int(11) DEFAULT NULL,
  `mat_cost_desc` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `copyright` int(11) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `srp` float DEFAULT NULL,
  `distributor_srp` float DEFAULT NULL,
  `business_unit` varchar(100) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
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
(6, 'maintenance', 'general_maintenance', 'general', 'General', 'General Maintenance', NULL, '/general', 5, 1, 2, 0);

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
(9, 'dashboard', 'no_restriction', 'No Restriction');

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
(7, 1, 7),
(8, 1, 8),
(9, 1, 9);

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
(1, 'super_user', 'Super User', 'home', 1, '2020-04-20 00:57:47', 1);

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
(1, 1, '021c6cd3a69730ac97d0b65576a9004f', '2022-06-15 07:42:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_code` (`school_code`);

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
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_no` (`item_no`);

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
-- Indexes for table `role_functions`
--
ALTER TABLE `role_functions`
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
-- AUTO_INCREMENT for table `item_master`
--
ALTER TABLE `item_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_value`
--
ALTER TABLE `maintenance_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_functions`
--
ALTER TABLE `module_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_functions`
--
ALTER TABLE `role_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
