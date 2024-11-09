ALTER TABLE `discount_master` 
CHANGE `macola_code_k10` `macola_code_k10` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_code_shs` `macola_code_shs` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_code_tmd` `macola_code_tmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, 
CHANGE `macola_code_lmd` `macola_code_lmd` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
CHANGE `bussiness_unit` `business_unit` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;