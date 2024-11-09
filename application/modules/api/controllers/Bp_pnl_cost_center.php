<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/modules/api/libraries/REST_Controller.php';

class Bp_pnl_cost_center extends REST_Controller
{
    private $transaction_details = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->module('core/app');
        $this->load->model('bp_pnl_model');
        $this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list([
            "active" => true
        ]);
    }

    public function index_get()
    {
        $data = $this->get();
        $data['transaction_id'] = $this->transaction_details['transaction_id'];
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
        $type = ["MARKETING", "SALES"];
        $arrData = [];
        // $this->common->vd($data);die();
        // foreach ($products as $key => $value) {
        $data['product'] = $value;
        $account_codes = ["gross_deliveries", "sales_returns", "sales_discounts", "cost_of_sales_and_services"];
        foreach($account_codes as $key=>$val){
            $data['account_code'] = $val;
            $arrTemp = $this->bp_pnl_model->sales_forecast_cost_center($data);
            $arrData = array_merge($arrData, $arrTemp);
        }
        
        // foreach($type as $key=>$val){
        //     $data['type'] = $val;
        //     $arrTemp = $this->bp_pnl_model->customer_program_cost_center($data);
        // }
        //}
        // $this->common->vd($this->db->last_query());die();
        // }
        $result['data'] = $arrData;
        $this->response($result, 200);
    }
}
