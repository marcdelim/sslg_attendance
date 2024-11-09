<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/modules/api/libraries/REST_Controller.php';

class Evaluation extends REST_Controller
{
    private $transaction_details = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->module("core/app");
        $this->load->model('evaluation_model');
        $this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list(["active" => true]);
	}

    public function index_get(){
        $data = $this->get();
        $data["transaction_id"] = $this->transaction_details['transaction_id'];
        $result['data'] = $this->evaluation_model->evaluation($data);
        // $this->common->vd($this->db->last_query());die();
        if(isset($data['recordsTotal']) AND $data['recordsTotal'] === "true"){
            $result['recordsTotal'] = count($result['data']);
        }
        if(isset($data['recordsFiltered']) AND $data['recordsFiltered'] === "true"){
            $result['recordsFiltered'] = count($this->evaluation_model->evaluation($data,true));
        }
        $this->response($result, 200);
	}
}