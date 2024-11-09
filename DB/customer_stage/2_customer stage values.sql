INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES 
('customer_stage_code', 'Customer Stage Code', 'Customer Stage Code', '1', current_timestamp(), NULL), 
('customer_stage_description', 'Customer Stage Description', 'Customer Stage Description', '1', current_timestamp(), NULL),
('customer_stage_activation', 'Customer Stage Activation', 'Customer Stage Activation', '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_nsm', 'customer_stage_code', 'AWARENESS/DISCOVERY', 'AWARENESS/DISCOVERY', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_rsm', 'customer_stage_code', 'INTEREST BUILDING', 'INTEREST BUILDING', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_rbsi', 'customer_stage_code', 'PURCHASE ', 'PURCHASE ', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_adb', 'customer_stage_code', 'CONSIDERATION', 'CONSIDERATION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_adb', 'customer_stage_code', 'CONVERSION/ADOPTION', 'CONVERSION/ADOPTION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_adb', 'customer_stage_code', 'USAGE SATISFACTION', 'USAGE SATISFACTION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_adb', 'customer_stage_code', 'LOYALTY', 'LOYALTY', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_code_school_adb', 'customer_stage_code', 'ADVOCACY', 'ADVOCACY', NULL, '1', current_timestamp(), NULL);



INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_nsm', 'customer_stage_description', 'AWARENESS/DISCOVERY', 'AWARENESS/DISCOVERY', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_rsm', 'customer_stage_description', 'INTEREST BUILDING', 'INTEREST BUILDING', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_rbsi', 'customer_stage_description', 'PURCHASE', 'PURCHASE', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_adb', 'customer_stage_description', 'CONSIDERATION', 'CONSIDERATION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_adb', 'customer_stage_description', 'CONVERSION/ADOPTION', 'CONVERSION/ADOPTION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_adb', 'customer_stage_description', 'USAGE SATISFACTION', 'USAGE SATISFACTION', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_adb', 'customer_stage_description', 'LOYALTY', 'LOYALTY', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_stage_description_school_adb', 'customer_stage_description', 'ADVOCACY', 'ADVOCACY', NULL, '1', current_timestamp(), NULL);


INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'activation_yes', 'customer_stage_activation', 'Yes', 'Yes', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'activation_no', 'customer_stage_activation', 'No', 'No', NULL, '1', current_timestamp(), NULL);