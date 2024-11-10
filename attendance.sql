-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:08 PM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `sslg_officers_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL DEFAULT current_timestamp(),
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
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
(4, 'home', 'dashboard', '', 'Attendance', 'Attendance', 'fa-dashboard', NULL, NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
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

DROP TABLE IF EXISTS `module_functions`;
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
(10, 'transactions', 'no_restriction', 'No Restriction');

-- --------------------------------------------------------

--
-- Table structure for table `role_functions`
--

DROP TABLE IF EXISTS `role_functions`;
CREATE TABLE `role_functions` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `module_function_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_functions`
--

INSERT INTO `role_functions` (`id`, `user_role_id`, `module_function_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sslg_officers`
--

DROP TABLE IF EXISTS `sslg_officers`;
CREATE TABLE `sslg_officers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sslg_officers`
--

INSERT INTO `sslg_officers` (`id`, `full_name`, `position`) VALUES
(1, 'Jessika Clare L. Caballero', 'President'),
(2, 'Shan Charlie D. Reyes', 'Vice President\r\n'),
(3, 'Jana Krisha Mari V. Fajardo', 'Secretary'),
(4, 'Charlene D. Badiola', 'Treasurer'),
(5, 'Rachel Anne I. Zamora', 'Auditor'),
(6, 'Regie B. Fernandez', 'Public Information Officer'),
(7, 'Urice Marionne S. Samson', 'Protocol Officer'),
(8, 'Eshia Keightria B. De Guzman', 'Grade 7 Representatives'),
(9, 'Kyle Allen O. Manalo', 'Grade 7 Representatives'),
(10, 'Krisha Maireen E. Adorable', 'Grade 8 Representatives'),
(11, 'Angelica Jhedalyn D. Luneta', 'Grade 8 Representatives'),
(12, 'Daniel C. Basiga', 'Grade 9 Representatives'),
(13, 'Yuan Niño Tunay', 'Grade 9 Representatives'),
(14, 'Jeychelle M. Laurilla', 'Grade 10 Representatives'),
(15, 'Cyrus Evo DJ Gellido', 'Grade 10 Representatives'),
(16, 'Niño B. Inocentes', 'Grade 11 Representatives'),
(17, '', 'Grade 11 Representatives'),
(18, 'Marvin Amor', 'Grade 12 Representatives'),
(19, 'John Dave A. Ramirez', 'Grade 12 Representatives');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `description` varchar(225) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `previous_year` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `next_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `description`, `school_year`, `previous_year`, `current_year`, `next_year`) VALUES
(000001, '2024 CRMS', '2024 - 2025', 2023, 2024, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_status`
--

DROP TABLE IF EXISTS `transaction_status`;
CREATE TABLE `transaction_status` (
  `id` int(11) NOT NULL,
  `transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `status` varchar(50) NOT NULL,
  `locked` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_status`
--

INSERT INTO `transaction_status` (`id`, `transaction_id`, `status`, `locked`, `created_by`, `date_created`, `archived`) VALUES
(1, 000001, 'active', 0, 1, '2022-08-07 14:15:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
(1, 1, 'super_user', 'RBSI-85-003-TMP-001', 'Adriano, Robin-And', 'Robin-And', 'Rodriguez', 'Adriano', 'rradriano@rex.com.ph', NULL, NULL, '', '', 'RBSI-85-003', 'Sr. Application Developer', 'RBSI-85', 'IT - Solutions and Development', 'RBSI', 'Rex Book Store, Inc', 'Probationary', NULL, 0, '2020-07-04 07:03:11', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
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

DROP TABLE IF EXISTS `user_tokens`;
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
(1, 1, '021c6cd3a69730ac97d0b65576a9004f', '2024-06-03 01:46:38'),
(2, 1, 'b3063f8c0b04435ed2b10a4d9cf1efa5', '2024-06-03 02:02:03'),
(3, 1, '62c1514a1482b512060e23db78325441', '2024-11-08 14:47:51'),
(4, 1, 'e98d1f55017791d46c0150e4324fb6e2', '2024-11-08 17:07:38'),
(5, 1, '80176e3e465b7bcd86a77531811a03ea', '2024-11-08 23:42:07'),
(6, 1, 'e260c59cf76472298e7c7ea476fd42a0', '2024-11-08 23:42:07'),
(7, 1, '302d6b3a2ecd683c26e1f731897271ca', '2024-11-08 23:42:08'),
(8, 1, '7f642e7bff6909fac7b055ec70129e47', '2024-11-08 23:42:08'),
(9, 1, 'cb48cdee4c8f75300f78263ec620902d', '2024-11-08 23:42:09'),
(10, 1, 'ddcadbc8430c4e671849b81bafd7ab20', '2024-11-08 23:44:21'),
(11, 1, '1daa71a4caa5d90165fc9cb4faab465b', '2024-11-09 01:26:42'),
(12, 1, 'b2d788831e574923738e41c7f80b645f', '2024-11-09 02:41:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sslg_officers`
--
ALTER TABLE `sslg_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_status`
--
ALTER TABLE `transaction_status`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_functions`
--
ALTER TABLE `module_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role_functions`
--
ALTER TABLE `role_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sslg_officers`
--
ALTER TABLE `sslg_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_status`
--
ALTER TABLE `transaction_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
