INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES ('customer_program_expense_sub_category', 'Customer Program Expense Sub Category', 'Customer Program Expense Sub Category', '1', '2022-07-02 23:42:25', NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_program_expense_sub_category_marketing', 'customer_program_expense_sub_category', 'Marketing', 'Marketing', NULL, '1', '2022-07-02 23:31:14', NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_program_expense_sub_category_sales', 'customer_program_expense_sub_category', 'Sales (Others)', 'Sales (Others)', NULL, '1', '2022-07-02 23:31:14', NULL);

INSERT INTO `maintenance_type` (`code`, `name`, `description`, `created_by`, `date_created`, `archived`) VALUES ('customer_program_b2b_b2c', 'Customer Program B2B B2C', 'Customer Program B2B B2C', '1', '2022-07-02 23:42:25', NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_program_b2b', 'customer_program_b2b_b2c', 'Adoption', 'Adoption', NULL, '1', '2022-07-02 23:31:14', NULL);

INSERT INTO `maintenance_value` (`id`, `code`, `maintenance_type_code`, `name`, `description`, `parent_code`, `created_by`, `date_created`, `archived`) VALUES (NULL, 'customer_program_b2c', 'customer_program_b2b_b2c', 'Library', 'Library', NULL, '1', '2022-07-02 23:31:14', NULL);