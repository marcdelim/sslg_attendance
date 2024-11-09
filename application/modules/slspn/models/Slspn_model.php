<?php
class Slspn_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function create_tbl(){
        return $this->db->query('CREATE TABLE IF NOT EXISTS `slspn_mapping`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `business_unit` VARCHAR(100) NOT NULL,
            `ma_code` VARCHAR(100) NOT NULL,
            `ma_id` INT NOT NULL,
            `rsm_bu` VARCHAR(100) NOT NULL,
            `rsm_code` VARCHAR(100) NOT NULL,
            `rsm_id` INT NOT NULL,
            `nsm_code` VARCHAR(100) NOT NULL,
            `nsm_id` INT NOT NULL,
            PRIMARY KEY(`id`)
        ) ENGINE = InnoDB;');
    }

    public function clear_data(){
        return $this->db->truncate('slspn_mapping');
    }

    public function insert_slspn($data){
        return $this->db->insert_batch("slspn_mapping",$data);
    }

    public function slspn($data, $no_limit = false){
        $columns = [
            "business_unit" => "slspn_mapping.business_unit",
            "ma_code" => "slspn_mapping.ma_code",
            "ma_id" => "slspn_mapping.ma_id",
            "rsm_bu" => "slspn_mapping.rsm_bu",
            "rsm_code" => "slspn_mapping.rsm_code",
            "rsm_id" => "slspn_mapping.rsm_id",
            "nsm_code" => "slspn_mapping.nsm_code",
            "nsm_id" => "slspn_mapping.nsm_id",
            "region" => "slspn_mapping.region",
        ];
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('slspn_mapping')
        ;

        if(isset($data['business_unit']) AND !empty($data['business_unit'])){
            $this->db->like($columns['business_unit'],$data['business_unit']);
        }

        if(isset($data['business_unit_tmd']) AND !empty($data['business_unit_tmd'])){
            $this->db->like($columns['business_unit'],$data['business_unit_tmd']);
            $this->db->or_like($columns['business_unit'],$data['business_unit_lmd']);
        }

        if(isset($data['unique']) AND !empty($data['unique'])){
            $this->db->group_by('slspn_mapping.ma_code');
        }

        if(isset($data['ma_code'])){
            $this->db->where($columns['ma_code'],$data['ma_code']);
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

        return $this->db->get()->result_array();
    }

    public function ma_list(){
        $columns = [
            
            "sales_person_code" => "slspn_mapping.ma_code",
            "fullname" => "slspn_mapping.full_name",
        ];
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('slspn_mapping')
            ->group_by('ma_code')
            ->order_by('ma_code')
        ;


        return $this->db->get()->result_array();
    }
}