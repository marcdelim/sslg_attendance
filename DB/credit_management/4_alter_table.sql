-- ALTER TABLE `credit_management` 
-- ADD `school_name` VARCHAR(100) NOT NULL AFTER `ramco_code`, 
-- CHANGE `macola_id_k10` `macola_id_k10` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, 
-- CHANGE `macola_id_shs` `macola_id_shs` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, 
-- CHANGE `macola_id_tmd` `macola_id_tmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, 
-- CHANGE `macola_id_lmd` `macola_id_lmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `credit_management` 
CHANGE `macola_id_k10` `macola_id_k10` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_id_shs` `macola_id_shs` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_id_tmd` `macola_id_tmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_id_lmd` `macola_id_lmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
CHANGE `created_by` `created_by` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
CHANGE `updated_by` `updated_by` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;