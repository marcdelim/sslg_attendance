<?php
class Sslg_officers_model extends MY_Model{
        public function __construct(){
        parent::__construct();
    }

    public function list($data, $no_limit = false){
        $columns = [
            "id" => "sslg_officers.id",
            "full_name" => "sslg_officers.full_name",
            "position" => "sslg_officers.position",
            
        ];
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('sslg_officers')
        ;


        if(isset($data['filters']) AND !empty($data['filters'])){
            foreach($data['filters'] AS $key=>$val){
                if($val != ""){
                    $this->db->like($columns[$key], $val);
                }
            }
        }

        if(isset($data['order'])){
            foreach($data['order'] as $key => $val){
                $this->db->order_by($columns[$data['columns'][$val['column']]['data']]." ".$val['dir']);
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

        if (isset($data['length'])) {
            if($no_limit!=true){
                if($data['length'] != '-1'){
                    if(isset($data['start'])){
                        $this->db->limit($data['length'],$data['start']);	
                    }else{
                        $this->db->limit($data['length']);	
                    }
                }
            }
        }

        if(isset($data['id'])){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }elseif(isset($data['count_result']) AND $data['count_result'] === true){
            return $this->db->count_all_results();
        }elseif(isset($data['code'])){
            $this->db->where($columns['code'],$data['code']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function update($data,$condition){
        return $this->db->update('sslg_officers',$data,$condition);
    }

    public function update_batch($data){
        return $this->db->update_batch('sslg_officers',$data,'id');
    }

    public function delete($data){
        return $this->db->delete('sslg_officers',$data);
    }
    
    public function insert($data){
        return $this->db->insert_batch('sslg_officers',$data);
    }
}