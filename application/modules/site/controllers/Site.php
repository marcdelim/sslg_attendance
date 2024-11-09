<?php

class Site extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
	}

	public function index(){
        $this->load->module("core/app");
        $this->load->view('maintenance_page');
	}
}