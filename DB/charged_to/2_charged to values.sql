INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES 
('charged_to_code', 'Charged to Codee', 'Charged to Code', '1', current_timestamp(), NULL), 
('charged_to_description', 'Charged to Description', 'Charged to Description', '1', current_timestamp(), NULL),
('charged_to_activation', 'Charged to Activation', 'Charged to Activation', '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_code_nsm', 'charged_to_code', 'NSM Fund', 'NSM Fund', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_code_rsm', 'charged_to_code', 'RSM Fund', 'RSM Fund', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_code_school_rbsi', 'charged_to_code', 'School Fund (RBSI)', 'School Fund (RBSI)', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_code_school_adb', 'charged_to_code', 'School Fund (ADB)', 'School Fund (ADB)', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_description_nsm', 'charged_to_description', 'NSM Fund', 'NSM Fund', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_description_rsm', 'charged_to_description', 'RSM Fund', 'RSM Fund', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_description_school_rbsi', 'charged_to_description', 'School Fund (RBSI)', 'School Fund (RBSI)', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'charged_to_description_school_adb', 'charged_to_description', 'School Fund (ADB)', 'School Fund (ADB)', NULL, '1', current_timestamp(), NULL);


INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'activation_yes', 'charged_to_activation', 'Yes', 'Yes', NULL, '1', current_timestamp(), NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'activation_no', 'charged_to_activation', 'No', 'No', NULL, '1', current_timestamp(), NULL);