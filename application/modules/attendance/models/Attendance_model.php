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

    public function update($data,$condition){
        return $this->db->update('attendance',$data,$condition);
    }

    public function fields(){
        return $this->db->query('SHOW COLUMNS FROM attendance')->result_array();
    }

    public function list($data, $no_limit = false){
        $columns = [
            "id" => "attendance.id",
            "sslg_officers_id" => "attendance.sslg_officers_id",
            "full_name" => "sslg_officers.full_name",
            "position" => "sslg_officers.position",
            "time_in" => "attendance.time_in",
            "time_out" => "attendance.time_out"
            
        ];
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('attendance')
            ->join('sslg_officers', 'sslg_officers.id  =  attendance.sslg_officers_id', 'left')
        ;

        if(isset($data['get_current_day_attendance'])){
            $this->db->like($columns['time_in'],date('Y-m-d'));
        }
       

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

        if(isset($data['start_date']) AND isset($data['end_date'])){
            $this->db->where("DATE(attendance.time_in) >=",$data['start_date']);
            $this->db->where("DATE(attendance.time_in) <=",$data['end_date']);
        }

        if(isset($data['id'])){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }else if(isset($data['check_today'])){
            $this->db->where($columns['sslg_officers_id'],$data['sslg_officers_id']);
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