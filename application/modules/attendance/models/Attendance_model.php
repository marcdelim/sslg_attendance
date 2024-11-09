<?php
class Attendance_model extends MY_Model{
        public function __construct(){
        parent::__construct();
    }

    
    public function insert($data){
        return $this->db->insert_batch('attendance',$data);
    }

    public function insert_data($data){
        $this->db->insert('attendance', $data);
        $insert_id = $this->db->insert_id();
     
        return  $insert_id;
    }

    public function fields(){
        return $this->db->query('SHOW COLUMNS FROM attendance')->result_array();
    }

    public function list($data, $no_limit = false){
        $columns = [
            "id" => "attendance.id",
            "name" => "attendance.name",
            "position" => "attendance.position",
            "time_in" => "attendance.time_in",
            "time_out" => "attendance.time_out",
            "file_name_in" => "attendance.file_name_in",
            "file_name_out" => "attendance.file_name_out",
            
        ];
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('attendance')
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
}