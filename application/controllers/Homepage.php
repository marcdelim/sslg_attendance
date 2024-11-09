<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MX_Controller {

   public function __construct()
   {
      parent::__construct();
   }
   public function index()
   {
      if(!$this->session->userdata('token')){
         echo modules::run("auth");
		}else{
         echo modules::run("home");
         // $landing_page = $this->session->userdata('user_role')['landing_page'];
         // if($landing_page != ""){
         //    redirect(site_url($landing_page));
         // }else{
         //    redirect(site_url('home'));
         // }
		}
   }
}