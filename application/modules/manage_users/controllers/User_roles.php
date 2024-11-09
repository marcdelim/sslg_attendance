<?php

class User_roles extends MX_Controller{
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

		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/sweetalert/sweetalert.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/sweetalert/sweetalert.min.js","cache"=>false));
		$this->app->use_js(array("source"=>"http://cdn.jsdelivr.net/npm/sweetalert2@11","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/validate/jquery.validate.min.js","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));

		$this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/toastr/toastr.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/toastr/toastr.min.js","cache"=>false));
    }
    
    function _remap($param) {
		if($param == "index"){
			$this->landing_page();
		}else{
			$this->user_roles($param);
		}
	}
	
	public function landing_page(){
		$acl = !is_null($this->session->userdata('role_functions')) ? $this->session->userdata('role_functions') : [];
		if(in_array('user_roles_view',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/user_roles/list","cache"=>false));
		}
		if(in_array('user_roles_create',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/user_roles/create","cache"=>false));
		}

		$header['header_data'] = "User Roles";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
		$this->load->view('user_roles/landing_page');
		$this->template->adminFooterTpl();
    }
    
    public function user_roles($param){
		 $acl = !is_null($this->session->userdata('role_functions')) ? $this->session->userdata('role_functions') : [];
		 if(in_array('user_roles_view',array_column($acl,'user_function'))){
		 	$this->app->use_js(array("source"=>"manage_users/user_roles/details/functions","cache"=>false));
		 }
		if(in_array('user_roles_edit',array_column($acl,'user_function'))){
			$this->app->use_js(array("source"=>"manage_users/user_roles/details/details","cache"=>false));
		 	$this->app->use_js(array("source"=>"manage_users/user_roles/details/edit_details","cache"=>false));
		 	$this->app->use_js(array("source"=>"manage_users/user_roles/details/add","cache"=>false));
		 	$this->app->use_js(array("source"=>"manage_users/user_roles/details/remove","cache"=>false));
	 	}

		$header['header_data'] = "User Roles";
		$this->template->adminHeaderTpl($header);
        $this->template->adminSideBarTpl();
        $aData['user_role_id'] = $param;
		$this->load->view('user_roles/details',$aData);
		$this->template->adminFooterTpl();
	}
}