UPDATE
    `maintenance_type`
SET
    `code` = 'credit_management_ar_status',
    `name` = 'credit_management_ar_status',
    `description` = 'Credit Management AR Status'
WHERE
    `maintenance_type`.`code` = 'credit_management_status';