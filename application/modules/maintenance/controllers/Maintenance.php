<?php

class Maintenance extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
        $this->load->module("site/template");
        
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/validate/jquery.validate.min.js","cache"=>false));
	}

	function _remap($param) {
		if($param === "general"){
			$this->general();
		}elseif($this->load->module($param . '/' . $param)){
			$this->$param->index();
		}else{
			redirect('site/error');
			exit();
		}
    }
	
	public function general(){
        $this->app->use_js(array("source"=>"maintenance/general_maintenance/maintenance_type","cache"=>false));
        $this->app->use_js(array("source"=>"maintenance/general_maintenance/maintenance_value","cache"=>false));
        $this->app->use_js(array("source"=>"maintenance/general_maintenance/search","cache"=>false));
        $this->app->use_js(array("source"=>"maintenance/general_maintenance/add_value","cache"=>false));
        $this->app->use_js(array("source"=>"maintenance/general_maintenance/edit_value","cache"=>false));
		
		$header['header_data'] = "Maintenance | General";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('general_maintenance/landing_page');
		$this->template->adminFooterTpl();
    }
}