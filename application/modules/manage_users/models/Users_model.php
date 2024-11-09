<?php
class Users_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function user_list($data, $no_limit = false){
        $columns = [
            "user_id"           => "users.id",
            "role"              => "user_roles.description",
            "role_id"           => "users.role_id",
            "role_name"         => "user_roles.name",
            "username"          => "users.username",
            "fullname"          => "users.fullname",
            "first_name"        => "users.first_name",
            "middle_name"       => "users.middle_name",
            "last_name"         => "users.last_name",
            "position_name"     => "users.position_name",
            "position_code"     => "users.position_code",
            "department_name"   => "users.department_name",
            "department_code"   => "users.department_code",
            "company_name"      => "users.company_name",
            "company_code"      => "users.company_code",
            "employee_status"   => "users.employee_status",
            "email_address"     => "users.email_address",
            "date_created"      => "users.date_created",
            "expiration_date"   => "users.expiration_date",
            "employee_no"   => "users.employee_no",
            "region"   => "users.region",
            "sales_person_code"   => "users.sales_person_code",
            "slspn_bu"   => "users.slspn_bu",
            "module"   => "users.module",
            
        ];
        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('users')
        ->join('user_roles','users.role_id=user_roles.id','left')
        ;

        if(isset($data['ma_codes']) AND !empty($data['ma_codes'])){
            $this->db->where_in('users.sales_person_code',$data['ma_codes']);
        }

        if(isset($data['with_slspn']) AND $data['with_slspn'] === true){
            $this->db->where($columns['sales_person_code'].' IS NOT NULL',null,false);
        }

        if(isset($data['user_role'])){
            $this->db->where_in($columns['role_name'],$data['user_role']);
        }

        if(isset($data['filters']) AND !empty($data['filters'])){
            foreach($data['filters'] AS $key=>$val){
                if($val != ""){
                    if(in_array($key,['slspn_bu'])){
                        $slspn_bu = explode(",", $val);
                        $this->db->group_start();
                        foreach($slspn_bu AS $buKey=>$buVal){
                            if($buKey == 0){
                                $this->db->like($columns[$key], $buVal);
                            }else{
                                $this->db->or_like($columns[$key], $buVal);
                            }
                        }
                        $this->db->group_end();
                    }else{
                        $this->db->like($columns[$key], $val);
                    }
                }
            }
        }

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

        if(isset($data['username']) AND $data['username'] != ""){
            $this->db->where('users.username',$data['username']);
            return $this->db->get()->row_array();
        }elseif(isset($data['sales_person_code']) AND $data['sales_person_code'] != ""){
            $this->db->where('users.sales_person_code',$data['sales_person_code']);
            return $this->db->get()->row_array();
        }elseif(isset($data['user_id']) AND $data['user_id'] != ""){
            $this->db->where('users.id',$data['user_id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function add_user($data){
        return $this->db->insert('users',$data);
    }

    public function update_user($data){
        return $this->db->update_batch('users',$data,'id');
    }

    public function add_user_batch($data){
        return $this->db->insert_batch('users',$data);
    }

    public function users_fields(){
        return $this->db->query('SHOW COLUMNS FROM users')->result_array();
    }
}