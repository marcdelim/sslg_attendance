<?php

class Template extends MX_Controller {

	private $smodule;
	public $enable_page_heading = false;
	public $enable_page_breadcrumbs = false;
	protected $system_name = "";
	
	public function __construct(){
      parent::__construct();
      $this->smodule = 'site';
        
      	$this->load->module("core/app");
		$this->system_name = $this->config->item('site')['system_name'];


		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/bootstrap.min.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/font-awesome/css/font-awesome.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/animate.css","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path.$this->smodule."/css/style.css","cache"=>false));

		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/jquery-3.1.1.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/popper.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/bootstrap.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/plugins/metisMenu/jquery.metisMenu.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/plugins/slimscroll/jquery.slimscroll.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/inspinia.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.$this->smodule.'/js/plugins/pace/pace.min.js',"cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path.'core/js/core.js',"cache"=>false));
    }
	
	public function _remap(){
      redirect('site/error');
    }
	
	/* Admin Templates */
	
	public function adminHeaderTpl($header_data=NULL){
		$this->sessionChecker();
		$header_data['sys_name'] = $this->system_name;
		$this->app->header($this->smodule.'/layout/default/header',$header_data);
	}
	
	public function adminSideBarTpl($aData=NULL){
		$this->load->config('menu');
		$aData['active'] = $this->uri->segment(1);
		$this->load->helper('site');
		$this->load->model('site_model');
		$profile = $this->session->userdata('profile');
		$user_role_id = $this->session->userdata('user_role')['id'];
		$aData['user_profile']["tut_name"] = $profile['last_name'].", ".$profile['first_name'];

		$menu = $this->site_model->get_menu($user_role_id);

		if($menu){
			$aData['menu'] = $this->menu_builder($menu);
		}else{
			$aData['menu'] = "";
		}
		
		$this->app->content($this->smodule.'/layout/default/sidebar',$aData);
	}
	
	public function adminFooterTpl($aData=NULL){
		$this->app->footer($this->smodule.'/layout/default/footer',$aData);
	}

	public function sessionChecker(){
		if(!$this->session->userdata('token')){
			redirect('auth');
		}else{
			$session = $this->session->userdata();
			if(isset($session['default_password']) AND $session['default_password'] == true){
				redirect(base_url('auth/force_change_password'));
			}

			if($this->config->item('site')['maintenace_mode'] == true AND $this->session->userdata('admin_privilege') === false){
				redirect('site');
			}
		}
		
	}

	public function menu_builder($data){
		array_multisort(array_column($data,'order_index'), SORT_ASC, $data);
		$arrMenu = [];
		$arrTmp = [
			"level_1" => [],
			"level_2" => [],
			"level_3" => [],
		];
		$menuHTML = "";

		foreach($data AS $Key=>$Val){
			$level = "level_".$Val['level'];
			if(!in_array($Val['id'],array_column($arrTmp[$level],"id"))){
				$arrTmp[$level][] = $Val;
			}
		}
		
		foreach($arrTmp['level_3'] AS $aKey=>$aVal){
			$module = $this->uri->segment(1);
			$controller = $this->uri->segment(2);
			$method = $this->uri->segment(3);
			$i = array_search($aVal['parent'],array_column($arrTmp['level_2'], "id"));
			$arrTmp['level_2'][$i]['child'][] = $aVal;
		}

		foreach($arrTmp['level_2'] AS $aKey=>$aVal){
			$module = $this->uri->segment(1);
			$controller = $this->uri->segment(2);
			$method = $this->uri->segment(3);
			$i = array_search($aVal['parent'],array_column($arrTmp['level_1'], "id"));
			$arrTmp['level_1'][$i]['child'][] = $aVal;
		}

		$arrMenu = $arrTmp['level_1'];
		foreach($arrMenu as $mKey=>$mVal){
			$module = $this->uri->segment(1);
			$controller = $this->uri->segment(2);
			$method = $this->uri->segment(3);
			if(isset($mVal['child'])){
				$menuHTML .= '<li class="'.($module == $mVal['name'] ? "active" : "").'">';
					$menuHTML .= '<a href="#"><i class="fa '.$mVal['icon'].'"></i> <span class="nav-label">'.$mVal['label_display'].'</span> <span class="fa arrow"></span></a>';
					$menuHTML .= '<ul class="nav nav-second-level">';
					foreach($mVal['child'] as $mcKey=>$mcVal){
						$menuHTML .= '<li class="'.($controller == $mcVal['controller_name'] ? "active" : "" ).'"><a href="'.base_url($mVal['url'].$mcVal['url']).'">'.$mcVal['label_display'].'</a></li>';
					}
					$menuHTML .= '</ul>';
				$menuHTML .= '</li>';
			}else{
				$menuHTML .= '<li '.($module == $mVal['name'] ? "class='active'" : "" ).'><a href="'.base_url($mVal['url']).'"><i class="fa '.$mVal['icon'].'"></i> <span class="nav-label">'.$mVal['label_display'].'</span></a></li>';
			}
		}
		return $menuHTML;
	}

	public function acl($menu_id){
		$arrData = [];
		$this->load->model('site_model');
		$menu_functions = $this->site_model->get_menu_functions($menu_id);
		$role_function = array_column($this->session->userdata('role_functions'), 'module_function_id');

		foreach($menu_functions AS $key=>$val){
			if(in_array($val['function_id'], $role_function)){
				$arrData[$val['name']] = true;
			}else{
				$arrData[$val['name']] = false;
			}
		}
		return $arrData;
	}
}
