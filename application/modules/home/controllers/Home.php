<?php
class Home extends MX_Controller{
	private $smodule;
	private $transaction_details = [];
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
		$this->load->model('transactions/transactions_model');
        $this->transaction_details = $this->transactions_model->list(["active" => true]);

		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'site/helper/tableHelper.js',"cache"=>false));
	}

	public function index(){
		$header['header_data'] = "Home";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$aData = [];
		$this->load->view('landing_page',$aData);
		$this->template->adminFooterTpl();
	}
}