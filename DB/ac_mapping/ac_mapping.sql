CREATE TABLE `ac_mapping`(
`id` INT NOT NULL AUTO_INCREMENT,
`transaction_id` int(6) UNSIGNED ZEROFILL NOT NULL,
`product_segment` VARCHAR(100) NOT NULL,
`gross_deliveries_account_code` INT NOT NULL,
`gross_deliveries_account_description` VARCHAR(100) NOT NULL,
`sales_return_account_code` INT NOT NULL,
`sales_return_account_description` VARCHAR(100) NOT NULL,
`sales_discount_account_code` INT NOT NULL,
`sales_discount_account_description` VARCHAR(100) NOT NULL,
`cost_of_sales_account_code` INT NOT NULL,
`cost_of_sales_account_description` VARCHAR(100) NOT NULL,
`created_by` int(11) NOT NULL,
`date_created` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_by` int(11) DEFAULT NULL,
`date_updated` datetime DEFAULT NULL,
`archived` datetime DEFAULT NULL,
PRIMARY KEY(`id`)
) ENGINE = InnoDB;