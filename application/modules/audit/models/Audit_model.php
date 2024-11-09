<?php
class Audit_model extends MY_Model{
        public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        return $this->db->insert_batch('audit_logs',$data);
    }
}