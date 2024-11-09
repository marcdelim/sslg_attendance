<?php
class User_roles_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function user_roles_list($data, $no_limit = false){
        $columns = [
            "system_id" => "user_roles.id",
            "name" => "user_roles.name",
            "description" => "user_roles.description"
        ];
        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('user_roles')
        ->where('active',1)
        ;

        if(isset($data['search']) && $data['search']!=null){
            $this->db->group_start();
            foreach($data['columns'] as $key => $val){
                if(isset($columns[$val['data']])){
                    if($key==0){
                        $this->db->like($columns[$val['data']], $data['search']['value']);
                    }else {
                        $this->db->or_like($columns[$val['data']], $data['search']['value']);
                    }
                }
            }
            $this->db->group_end();
        }
      
        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
                $this->db->order_by($columns[$data['columns'][$val['column']]['data']]." ".$val['dir']);
            }
        }
    
        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                $this->db->limit($data['length'],$data['start']);	
                }
            }
        }

        if(isset($data['name']) AND $data['name'] != ""){
            $this->db->where('user_roles.name',$data['name']);
            return $this->db->get()->row_array();
        }
        elseif(isset($data['id']) AND $data['id'] != ""){
            $this->db->where('user_roles.id',$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function _functions($data, $no_limit = false){
        $columns = [
            "id" => "module_functions.id",
            "menu_name" => "menu.name",
            "menu_description" => "menu.description",
            "function_name" => "module_functions.name",
            "function_description" => "module_functions.description"
        ];

        
        if(isset($data['user_role_id']) AND $data['user_role_id'] != ""){
            $columns["role_function_id"] = "role_functions.id";
        }
        

        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('module_functions')
        ->join('menu','module_functions.menu_name=menu.name')
        ;

        if(isset($data['search']) && $data['search']!=null){
            $this->db->group_start();
            foreach($data['columns'] as $key => $val){
                if(isset($columns[$val['data']])){
                    if($key==0){
                        $this->db->like($columns[$val['data']], $data['search']['value']);
                    }else {
                        $this->db->or_like($columns[$val['data']], $data['search']['value']);
                    }
                }
            }
            $this->db->group_end();
        }
      
        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
                $this->db->order_by($columns[$data['columns'][$val['column']]['data']]." ".$val['dir']);
            }
        }
    
        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                $this->db->limit($data['length'],$data['start']);	
                }
            }
        }

        if(isset($data['show_available']) AND $data['show_available'] != ""){
            $this->db->join('role_functions','module_functions.id=role_functions.module_function_id and role_functions.user_role_id='.$data['show_available'].' ','left');
            $this->db->where('role_functions.id IS NULL',null,false);
        }

        if(isset($data['user_role_id']) AND $data['user_role_id'] != ""){
            $this->db->join('role_functions','module_functions.id=role_functions.module_function_id','left');
            $this->db->where('role_functions.user_role_id',$data['user_role_id']);
        }

        if(isset($data['validate']) AND !is_null($data['validate'])){
            $validate = $data['validate'];
            $this->db->join('role_functions','module_functions.id=role_functions.module_function_id','left');
            $this->db->where('role_functions.user_role_id',$validate['user_role_id']);
            $this->db->where('role_functions.module_function_id',$validate['module_function_id']);
            return $this->db->get()->row_array();
        }

        $res = $this->db->get()->result_array();
        return $res;
    }

    public function insert_role($data){
        return $this->db->insert('user_roles',$data);
    }

    public function insert_function($data){
        return $this->db->insert_batch('role_functions',$data);
    }

    public function remove_function($data){
        return $this->db->where('id',$data['id'])->delete('role_functions');
    }

    public function update_details($data){
        return $this->db->update_batch('user_roles',$data,'id');
    }
}