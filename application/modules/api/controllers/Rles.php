<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/modules/api/libraries/REST_Controller.php';

class Rles extends REST_Controller
{
    private $transaction_details = [];
	public function __construct()
	{
		parent::__construct();
        ini_set('memory_limit','-1');
		ini_set('max_execution_time',0);
		$this->load->module("core/app");
        $this->load->model('rles_model');
        $this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list(["active" => true]);
        
	}

    public function index_get(){
        $data = $this->get();
        $data["transaction_id"] = $this->transaction_details['transaction_id'];
        $result['data'] = $this->rles_model->list($data);
        
        if(isset($data['recordsTotal']) AND $data['recordsTotal'] === "true"){
            $result['recordsTotal'] = count($result['data']);
        }
        if(isset($data['recordsFiltered']) AND $data['recordsFiltered'] === "true"){
            $result['recordsFiltered'] = count($this->rles_model->list($data,true));
        }
        $this->response($result, 200);
	}
}