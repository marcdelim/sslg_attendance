INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES 
('return_rates_sub_bu', 'return_rates_sub_bu', 'Return Rates Sub Business Unit', '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'return_rates_sub_bu_k10', 'return_rates_sub_bu', 'K10', 'K10', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'return_rates_sub_bu_shs', 'return_rates_sub_bu', 'SHS', 'SHS', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'return_rates_sub_bu_ece', 'return_rates_sub_bu', 'ECE', 'ECE', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'return_rates_sub_bu_tmd', 'return_rates_sub_bu', 'TMD', 'TMD', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'return_rates_sub_bu_lmd', 'return_rates_sub_bu', 'LMD', 'LMD', NULL, '1', current_timestamp(), NULL);


INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES 
('return_rates_product_type', 'Return Rates Product Type', 'Return Rates Product Type', '1', current_timestamp(), NULL);