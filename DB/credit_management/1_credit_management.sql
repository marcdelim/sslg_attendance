CREATE TABLE `credit_management` (
`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
);