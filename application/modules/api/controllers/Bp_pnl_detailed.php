<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/modules/api/libraries/REST_Controller.php';

class Bp_pnl_detailed extends REST_Controller
{
    private $transaction_details = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->module('core/app');
        $this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list([
            "active" => true
        ]);
        $this->load->model('bp_pnl_model');
    }

    public function index_get()
    {
        $paramData = $this->get();
        $sets = array(
            array(
                    "sub_bu"            => $paramData['sub_bu'],
                    "product_format"    => $paramData['product_format'],
                    "product"           => $paramData['product'],
                    "transaction_id"    => $this->transaction_details['transaction_id']
                ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "printed",
            //     "product"           => "SELLING_COMPLI",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "printed",
            //     "product"           => "TRM",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "printed",
            //     "product"           => "EVAL_COPY",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "digital",
            //     "product"           => "SELLING_COMPLI",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "digital",
            //     "product"           => "TRM",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "TMD",
            //     "product_format"    => "digital",
            //     "product"           => "EVAL_COPY",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "printed",
            //     "product"           => "SELLING_COMPLI",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "printed",
            //     "product"           => "TRM",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "printed",
            //     "product"           => "EVAL_COPY",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "digital",
            //     "product"           => "SELLING_COMPLI",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "digital",
            //     "product"           => "TRM",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),
            // array(
            //     "sub_bu"            => "LMD",
            //     "product_format"    => "digital",
            //     "product"           => "EVAL_COPY",
            //     "transaction_id"    => $this->transaction_details['transaction_id']
            // ),

        );

        $detailed_array = [];
        foreach ($sets as $key => $data) {
            $monthly_skewing = $this->bp_pnl_model->monthly_skewing([
                "sub_bu"         => $data['sub_bu'], 
                "transaction_id" => $data['transaction_id'],
            ]);
            if ($monthly_skewing) {
                foreach ($monthly_skewing as $key => $value) {
                    $data['january'] = $value['january'];
                    $data['february'] = $value['february'];
                    $data['march'] = $value['march'];
                    $data['april'] = $value['april'];
                    $data['may'] = $value['may'];
                    $data['june'] = $value['june'];
                    $data['july'] = $value['july'];
                    $data['august'] = $value['august'];
                    $data['september'] = $value['september'];
                    $data['october'] = $value['october'];
                    $data['november'] = $value['november'];
                    $data['december'] = $value['december'];
                }
            } else {
                exit('No monthly skewing records for ' . strtoupper($data['sub_bu']) . ' found!');
            }
            $account_code = ["4010001", "4010002", "4010003", "4010004", "4010005", "4010006", "4010008"];
            // if ($paramData['group_by'] == "sales_forecast.id") {
            //     $data['group_by'] = "sales_forecast.id";
            //     $detailed = $this->bp_pnl_model->detailed_sales_forecast($data);
            // } else {
            //     $data['group_by'] = "customer_program.id";
            //     $detailed = $this->bp_pnl_model->detailed_customer_program($data);
            // }
            $data['group_by'] = "sales_forecast.id";
            $detailed = $this->bp_pnl_model->detailed_sales_forecast($data);
            foreach ($detailed as $key => $value) {
                foreach ($account_code as $aKey => $aVal) {
                    $column_name = 'selling_' . $aVal;
                    $detailed[$key][$column_name] = 0;

                    $column_name = 'marketing_' . $aVal;
                    $detailed[$key][$column_name] = 0;

                    for ($count = 1; $count <= 12; $count++) {
                        $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                        $column_name = $month . '_selling_' . $aVal;
                        $detailed[$key][$column_name] = 0;

                        $column_name = $month . '_marketing_' . $aVal;
                        $detailed[$key][$column_name] = 0;
                    }
                }
                if(strtoupper($data['sub_bu']) == "TMD"){
                    $detailed[$key]['gross_deliveries_ac'] = '4010004';
                }else{
                    $detailed[$key]['gross_deliveries_ac'] = '4010003';
                }
                if(strtoupper($detailed[$key]['sub_category']) == 'MARKETING'){
                    //$detailed[$key]['marketing'] = $detailed[$key]['gross_revenue'];
                    $detailed[$key]['marketing'] = 0;
                    $detailed[$key]['selling'] = 0;
                   
                    
                    if(strtoupper($data['sub_bu']) == "TMD"){
                        $detailed[$key]['marketing_4010004'] = $detailed[$key]['gross_revenue'];
                        for ($count = 1; $count <= 12; $count++) {
                            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                            $column_name = $month . '_marketing_4010004';
                            //$detailed[$key][$column_name] =  $detailed[$key][$column_name] * $data[$month];
                            $detailed[$key][$column_name] = 0;
                        }
                    }else{
                        $detailed[$key]['marketing_4010003'] = $detailed[$key]['gross_revenue'];
                        for ($count = 1; $count <= 12; $count++) {
                            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                            $column_name = $month . '_marketing_4010003';
                            $detailed[$key][$column_name] =  $detailed[$key][$column_name] * $data[$month];
                           
                        }
                    }
                }else if(strtoupper($detailed[$key]['sub_category']) == 'SALES'){
                    //$detailed[$key]['selling'] = $detailed[$key]['gross_revenue'];
                    $detailed[$key]['selling'] = 0;
                    $detailed[$key]['marketing'] = 0;
                    if(strtoupper($data['sub_bu']) == "TMD"){
                        $detailed[$key]['selling_4010004'] = $detailed[$key]['gross_revenue'];
                        for ($count = 1; $count <= 12; $count++) {
                            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                            $column_name = $month . '_selling_4010004';
                            //$detailed[$key][$column_name] =  $detailed[$key][$column_name] * $data[$month];
                            $detailed[$key][$column_name] = 0;
                        }
                    }else{
                        $detailed[$key]['selling_4010003'] = $detailed[$key]['gross_revenue'];
                        for ($count = 1; $count <= 12; $count++) {
                            $month = strtolower(date("F", mktime(0, 0, 0, $count, 10)));
                            $column_name = $month . '_selling_4010003';
                            //$detailed[$key][$column_name] =  $detailed[$key][$column_name] * $data[$month];
                            $detailed[$key][$column_name] = 0;
                        }
                    }
                } else{
                    $detailed[$key]['selling'] = 0;
                    $detailed[$key]['marketing'] = 0;
                }             
            }
            $detailed_array = array_merge($detailed_array, $detailed);
        }
        $result['data'] = $detailed_array;
        $this->response($result, 200);
    }
}
