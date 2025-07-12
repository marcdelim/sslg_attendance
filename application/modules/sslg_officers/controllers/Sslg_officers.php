<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sslg_officers extends MX_Controller{
	private $smodule;
	private $transaction = [];
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
        $this->load->module("site/template");
        
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/select2/css/select2.min.css","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/helper/getCurrentDate.js","cache"=>false));
	}
    
	public function index(){
        $this->app->use_js(array("source"=>$this->smodule."/list","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/add","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/edit","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/delete","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/delete_all","cache"=>false));
        
		$header['header_data'] = "Cost Center";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('landing_page');
		$this->template->adminFooterTpl();
    }

}