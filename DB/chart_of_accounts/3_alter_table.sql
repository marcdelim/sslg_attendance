ALTER TABLE `chart_of_accounts` 
CHANGE `account_code` `account_code` BIGINT(255) NOT NULL,
CHANGE `archived` `archived` DATETIME NULL DEFAULT NULL;