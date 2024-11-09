<?php
class Maintenance_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function get_maintenance_value($data, $no_limit = false){
        $columns = [
            "id"                => "maintenance_value.id",
            "code"              => "maintenance_value.code",
            "maintenance_type"  => "maintenance_value.maintenance_type_code",
            "name"              => "maintenance_value.name",
            "description"       => "maintenance_value.description",
            "status"            => "IF(maintenance_value.archived IS NULL,'active','in_active')",
        ];

        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('maintenance_value')
        ;

        if(isset($data['with_inactive'])){
        }else{
            $this->db->where('maintenance_value.archived IS NULL',null,false);
        }

        if(isset($data['code']) AND $data['code'] != ""){
            $this->db->where('maintenance_value.code',$data['code']);
        }

        if(isset($data['maintenance_type_code']) AND $data['maintenance_type_code'] != ""){
            $this->db->where('maintenance_value.maintenance_type_code',$data['maintenance_type_code']);
        }

        if(isset($data['name'])){
            $this->db->where('maintenance_value.name',$data['name']);
        }

        if(isset($data['description'])){
            $this->db->where('maintenance_value.description',$data['description']);
        }

        if(isset($data['name'])){
            $this->db->where('maintenance_value.name',$data['name']);
        }

        if(isset($data['search']) && $data['search']!=null){
            $this->db->group_start();
            foreach($data['columns'] as $key => $val){
                if($key==0){
                $this->db->like($columns[$val['data']], $data['search']['value']);
                }else {
                $this->db->or_like($columns[$val['data']], $data['search']['value']);
                }
            }
            $this->db->group_end();
        }

      
        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
            $this->db->order_by($data['columns'][$val['column']]['data']." ".$val['dir']);
            }
        }
  
        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                    $this->db->limit($data['length'],$data['start']);	
                }
            }
        }

        if(isset($data['id']) and $data['id'] != ""){
            $this->db->where('id',$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }


    public function maintenance_type($data, $no_limit = false){
        $this->db
        ->select('*')
        ->from('maintenance_type')
        ->where('archived IS NULL',null,false)
        ;

        if(isset($data['search']) && $data['search']!=null){
            $this->db->group_start();
            foreach($data['columns'] as $key => $val){
                if($key==0){
                    $this->db->like($val['data'], $data['search']['value']);
                }else {
                    $this->db->or_like($val['data'], $data['search']['value']);
                }
            }
            $this->db->group_end();
        }
  
        
        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
                $this->db->order_by($data['columns'][$val['column']]['data']." ".$val['dir']);
            }
        }
    
        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                $this->db->limit($data['length'],$data['start']);	
                }
            }
        }

        if(isset($data['id']) AND $data['id'] != ""){
            $this->db->where('id',$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function update_maintenance_value($data){
        return $this->db->update_batch('maintenance_value',$data,'id');
    }

    public function add_maintenance_value($data){
        $this->db->insert('maintenance_value',$data);
        $id = $this->db->insert_id();
        return $this->get_maintenance_value(["id"=>$id]);
    }

    // public function get_product_segment($data){
    //     $this->db
    //     ->select('product_segment')
    //     ->from('item_master_maintenance')
    //     ->where('archived IS NULL',null,false)
    //     ->where('transaction_id',$data)
    //     ->group_by('product_segment')
    //     ;
    //     return $this->db->get()->result_array();
    // }

    // public function get_description($data){
    //     $this->db
    //     ->select('description,account_code')
    //     ->from('chart_of_accounts')
    //     ->where('archived IS NULL',null,false)
    //     ;
    //     if(isset($data['gd_desc'])){
    //         $this->db->where('transaction_id',$data['transaction_id']);
    //         $this->db->where('description',$data['gd_desc']);
    //         return $this->db->get()->row_array();
    //     }
    //     else {
    //         $this->db->where('transaction_id',$data);
    //         $this->db->group_by('description');
    //         return $this->db->get()->result_array();
    //     }
    // }
}