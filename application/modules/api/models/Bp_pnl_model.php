<?php

class Bp_pnl_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function monthly_skewing($data)
    {
        $columns = [
            "sub_bu"    => "hed_grms.sub_business_unit",
            "january"   => "COALESCE(hed_grms.january, 0)",
            "february"  => "COALESCE(hed_grms.february, 0)",
            "march"     => "COALESCE(hed_grms.march, 0)",
            "april"     => "COALESCE(hed_grms.april, 0)",
            "may"       => "COALESCE(hed_grms.may, 0)",
            "june"      => "COALESCE(hed_grms.june, 0)",
            "july"      => "COALESCE(hed_grms.july, 0)",
            "august"    => "COALESCE(hed_grms.august, 0)",
            "september" => "COALESCE(hed_grms.september, 0)",
            "october"   => "COALESCE(hed_grms.october, 0)",
            "november"  => "COALESCE(hed_grms.november, 0)",
            "december"  => "COALESCE(hed_grms.december, 0)",
        ];

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('hed_grms.sub_business_unit', $data['sub_bu']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('hed_grms.transaction_id', $data['transaction_id']);
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('hed_grms')
            ->where('hed_grms.archived', null);
        return $this->db->get()->result_array();
    }

    public function detailed_sales_forecast($data)
    {
        $product = strtoupper($data['product']);
        if (strtoupper($data['product_format']) == "PRINTED") {
            if ($product == "SELLING_COMPLI") {
                $imm_item_code = "item_master_maintenance.pfp_scc_itemcode";
                $item_description = "item_master_maintenance.pfp_scc_item_description";
                $product_category_1 = "item_master_maintenance.pfp_scc_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_scc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_scc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.compli_print, 0)";
            } else if ($product == "TRM") {
                $imm_item_code = "item_master_maintenance.pfp_tc_item_code";
                $item_description = "item_master_maintenance.pfp_tc_item_description";
                $product_category_1 = "item_master_maintenance.pfp_tc_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_tc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_tc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.trm_prof_print, 0)";
            } else if ($product == "EVAL_COPY") {
                $imm_item_code = "item_master_maintenance.pfp_ec_item_code";
                $item_description = "item_master_maintenance.pfp_ec_item_description";
                $product_category_1 = "item_master_maintenance.pfp_ec_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_ec_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_ec_prod_category";
                $net_quantity = "COALESCE(sales_forecast.eval_copy_print, 0)";
            }
            $sf_item_code = "sales_forecast.item_code_print";
        } else if (strtoupper($data['product_format']) == "DIGITAL") {
            if ($product == "SELLING_COMPLI") {
                $imm_item_code = "item_master_maintenance.pfnp_scc_item_code";
                $item_description = "item_master_maintenance.pfnp_scc_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_scc_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_scc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_scc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.compli_pdf, 0)";
            } else if ($product == "TRM") {
                $imm_item_code = "item_master_maintenance.pfnp_tc_item_code";
                $item_description = "item_master_maintenance.pfnp_tc_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_tc_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_tc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_tc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.trm_prof_pdf, 0)";
            } else if ($product == "EVAL_COPY") {
                $imm_item_code = "item_master_maintenance.pfnp_ec_item_code";
                $item_description = "item_master_maintenance.pfnp_ec_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_ec_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_ec_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_ec_prod_category";
                $net_quantity = "COALESCE(sales_forecast.eval_copy_pdf, 0)";
            }
            $sf_item_code = "sales_forecast.item_code_digital";
        }
        $unit_price = "COALESCE(price_list.standard_cost, 0)";
        $returns_rate = "COALESCE(estimated_return_rates.returns_rate, 0)";
        $gross_quantity = "IF((1 - ($returns_rate)) != 0, ($net_quantity) / (1 - ($returns_rate)), 0)";
        $quantity_return = "($gross_quantity) - ($net_quantity)";
        $gross_deliveries = "($gross_quantity) * ($unit_price)";
        $sales_returns = "($quantity_return) * ($unit_price)";
        $gross_revenue_net = "($gross_deliveries) - ($sales_returns)";
        $discount_rate = "COALESCE(discount_master.discount_rate, 0)";
        $sales_discounts = "($gross_revenue_net) * ($discount_rate)";
        $net_revenue = "($gross_revenue_net) - ($sales_discounts)";
        $net_to_gross_ratio = "IF($gross_revenue_net != 0, ($net_revenue) / ($gross_revenue_net), 0)";
        $cost_of_sales_and_services = "($net_quantity) * ($unit_price)";
        $gross_profit = "($net_revenue) - ($cost_of_sales_and_services)";
        $gp_margin = "IF(($gross_revenue_net) != 0, ($gross_profit) / ($gross_revenue_net), 0)";
        $gross_revenue = "($net_quantity) * ($unit_price)";
        $product = $data['product'];
        $hed = [
            "rbsi"      => "COALESCE(customer_program.rbsi, 0)",
            "adb_sales" => "COALESCE(customer_program.adb, 0)",
            "digital"   => "COALESCE(customer_program.digital, 0)",
        ];
        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
            if($data['sub_bu']=="TMD"){
                $description = "Revenue and Costs_TMD";
            }
            else{
                $description = "Revenue and Costs_LMD";
            }
        }
        $value = strtoupper($data['sub_bu']) == "TMD" ? $hed : $hed;
        $columns = [
            "sales_forecast_id"          => "sales_forecast.id",
            "template"                   => "'sales_forecast'",
            "school_code"                => "customer_master.school_code",
            "ramco_code"                 => "customer_master.ramco_code",
            "k10_customer_code_macola"   => "customer_master.macola_id_k10",
            "shs_customer_code_macola"   => "customer_master.macola_id_shs",
            "tmd_customer_code_macola"   => "customer_master.macola_id_tmd",
            "lmd_customer_code_macola"   => "customer_master.macola_id_lmd",
            "other_customer_codes"       => "customer_master.school_code",
            "customer_name"              => "customer_master.school_name",
            "salesperson"                => "customer_master.ma_code",
            "area"                       => "customer_master.region",
            "customer_objective"         => "customer_master.customer_objective",
            "market_segment"             => "customer_master.market_segmentation",
            "product"                    => "'$product'",
            "item_number"                => $imm_item_code,
            "item_description"           => $item_description,
            "grade_lvl_course"           => "item_master_maintenance.grade_level",
            "product_category_1"         => $product_category_1,
            "product_category_2"         => $product_category_2,
            "product_type"               => "item_master_maintenance.product_type",
            "product_format"             => "item_master_maintenance.product_format",
            "product_segment"            => "item_master_maintenance.product_segment",
            "product_disposition"        => "item_master_maintenance.prod_class_disposition",
            "product_bau_initiative"     => $product_bau_initiative,
            "unit_price"                 => $unit_price,
            "sales_channel"              => "CASE
                                                 WHEN cost_center.parent_cc_unit = 103 THEN 'TMDSC'
                                                 WHEN cost_center.parent_cc_unit = 104 THEN 'LMDSC'
                                             END",
            "b2b_b2c"                    => "'B2B'",
            "budget_source"              => "slspn_mapping.company",
            "gross_quantity"             => $gross_quantity,
            "quantity_return"            => $quantity_return,
            "net_quantity"               => $net_quantity,
            "gross_deliveries"           => $gross_deliveries,
            "sales_returns"              => $sales_returns,
            "gross_revenue_net"          => $gross_revenue_net,
            "sales_discounts"            => $sales_discounts,
            "net_revenue"                => $net_revenue,
            "net_to_gross_ratio"         => $net_to_gross_ratio,
            "cost_of_sales_and_services" => $cost_of_sales_and_services,
            "gross_profit"               => $gross_profit,
            "gp_margin"                  => $gp_margin,
            "gross_revenue"              => $gross_revenue,
            "month_of"                   => "customer_program.month_of",
            "rbsi"                       => '0',
            "adb_sales"                  => '0',
            "digital"                    => '0',
            "cc_unit"                    => "cost_center.cc_unit",
            "parent_cc_unit"             => "cost_center.parent_cc_unit",
            "sub_category"               => "cost_center.sub_category",
            "initiative"                 => "sps_care.initiative",
            "marketing"                  => "'marketing'",
            "selling"                    => "'selling'",
           
        ];
        for ($count = 1; $count <= 12; $count++) {
            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
            $monthly_skewing = $data[$month];
            $columns += array(
                $month . "_gross_quantity"             => "($gross_quantity) * ($monthly_skewing)",
                $month . "_quantity_return"            => "($quantity_return) * ($monthly_skewing)",
                $month . "_net_quantity"               => "($net_quantity) * ($monthly_skewing)",
                $month . "_gross_deliveries"           => "($gross_deliveries) * ($monthly_skewing)",
                $month . "_sales_returns"              => "($sales_returns) * ($monthly_skewing)",
                $month . "_gross_revenue_net"          => "($gross_revenue_net) * ($monthly_skewing)",
                $month . "_sales_discounts"            => "($sales_discounts) * ($monthly_skewing)",
                $month . "_net_revenue"                => "($net_revenue) * ($monthly_skewing)",
                $month . "_net_to_gross_ratio"         => "($net_to_gross_ratio) * ($monthly_skewing)",
                $month . "_cost_of_sales_and_services" => "($cost_of_sales_and_services) * ($monthly_skewing)",
                $month . "_gross_profit"               => "($gross_profit) * ($monthly_skewing)",
                $month . "_gp_margin"                  => "($gp_margin) * ($monthly_skewing)",
            );
        }

        if (isset($data['product_format']) && $data['product_format'] != "") {
            $this->db->where('item_master_maintenance.product_format', $data['product_format']);
        }
        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('sales_forecast.transaction_id', $data['transaction_id']);
        }
        if (isset($data['group_by']) && $data['group_by'] != "") {
            $columns['gross_quantity'] = "SUM($gross_quantity)";
            $columns['quantity_return'] = "SUM($quantity_return)";
            $columns['net_quantity'] = "SUM($net_quantity)";
            $columns['gross_deliveries'] = "SUM($gross_deliveries)";
            $columns['sales_returns'] = "SUM($sales_returns)";
            $columns['gross_revenue_net'] = "SUM($gross_revenue_net)";
            $columns['sales_discounts'] = "SUM($sales_discounts)";
            $columns['net_revenue'] = "SUM($net_revenue)";
            $columns['net_to_gross_ratio'] = "SUM($net_to_gross_ratio)";
            $columns['cost_of_sales_and_services'] = "SUM($cost_of_sales_and_services)";
            $columns['gross_profit'] = "SUM($gross_profit)";
            $columns['gp_margin'] = "SUM($gp_margin)";
            for ($count = 1; $count <= 12; $count++) {
                $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                $monthly_skewing = $data[$month];
                $columns[$month . '_gross_quantity'] = "SUM(($gross_quantity) * ($monthly_skewing))";
                $columns[$month . '_quantity_return'] = "SUM(($quantity_return) * ($monthly_skewing))";
                $columns[$month . '_net_quantity'] = "SUM(($net_quantity) * ($monthly_skewing))";
                $columns[$month . '_gross_deliveries'] = "SUM(($gross_deliveries) * ($monthly_skewing))";
                $columns[$month . '_sales_returns'] = "SUM(($sales_returns) * ($monthly_skewing))";
                $columns[$month . '_gross_revenue_net'] = "SUM(($gross_revenue_net) * ($monthly_skewing))";
                $columns[$month . '_sales_discounts'] = "SUM(($sales_discounts) * ($monthly_skewing))";
                $columns[$month . '_net_revenue'] = "SUM(($net_revenue) * ($monthly_skewing))";
                $columns[$month . '_net_to_gross_ratio'] = "SUM(($net_to_gross_ratio) * ($monthly_skewing))";
                $columns[$month . '_cost_of_sales_and_services'] = "SUM(($cost_of_sales_and_services) * ($monthly_skewing))";
                $columns[$month . '_gross_profit'] = "SUM(($gross_profit) * ($monthly_skewing))";
                $columns[$month . '_gp_margin'] = "SUM(($gp_margin) * ($monthly_skewing))";
            }
            $this->db->group_by($data['group_by']);
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('sales_forecast')
            ->join('customer_master', 'sales_forecast.school_code = customer_master.school_code AND customer_master.archived IS NULL', 'left')
            ->join('item_master_maintenance', $sf_item_code . ' = ' . $imm_item_code . ' AND item_master_maintenance.archived IS NULL', 'left')
            ->join('price_list', $imm_item_code . ' = price_list.item_code AND item_master_maintenance.product_type = price_list.item_type AND price_list.archived IS NULL', 'left')
            ->join('estimated_return_rates', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = estimated_return_rates.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = estimated_return_rates.product_type AND estimated_return_rates.archived IS NULL', 'left')
            ->join('discount_master', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = discount_master.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = discount_master.product_type AND discount_master.archived IS NULL', 'left')
            ->join('(SELECT school_code, expense_sub_category, initiative, month_of, sum(rbsi) as rbsi, sum(adb) as adb, sum(digital) as digital, archived from customer_program group by school_code) customer_program', 'customer_master.school_code = customer_program.school_code AND customer_program.archived IS NULL', 'left')
            ->join('cost_center', "cost_center.sub_category='REVENUE' AND cost_center.description_1='".$description."'  
                    AND cost_center.activation='YES' AND cost_center.archived IS NULL AND sales_forecast.transaction_id = cost_center.transaction_id", 'left')
            ->join('sps_care', 'customer_program.initiative = sps_care.id AND cost_center.sub_category = sps_care.sub_category AND sps_care.archived IS NULL', 'left')
            ->where($net_quantity . ' > ', 0)
            ->where('sales_forecast.archived', null);
        if (strtoupper($data['sub_bu']) == "TMD") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "T%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "L%"', 'left');
        }
        return $this->db->get()->result_array();
    }

    public function detailed_customer_program($data)
    {
        $product = strtoupper($data['product']);
        if (strtoupper($data['product_format']) == "PRINTED") {
            if ($product == "SELLING_COMPLI") {
                $imm_item_code = "item_master_maintenance.pfp_scc_itemcode";
                $item_description = "item_master_maintenance.pfp_scc_item_description";
                $product_category_1 = "item_master_maintenance.pfp_scc_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_scc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_scc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.compli_print, 0)";
            } else if ($product == "TRM") {
                $imm_item_code = "item_master_maintenance.pfp_tc_item_code";
                $item_description = "item_master_maintenance.pfp_tc_item_description";
                $product_category_1 = "item_master_maintenance.pfp_tc_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_tc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_tc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.trm_prof_print, 0)";
            } else if ($product == "EVAL_COPY") {
                $imm_item_code = "item_master_maintenance.pfp_ec_item_code";
                $item_description = "item_master_maintenance.pfp_ec_item_description";
                $product_category_1 = "item_master_maintenance.pfp_ec_prod_category";
                $product_category_2 = "item_master_maintenance.pfp_ec_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfp_ec_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.eval_copy_print, 0)";
            }
            $sf_item_code = "sales_forecast.item_code_print";
        } else if (strtoupper($data['product_format']) == "DIGITAL") {
            if ($product == "SELLING_COMPLI") {
                $imm_item_code = "item_master_maintenance.pfnp_scc_item_code";
                $item_description = "item_master_maintenance.pfnp_scc_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_scc_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_scc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_scc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.compli_pdf, 0)";
            } else if ($product == "TRM") {
                $imm_item_code = "item_master_maintenance.pfnp_tc_item_code";
                $item_description = "item_master_maintenance.pfnp_tc_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_tc_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_tc_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_tc_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.trm_prof_pdf, 0)";
            } else if ($product == "EVAL_COPY") {
                $imm_item_code = "item_master_maintenance.pfnp_ec_item_code";
                $item_description = "item_master_maintenance.pfnp_ec_item_description";
                $product_category_1 = "item_master_maintenance.pfnp_ec_prod_category";
                $product_category_2 = "item_master_maintenance.pfnp_ec_prod_category2";
                $product_bau_initiative = "item_master_maintenance.pfnp_ec_prod_category";
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.eval_copy_pdf, 0)";
            }
            $sf_item_code = "sales_forecast.item_code_digital";
        }
        $unit_price = "COALESCE(price_list.standard_cost, 0)";
        $returns_rate = "COALESCE(estimated_return_rates.returns_rate, 0)";
        $gross_quantity = "IF((1 - ($returns_rate)) != 0, ($net_quantity) / (1 - ($returns_rate)), 0)";
        $quantity_return = "($gross_quantity) - ($net_quantity)";
        $gross_deliveries = "($gross_quantity) * ($unit_price)";
        $sales_returns = "($quantity_return) * ($unit_price)";
        $gross_revenue_net = "($gross_deliveries) - ($sales_returns)";
        $discount_rate = "COALESCE(discount_master.discount_rate, 0)";
        $sales_discounts = "($gross_revenue_net) * ($discount_rate)";
        $net_revenue = "($gross_revenue_net) - ($sales_discounts)";
        $net_to_gross_ratio = "IF($gross_revenue_net != 0, ($net_revenue) / ($gross_revenue_net), 0)";
        $cost_of_sales_and_services = "($net_quantity) * ($unit_price)";
        $gross_profit = "($net_revenue) - ($cost_of_sales_and_services)";
        $gp_margin = "IF(($gross_revenue_net) != 0, ($gross_profit) / ($gross_revenue_net), 0)";
        $gross_revenue = "($net_quantity) * ($unit_price)";
        $product = $data['product'];
        $hed = [
            "rbsi"      => "COALESCE(customer_program.rbsi, 0)",
            "adb_sales" => "COALESCE(customer_program.adb, 0)",
            "digital"   => "COALESCE(customer_program.digital, 0)",
        ];
        $value = strtoupper($data['sub_bu']) == "TMD" ? $hed : $hed;
        $columns = [
            "customer_program_id"        => "customer_program.id",
            "template"                   => "'customer_program'",
            "school_code"                => "customer_master.school_code",
            "ramco_code"                 => "customer_master.ramco_code",
            "k10_customer_code_macola"   => "customer_master.macola_id_k10",
            "shs_customer_code_macola"   => "customer_master.macola_id_shs",
            "tmd_customer_code_macola"   => "customer_master.macola_id_tmd",
            "lmd_customer_code_macola"   => "customer_master.macola_id_lmd",
            "other_customer_codes"       => "customer_master.deped_id",
            "customer_name"              => "customer_master.school_name",
            "salesperson"                => "customer_master.ma_code",
            "area"                       => "customer_master.region",
            "customer_objective"         => "customer_master.customer_objective",
            "market_segment"             => "customer_master.market_segmentation",
            "product"                    => "'$product'",
            "item_number"                => $imm_item_code,
            "item_description"           => $item_description,
            "grade_lvl_course"           => "item_master_maintenance.grade_level",
            "product_category_1"         => $product_category_1,
            "product_category_2"         => $product_category_2,
            "product_type"               => "item_master_maintenance.product_type",
            "product_format"             => "item_master_maintenance.product_format",
            "product_segment"            => "item_master_maintenance.product_segment",
            "product_disposition"        => "item_master_maintenance.prod_class_disposition",
            "product_bau_initiative"     => $product_bau_initiative,
            "unit_price"                 => $unit_price,
            "sales_channel"              => "CASE
                                                 WHEN cost_center.parent_cc_unit = 101 THEN 'K10SC'
                                                 WHEN cost_center.parent_cc_unit = 102 THEN 'SHSSC'
                                             END",
            "b2b_b2c"                    => "'B2B'",
            "budget_source"              => "slspn_mapping.company",
            "gross_quantity"             => $gross_quantity,
            "quantity_return"            => $quantity_return,
            "net_quantity"               => $net_quantity,
            "gross_deliveries"           => $gross_deliveries,
            "sales_returns"              => $sales_returns,
            "gross_revenue_net"          => $gross_revenue_net,
            "sales_discounts"            => $sales_discounts,
            "net_revenue"                => $net_revenue,
            "net_to_gross_ratio"         => $net_to_gross_ratio,
            "cost_of_sales_and_services" => $cost_of_sales_and_services,
            "gross_profit"               => $gross_profit,
            "gp_margin"                  => $gp_margin,
            "gross_revenue"              => $gross_revenue,
            "month_of"                   => "customer_program.month_of",
            "rbsi"                       => $value['rbsi'],
            "adb_sales"                  => $value['adb_sales'],
            "digital"                    => $value['digital'],
            "cc_unit"                    => "cost_center.cc_unit",
            "parent_cc_unit"             => "cost_center.parent_cc_unit",
            "sub_category"               => "cost_center.sub_category",
            "initiative"                 => "sps_care.initiative",
            "marketing"                  => "'marketing'",
            "selling"                    => "'selling'",
           
        ];
        for ($count = 1; $count <= 12; $count++) {
            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
            $monthly_skewing = $data[$month];
            $columns += array(
                $month . "_gross_quantity"             => "($gross_quantity) * ($monthly_skewing)",
                $month . "_quantity_return"            => "($quantity_return) * ($monthly_skewing)",
                $month . "_net_quantity"               => "($net_quantity) * ($monthly_skewing)",
                $month . "_gross_deliveries"           => "($gross_deliveries) * ($monthly_skewing)",
                $month . "_sales_returns"              => "($sales_returns) * ($monthly_skewing)",
                $month . "_gross_revenue_net"          => "($gross_revenue_net) * ($monthly_skewing)",
                $month . "_sales_discounts"            => "($sales_discounts) * ($monthly_skewing)",
                $month . "_net_revenue"                => "($net_revenue) * ($monthly_skewing)",
                $month . "_net_to_gross_ratio"         => "($net_to_gross_ratio) * ($monthly_skewing)",
                $month . "_cost_of_sales_and_services" => "($cost_of_sales_and_services) * ($monthly_skewing)",
                $month . "_gross_profit"               => "($gross_profit) * ($monthly_skewing)",
                $month . "_gp_margin"                  => "($gp_margin) * ($monthly_skewing)",
            );
        }

        if (isset($data['product_format']) && $data['product_format'] != "") {
            $this->db->where('item_master_maintenance.product_format', $data['product_format']);
        }
        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('sales_forecast.transaction_id', $data['transaction_id']);
        }
        if (isset($data['group_by']) && $data['group_by'] != "") {
            $columns['gross_quantity'] = "SUM($gross_quantity)";
            $columns['quantity_return'] = "SUM($quantity_return)";
            $columns['net_quantity'] = "SUM($net_quantity)";
            $columns['gross_deliveries'] = "SUM($gross_deliveries)";
            $columns['sales_returns'] = "SUM($sales_returns)";
            $columns['gross_revenue_net'] = "SUM($gross_revenue_net)";
            $columns['sales_discounts'] = "SUM($sales_discounts)";
            $columns['net_revenue'] = "SUM($net_revenue)";
            $columns['net_to_gross_ratio'] = "SUM($net_to_gross_ratio)";
            $columns['cost_of_sales_and_services'] = "SUM($cost_of_sales_and_services)";
            $columns['gross_profit'] = "SUM($gross_profit)";
            $columns['gp_margin'] = "SUM($gp_margin)";
            for ($count = 1; $count <= 12; $count++) {
                $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                $monthly_skewing = $data[$month];
                $columns[$month . '_gross_quantity'] = "SUM(($gross_quantity) * ($monthly_skewing))";
                $columns[$month . '_quantity_return'] = "SUM(($quantity_return) * ($monthly_skewing))";
                $columns[$month . '_net_quantity'] = "SUM(($net_quantity) * ($monthly_skewing))";
                $columns[$month . '_gross_deliveries'] = "SUM(($gross_deliveries) * ($monthly_skewing))";
                $columns[$month . '_sales_returns'] = "SUM(($sales_returns) * ($monthly_skewing))";
                $columns[$month . '_gross_revenue_net'] = "SUM(($gross_revenue_net) * ($monthly_skewing))";
                $columns[$month . '_sales_discounts'] = "SUM(($sales_discounts) * ($monthly_skewing))";
                $columns[$month . '_net_revenue'] = "SUM(($net_revenue) * ($monthly_skewing))";
                $columns[$month . '_net_to_gross_ratio'] = "SUM(($net_to_gross_ratio) * ($monthly_skewing))";
                $columns[$month . '_cost_of_sales_and_services'] = "SUM(($cost_of_sales_and_services) * ($monthly_skewing))";
                $columns[$month . '_gross_profit'] = "SUM(($gross_profit) * ($monthly_skewing))";
                $columns[$month . '_gp_margin'] = "SUM(($gp_margin) * ($monthly_skewing))";
            }
            $this->db->group_by($data['group_by']);
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('customer_program')
            ->join('customer_master', 'customer_master.school_code = customer_program.school_code AND customer_program.archived IS NULL', 'left')
            ->join('sales_forecast', 'customer_master.school_code = sales_forecast.school_code AND sales_forecast.archived IS NULL', 'left')
            ->join('item_master_maintenance', $sf_item_code . ' = ' . $imm_item_code . ' AND item_master_maintenance.archived IS NULL', 'left')
            ->join('price_list', $imm_item_code . ' = price_list.item_code AND item_master_maintenance.product_type = price_list.item_type AND price_list.archived IS NULL', 'left')
            ->join('estimated_return_rates', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = estimated_return_rates.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = estimated_return_rates.product_type AND estimated_return_rates.archived IS NULL', 'left')
            ->join('discount_master', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = discount_master.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = discount_master.product_type AND discount_master.archived IS NULL', 'left')
            ->join('cost_center', 'customer_program.expense_sub_category = cost_center.cc_unit AND cost_center.archived IS NULL', 'left')
            ->join('sps_care', 'customer_program.initiative = sps_care.id AND cost_center.sub_category = sps_care.sub_category AND sps_care.archived IS NULL', 'left')
            ->where('customer_program.archived', null);
        if (strtoupper($data['sub_bu']) == "TMD") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "T%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "L%"', 'left');
        }
        return $this->db->get()->result_array();
    }

    public function sales_forecast_cost_center($data)
    {
        // $this->common->vd($data);die();
        if (strtoupper($data['product_format']) == "PRINTED") {
            $this->db->where('sales_forecast.library_target_print > 0');
            $net_quantity = "COALESCE(sales_forecast.library_target_print, 0)";
            $imm_item_code = "item_master_maintenance.pfp_scc_itemcode";
            $sf_item_code = "sales_forecast.item_code_print";
        } else if (strtoupper($data['product_format']) == "DIGITAL") {
            $this->db->where('sales_forecast.library_target_pdf > 0');
            $net_quantity = "COALESCE(sales_forecast.library_target_pdf, 0)";
            $imm_item_code = "item_master_maintenance.pfnp_scc_item_code";
            $sf_item_code = "sales_forecast.item_code_digital";
        }
        $unit_price = "COALESCE(price_list.standard_cost, 0)";
        $returns_rate = "COALESCE(estimated_return_rates.returns_rate, 0)";
        $gross_quantity = "IF((1 - ($returns_rate)) != 0, ($net_quantity) / (1 - ($returns_rate)), 0)";
        $quantity_return = "($gross_quantity) - ($net_quantity)";
        $gross_deliveries = "ROUND(SUM(($gross_quantity) * ($unit_price)),2)";
        $sales_returns = "ROUND(SUM(($quantity_return) * ($unit_price)),2)";
        $gross_revenue_net = "($gross_deliveries) - ($sales_returns)";
        $discount_rate = "COALESCE(discount_master.discount_rate, 0)";
        $sales_discounts = "($gross_revenue_net) * ($discount_rate)";
        $net_revenue = "($gross_revenue_net) - ($sales_discounts)";
        $cost_of_sales_and_services = "ROUND(SUM(($net_quantity) * ($unit_price)),2)";
        //$overall_total = "SUM(($gross_deliveries) + ($sales_returns) + ($gross_revenue_net) + ($sales_discounts) + ($net_revenue) + ($cost_of_sales_and_services))";
        
        if ($data['account_code'] == "gross_deliveries") {
            $account_code = "ac_mapping.gross_deliveries_account_code";
            $account_description = "ac_mapping.gross_deliveries_account_description";
            $overall_total = $gross_deliveries;
        } else if ($data['account_code'] == "sales_returns") {
            $account_code = "ac_mapping.sales_return_account_code";
            $account_description = "ac_mapping.sales_return_account_description";
            $overall_total = $sales_returns;
        } else if ($data['account_code'] == "sales_discounts") {
            $account_code = "ac_mapping.sales_discount_account_code";
            $account_description = "ac_mapping.sales_discount_account_description";
            $overall_total = $sales_discounts;
        } else if ($data['account_code'] == "cost_of_sales_and_services") {
            $account_code = "ac_mapping.cost_of_sales_account_code";
            $account_description = "ac_mapping.cost_of_sales_account_description";
            $overall_total = $cost_of_sales_and_services;
        }

        $columns = [
            "cc_code"                    => "cost_center.cc_unit",
            "cost_center"                => "cost_center.description_1",
            "budget_source"              => "slspn_mapping.company",
            "customer_objective"         => "customer_master.customer_objective",
            "market_segment"             => "customer_master.market_segmentation",
            "expense_sub_category"       => "cost_center.sub_category",
            "account_code"               => $account_code,
            "account_description"        => $account_description,
            "overall_total"              => $overall_total,
            "parent_cc_unit"             => "cost_center.parent_cc_unit",
            "parent_cc_unit_description" => "cost_center.description_2",
            "sales_forecast_id"          => "sales_forecast.id",
            "template"                   => "'sales_forecast'",
        ];
        for ($count = 1; $count <= 12; $count++) {
            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
            $monthly_skewing = $data[$month];
            $columns += array(
                $month => "ROUND(($overall_total) * ($monthly_skewing),2)",
            );
        }

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
            if($data['sub_bu']=="TMD"){
                $description = "Revenue and Costs_TMD";
            }
            else{
                $description = "Revenue and Costs_LMD";
            }
        }
        if (isset($data['product_format']) && $data['product_format'] != "") {
            $this->db->where('item_master_maintenance.product_format', $data['product_format']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('sales_forecast.transaction_id', $data['transaction_id']);
        }

        $this->db->group_by(array("cost_center.cc_unit","customer_master.customer_objective","customer_master.market_segmentation","ac_mapping.gross_deliveries_account_code","slspn_mapping.company"));

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('sales_forecast')
            ->join('customer_master', 'sales_forecast.school_code = customer_master.school_code AND customer_master.archived IS NULL', 'left')
            ->join('item_master_maintenance', $sf_item_code . ' = ' . $imm_item_code . ' AND item_master_maintenance.archived IS NULL', 'left')
            ->join('price_list', $imm_item_code . ' = price_list.item_code AND item_master_maintenance.product_type = price_list.item_type AND price_list.archived IS NULL', 'left')
            ->join('estimated_return_rates', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = estimated_return_rates.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = estimated_return_rates.product_type AND estimated_return_rates.archived IS NULL', 'left')
            ->join('discount_master', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = discount_master.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = discount_master.product_type AND discount_master.archived IS NULL', 'left')
            ->join('cost_center', "cost_center.sub_category='REVENUE' AND cost_center.description_1='".$description."'  
                    AND cost_center.activation='YES' AND cost_center.archived IS NULL AND sales_forecast.transaction_id = cost_center.transaction_id", 'left')
            ->join('ac_mapping', 'sales_forecast.module = ac_mapping.product_segment AND ac_mapping.archived IS NULL', 'left')
            ->where('sales_forecast.archived', null);
        if (strtoupper($data['sub_bu']) == "TMD") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "%TNSM%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "%LNSM%"', 'left');
        }
        return $this->db->get()->result_array();
    }

    public function cost_center_customer_program($data)
    {
        // $this->common->vd($data);die();
        if (strtoupper($data['product_format']) == "PRINTED") {
            $this->db->where('sales_forecast.library_target_print > 0');
            $net_quantity = "COALESCE(sales_forecast.library_target_print, 0)";
            $imm_item_code = "item_master_maintenance.pfp_scc_itemcode";
            $sf_item_code = "sales_forecast.item_code_print";
        } else if (strtoupper($data['product_format']) == "DIGITAL") {
            $this->db->where('sales_forecast.library_target_pdf > 0');
            $net_quantity = "COALESCE(sales_forecast.library_target_pdf, 0)";
            $imm_item_code = "item_master_maintenance.pfnp_scc_item_code";
            $sf_item_code = "sales_forecast.item_code_digital";
        }
        $returns_rate = "COALESCE(estimated_return_rates.returns_rate, 0)";
        $gross_quantity = "IF((1 - ($returns_rate)) != 0, ($net_quantity) / (1 - ($returns_rate)), 0)";
        $quantity_return = "($gross_quantity) - ($net_quantity)";
        $unit_price = "COALESCE(price_list.standard_cost, 0)";
        $gross_deliveries = "($gross_quantity) * ($unit_price)";
        $sales_returns = "($quantity_return) * ($unit_price)";
        $gross_revenue_net = "($gross_deliveries) - ($sales_returns)";
        $discount_rate = "COALESCE(discount_master.discount_rate, 0)";
        $sales_discounts = "($gross_revenue_net) * ($discount_rate)";
        $net_revenue = "($gross_revenue_net) - ($sales_discounts)";
        $cost_of_sales_and_services = "($net_quantity) * ($unit_price)";
        $overall_total = "($gross_deliveries) + 
                          ($sales_returns) + 
                          ($gross_revenue_net) + 
                          ($sales_discounts) + 
                          ($net_revenue) + 
                          ($cost_of_sales_and_services)";

        $columns = [
            "cc_code"                    => "cost_center.cc_unit",
            "cost_center"                => "cost_center.description_1",
            "budget_source"              => "slspn_mapping.company",
            "customer_objective"         => "customer_master.customer_objective",
            "market_segment"             => "customer_master.market_segmentation",
            "expense_sub_category"       => "cost_center.sub_category",
            "account_code"               => "ac_mapping.gross_deliveries_account_code",
            "account_description"        => "ac_mapping.gross_deliveries_account_description",
            "overall_total"              => $overall_total,
            "parent_cc_unit"             => "cost_center.parent_cc_unit",
            "parent_cc_unit_description" => "cost_center.description_2",
            "sales_forecast_id"          => "sales_forecast.id",
            "template"                   => "'sales_forecast'",
        ];
        for ($count = 1; $count <= 12; $count++) {
            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
            $monthly_skewing = $data[$month];
            $columns += array(
                $month => "($overall_total) * ($monthly_skewing)",
            );
        }

        

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
            if($data['sub_bu']=="TMD"){
                $description = "Revenue and Costs_TMD";
            }
            else{
                $description = "Revenue and Costs_LMD";
            }
        }
        if (isset($data['product_format']) && $data['product_format'] != "") {
            $this->db->where('item_master_maintenance.product_format', $data['product_format']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('sales_forecast.transaction_id', $data['transaction_id']);
        }
        if (isset($data['group_by']) && $data['group_by'] != "") {
            $columns['overall_total'] = "SUM($overall_total)";
            for ($count = 1; $count <= 12; $count++) {
                $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                $monthly_skewing = $data[$month];
                $columns[$month] = "SUM(($overall_total) * ($monthly_skewing))";
            }
            $this->db->group_by(array("cost_center.cc_unit","customer_master.customer_objective","customer_master.market_segmentation","ac_mapping.gross_deliveries_account_code","slspn_mapping.company"));
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('sales_forecast')
            ->join('customer_master', 'sales_forecast.school_code = customer_master.school_code AND customer_master.archived IS NULL', 'left')
            ->join('item_master_maintenance', $sf_item_code . ' = ' . $imm_item_code . ' AND item_master_maintenance.archived IS NULL', 'left')
            ->join('price_list', $imm_item_code . ' = price_list.item_code AND item_master_maintenance.product_type = price_list.item_type AND price_list.archived IS NULL', 'left')
            ->join('estimated_return_rates', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = estimated_return_rates.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = estimated_return_rates.product_type AND estimated_return_rates.archived IS NULL', 'left')
            ->join('discount_master', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = discount_master.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = discount_master.product_type AND discount_master.archived IS NULL', 'left')
            // ->join('customer_program', 'customer_master.school_code = customer_program.school_code AND customer_program.archived IS NULL', 'left')
            ->join('cost_center', "cost_center.sub_category='REVENUE' AND cost_center.description_1='".$description."'  
                    AND cost_center.activation='YES' AND cost_center.archived IS NULL AND sales_forecast.transaction_id = cost_center.transaction_id", 'left')
            // ->join('bp_initiative', 'customer_program.initiative = bp_initiative.bp_initiative AND cost_center.sub_category = bp_initiative.sub_category AND bp_initiative.archived IS NULL', 'left')
            ->join('ac_mapping', 'sales_forecast.module = ac_mapping.product_segment AND ac_mapping.archived IS NULL', 'left')
            ->where('sales_forecast.archived', null);
        if (strtoupper($data['sub_bu']) == "TMD") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "%TNSM%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "%LNSM%"', 'left');
        }
        return $this->db->get()->result_array();
    }

    public function customer_program_cost_center($data)
    {
        if (strtoupper($data['product_format']) == "PRINTED") {
            if (strtoupper($data['product']) == "SELLING_COMPLI") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.compli_print, 0)";
                $imm_item_code = "item_master_maintenance.pfp_scc_itemcode";
            } else if (strtoupper($data['product']) == "TRM") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.trm_prof_print, 0)";
                $imm_item_code = "item_master_maintenance.pfp_tc_item_code";
            } else if (strtoupper($data['product']) == "EVAL_COPY") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_print, 0) + 
                                 COALESCE(sales_forecast.half_2_target_print, 0) + 
                                 COALESCE(sales_forecast.eval_copy_print, 0)";
                $imm_item_code = "item_master_maintenance.pfp_ec_item_code";
            }
            $sf_item_code = "sales_forecast.item_code_print";
        } else if (strtoupper($data['product_format']) == "DIGITAL") {
            if (strtoupper($data['product']) == "SELLING_COMPLI") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.compli_pdf, 0)";
                $imm_item_code = "item_master_maintenance.pfnp_scc_item_code";
            } else if (strtoupper($data['product']) == "TRM") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.trm_prof_pdf, 0)";
                $imm_item_code = "item_master_maintenance.pfnp_tc_item_code";
            } else if (strtoupper($data['product']) == "EVAL_COPY") {
                $net_quantity = "COALESCE(sales_forecast.half_1_target_pdf, 0) + 
                                 COALESCE(sales_forecast.half_2_target_pdf, 0) + 
                                 COALESCE(sales_forecast.eval_copy_pdf, 0)";
                $imm_item_code = "item_master_maintenance.pfnp_ec_item_code";
            }
            $sf_item_code = "sales_forecast.item_code_digital";
        }
        $returns_rate = "COALESCE(estimated_return_rates.returns_rate, 0)";
        $gross_quantity = "IF((1 - ($returns_rate)) != 0, ($net_quantity) / (1 - ($returns_rate)), 0)";
        $quantity_return = "($gross_quantity) - ($net_quantity)";
        $unit_price = "COALESCE(price_list.standard_cost, 0)";
        $gross_deliveries = "($gross_quantity) * ($unit_price)";
        $sales_returns = "($quantity_return) * ($unit_price)";
        $gross_revenue_net = "($gross_deliveries) - ($sales_returns)";
        $discount_rate = "COALESCE(discount_master.discount_rate, 0)";
        $sales_discounts = "($gross_revenue_net) * ($discount_rate)";
        $net_revenue = "($gross_revenue_net) - ($sales_discounts)";
        $cost_of_sales_and_services = "($net_quantity) * ($unit_price)";
        $overall_total = "($gross_deliveries) + 
                          ($sales_returns) + 
                          ($gross_revenue_net) + 
                          ($sales_discounts) + 
                          ($net_revenue) + 
                          ($cost_of_sales_and_services)";

        $columns = [
            "cc_code"                    => "cost_center.cc_unit",
            "cost_center"                => "cost_center.description_1",
            "budget_source"              => "slspn_mapping.company",
            "customer_objective"         => "customer_master.customer_objective",
            "market_segment"             => "customer_master.market_segmentation",
            "expense_sub_category"       => "cost_center.sub_category",
            "account_code"               => "CASE
                                                 WHEN cost_center.sub_category = 'MARKETING' THEN bp_initiative.account_code
                                                 WHEN cost_center.sub_category = 'SALES' THEN bp_initiative.account_code
                                                 WHEN cost_center.sub_category = 'REVENUE' THEN ac_mapping.gross_deliveries_account_code
                                             END",
            "account_description"        => "CASE
                                                 WHEN cost_center.sub_category = 'MARKETING' THEN bp_initiative.account_description
                                                 WHEN cost_center.sub_category = 'SALES' THEN bp_initiative.account_description
                                                 WHEN cost_center.sub_category = 'REVENUE' THEN ac_mapping.gross_deliveries_account_description
                                             END",
            "overall_total"              => $overall_total,
            "parent_cc_unit"             => "cost_center.parent_cc_unit",
            "parent_cc_unit_description" => "cost_center.description_2",
            "customer_program_id"        => "customer_program.id",
            "template"                   => "'customer_program'",
        ];
        for ($count = 1; $count <= 12; $count++) {
            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
            $monthly_skewing = $data[$month];
            $columns += array(
                $month => "($overall_total) * ($monthly_skewing)",
            );
        }

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('sales_forecast.module', $data['sub_bu']);
        }
        if (isset($data['product_format']) && $data['product_format'] != "") {
            $this->db->where('item_master_maintenance.product_format', $data['product_format']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('cost_center.transaction_id', $data['transaction_id']);
        }
        if (isset($data['group_by']) && $data['group_by'] != "") {
            $columns['overall_total'] = "SUM($overall_total)";
            for ($count = 1; $count <= 12; $count++) {
                $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                $columns[$month] = "SUM(($overall_total) * ($monthly_skewing))";
            }
            $this->db->group_by($data['group_by']);
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('customer_program')
            ->join('sales_forecast', 'customer_program.school_code = sales_forecast.school_code AND sales_forecast.archived IS NULL', 'left')
            ->join('customer_master', 'sales_forecast.school_code = customer_master.school_code AND customer_master.archived IS NULL', 'left')
            ->join('item_master_maintenance', $sf_item_code . ' = ' . $imm_item_code . ' AND item_master_maintenance.archived IS NULL', 'left')
            ->join('price_list', $imm_item_code . ' = price_list.item_code AND item_master_maintenance.product_type = price_list.item_type AND price_list.archived IS NULL', 'left')
            ->join('estimated_return_rates', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = estimated_return_rates.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = estimated_return_rates.product_type AND estimated_return_rates.archived IS NULL', 'left')
            ->join('discount_master', 'customer_master.macola_id_' . strtolower($data['sub_bu']) . ' = discount_master.macola_code_' . strtolower($data['sub_bu']) . ' AND item_master_maintenance.product_type = discount_master.product_type AND discount_master.archived IS NULL', 'left')
            ->join('cost_center', 'customer_program.expense_sub_category = cost_center.cc_unit AND cost_center.archived IS NULL', 'left')
            ->join('bp_initiative', 'customer_program.initiative = bp_initiative.bp_initiative AND cost_center.sub_category = bp_initiative.sub_category AND bp_initiative.archived IS NULL', 'left')
            ->join('ac_mapping', 'sales_forecast.module = ac_mapping.product_segment AND ac_mapping.archived IS NULL', 'left')
            ->where('customer_program.archived', null);
        if (strtoupper($data['sub_bu']) == "K10") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "K%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "S%"', 'left');
        }
        return $this->db->get()->result_array();
    }

    public function customer_program($data)
    {
        $val = [
            "rbsi"      => "COALESCE(customer_program.rbsi, 0)",
            "adb_sales" => "COALESCE(customer_program.adb, 0)",
            "digital"   => "COALESCE(customer_program.digital, 0)",
        ];
        $value = $val;

        $columns = [
            "bu"                          => "customer_master.bu_code",
            "sub_business_unit"           => "customer_program.business_unit",
            "region"                      => "customer_master.region",
            "ma"                          => "customer_master.ma_code",
            "customer_code"               => "customer_master.school_code",
            "ramco_customer_code"         => "customer_master.ramco_code",
            "customer_name"               => "customer_master.school_name",
            "market_segment"              => "customer_master.market_segmentation",
            "customer_objective"          => "customer_master.customer_objective",
            "cost_center_unit"            => "cost_center.cc_unit",
            "desc"                        => "cost_center.description_1",
            "b2b_b2c"                     => "'B2B'",
            "expense_sub_category"        => "cost_center.sub_category",
            "account_code"                => "bp_initiative.account_code",
            "account_description"         => "bp_initiative.account_description",
            "initiative"                  => "sps_care.initiative",
            "total_previous_year_expense" => "sobi_direct_invoice.amount",
            "budget_source"               => "slspn_mapping.company",
            "total_bp_year_budget"        => "CASE
                                                  WHEN slspn_mapping.company = 'RBSI' THEN SUM(" . $value['rbsi'] . ")
                                                  WHEN slspn_mapping.company = 'ADB-SALES' THEN SUM(" . $value['adb_sales'] . ")
                                                  WHEN slspn_mapping.company = 'DIGITAL' THEN SUM(" . $value['digital'] . ")
                                              END",
            "month_of"                    => "customer_program.month_of",
            "parent_cc_unit"              => "cost_center.parent_cc_unit",
            "parent_cc_unit_description"  => "cost_center.description_2",
            "invoice_date"                => "sobi_direct_invoice.invoice_date",
        ];

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('customer_program.business_unit', $data['sub_bu']);
        }

        if (isset($data['sub_bu']) && $data['sub_bu'] != "") {
            $this->db->where('customer_program.business_unit', $data['sub_bu']);
        }
        if (isset($data['transaction_id']) && $data['transaction_id'] != "") {
            $this->db->where('customer_program.transaction_id', $data['transaction_id']);
        }

        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('customer_program')
            ->join('customer_master', 'customer_program.school_code = customer_master.school_code AND customer_master.archived IS NULL', 'left')
            ->join('cost_center', 'customer_program.expense_sub_category = cost_center.cc_unit AND cost_center.archived IS NULL', 'left')
            ->join('bp_initiative', 'cost_center.sub_category = bp_initiative.sub_category AND customer_program.initiative = bp_initiative.bp_initiative AND bp_initiative.archived IS NULL', 'left')
            ->join('sps_care', 'customer_program.initiative = sps_care.id AND cost_center.sub_category = sps_care.sub_category AND sps_care.archived IS NULL', 'left')
            ->join('sobi_direct_invoice', 'cost_center.cc_unit = sobi_direct_invoice.cost_center', 'left')
            ->where('customer_program.archived', null);
        if (strtoupper($data['sub_bu']) == "TMD") {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "T%"', 'left');
        } else {
            $this->db->join('slspn_mapping', 'customer_master.ma_code = slspn_mapping.ma_code AND slspn_mapping.nsm_code LIKE "L%"', 'left');
        }
        return $this->db->get()->result_array();
    }
}
