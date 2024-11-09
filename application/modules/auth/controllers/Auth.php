<?php

class Auth extends MX_Controller
{
	private $smodule;
	public function __construct()
    {
		parent::__construct();
		$this->smodule = strtolower(__CLASS__);
		$this->load->module("core/app");
		$this->load->module("site/template");
	}
	
	public function index(){
		if($this->session->userdata('token')){
			redirect('');
		}else{
			$this->login();
		}
	}

	public function login(){
		$this->app->use_js(array("source"=>$this->smodule."/login","cache"=>false));
		$this->app->header($this->smodule.'/header');
		$this->app->content($this->smodule.'/login_view');
		$this->app->footer($this->smodule.'/footer');
	}

	public function force_change_password(){
		if(!$this->session->userdata('token')){
			redirect('');
		}
		$this->load->model('auth/login_model');
		$res = $this->login_model->getUserDetails($this->session->userdata('token'));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->smodule."/get_api","cache"=>false));
		$this->app->use_js(array("source"=>$this->smodule."/force_change_password","cache"=>false));
		$this->app->header($this->smodule.'/header');
		$this->app->content($this->smodule.'/force_change_password_view');
		$this->app->footer($this->smodule.'/footer');
	}

	public function logout(){
		$this->session->sess_destroy();
        redirect('');
	}
}