<?php

class Users extends MX_Controller{
	private $smodule;
	
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
		$this->load->module("site/template");

		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/sweetalert/sweetalert.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/sweetalert/sweetalert.min.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
		
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/datapicker/datepicker3.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/datapicker/bootstrap-datepicker.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/vendor/sweetalert2/sweetalert2.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/validate/jquery.validate.min.js","cache"=>false));

		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
	}
	
	function _remap($param) {
		if($param == "index"){
			$this->landing_page();
		}elseif($param == "import"){
			$this->import();
		}else{
			header('HTTP/1.0 404 not found');
		}
	}
	
	public function landing_page(){
		$acl = !is_null($this->session->userdata('role_functions')) ? $this->session->userdata('role_functions') : [];
		if(in_array('users_view',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/users/list","cache"=>false));
		}
		if(in_array('users_create',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/users/create","cache"=>false));
		}
		if(in_array('users_edit',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/users/edit","cache"=>false));
		}
		
		$header['header_data'] = "Users";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('users/landing_page');
		$this->template->adminFooterTpl();
	}

	public function import(){
		$this->app->use_js(array("source"=>"auth/get_api","cache"=>false));
		$this->app->use_js(array("source"=>"manage_users/users/import/list","cache"=>false));
		$this->app->use_js(array("source"=>"manage_users/users/import/add","cache"=>false));
		$header['header_data'] = "User Roles";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('users/import');
		$this->template->adminFooterTpl();
	}
}