<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/modules/api/libraries/REST_Controller.php';

class Bp_pnl_customer_program extends REST_Controller
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
        //$arrData = $this->bp_pnl_model->customer_program($data);
        $arrData[]=[];
        $result['data'] = $arrData;
        $this->response($result, 200);
    }
}
