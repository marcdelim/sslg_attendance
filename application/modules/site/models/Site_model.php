<?php

class Site_Model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }
   
   public function get_menu($role_id){
	   $res_a = $this->db
	   ->select('menu.*')
	   ->from('menu')
	   ->join('module_functions','menu.name=module_functions.menu_name')
	   ->join('role_functions','module_functions.id=role_functions.module_function_id')
	   ->where('role_functions.user_role_id',$role_id)
	   ->where('menu.status',0)
	   ->group_by('menu.id')
	   ->get()->result_array();
	   ;

	   if($res_a){
			$res_b = $this->db
			->select('*')
			->from('menu')
			->where_in('id',array_column($res_a,'parent'))
			->get()->result_array()
			;

			return array_merge($res_a,$res_b);
	   }else{
		   return false;
	   }
   }

   public function get_menu_functions($menu_id){
	   return $this->db
	   ->select('menu_functions.function_id AS function_id,module_functions.name AS name')
	   ->from('menu')
	   ->join('menu_functions','menu.id=menu_functions.menu_id','left')
	   ->join('module_functions','menu_functions.function_id=module_functions.id','left')
	   ->where('menu.id',$menu_id)
	   ->get()->result_array();
   }
	
}