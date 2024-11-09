<?php

class Transactions extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");
	}

	function _remap($param) {
        if($param == "index"){
            $this->landing_page();
        }else{
            // 404
        }
	}
	
	public function landing_page(){
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/moment/min/moment.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/datetimepicker/bootstrap-datetimepicker.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/datetimepicker/bootstrap-datetimepicker.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/select2/css/select2.min.css","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->smodule."/landing_page","cache"=>false));
		$this->app->use_js(array("source"=>$this->smodule."/create","cache"=>false));
		$this->app->use_js(array("source"=>$this->smodule."/edit","cache"=>false));
		$header['header_data'] = "Transactions";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('landing_page');
		$this->template->adminFooterTpl();
    }
}