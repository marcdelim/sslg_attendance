<?php
class Transactions_model extends MY_Model{
	public function __construct(){
		parent::__construct();
    }

    public function list($data, $no_limit = false){
        $columns = [
            "transaction_id"    => "transactions.id",
            "description"       => "transactions.description",
            "school_year"       => "transactions.school_year",
            "previous_year"     => "transactions.previous_year",
            "current_year"      => "transactions.current_year",
            "next_year"         => "transactions.next_year",
            "status_id"         => "transaction_status.id",
            "status"            => "maintenance_value.name",
            "status_code"       => "maintenance_value.code",
            "locked"            => "transaction_status.locked",
        ];
        $this->db
        ->select($this->common->arr_value_as_key($columns))
        ->from('transactions')
        ->join('transaction_status','transactions.id=transaction_status.transaction_id AND transaction_status.archived IS NULL')
        ->join('maintenance_value','transaction_status.status=maintenance_value.code AND maintenance_value.maintenance_type_code="transaction_status"','left')
        ;

        if(isset($data['filters']) AND !empty($data['filters'])){
            $this->db->group_start();
            foreach($data['filters'] AS $key=>$val){
                if($val != ""){
                    if($key==0){
                        $this->db->like($columns[$key], $val);
                    }else {
                        $this->db->or_like($columns[$key], $val);
                    }
                }
            }
            $this->db->group_end();
        }

        if(isset($data['status_code']) AND $data['status_code'] != ""){
            $this->db->where($columns['status_code'],$data['status_code']);
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

        if(isset($data['transaction_id']) AND $data['transaction_id'] != ""){
            $this->db->where($columns['transaction_id'],$data['transaction_id']);
            return $this->db->get()->row_array();
        }elseif(isset($data['active']) AND $data['active'] === true){
            $this->db->where($columns['status_code'],'active');
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function create_transaction($data){
        $this->db->insert('transactions',$data);
        return $this->db->insert_id();
    }

    public function create_transaction_status($data){
        return $this->db->insert('transaction_status',$data);
    }

    public function update_transaction($data){
        return $this->db->update_batch('transactions',$data,'id');
    }

    public function update_transaction_status($data){
        return $this->db->update_batch('transaction_status',$data,'id');
    }
}