<?php

class Home_api extends MX_Controller
{
    private $transaction_details = [];
    private $month_of = "";
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('home_model');
        $this->load->model('notifications_model');
		$this->load->model('approval_notif_model');
        $this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list(["active" => true]);
		$time = strtotime(date("Y/m/d"));
		$final = strtolower(date("F", strtotime("+1 month", $time)));
        $this->month_of = $final;
	}

	public function _remap(){
		redirect('site/error');
    }

}