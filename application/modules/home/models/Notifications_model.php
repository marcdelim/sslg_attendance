<?php
class Notifications_model extends MY_Model{
	public function __construct(){
    parent::__construct();
  }

    public function evaluation_schedule($data, $no_limit = false){
        $columns = [
            "school_code"                           => "tbl_details.school_code",
            "evaluation_period"                     => "tbl_details.evaluation_period",
            "school_name"                           => "customer_master.school_name",
            "business_unit"                         => "customer_master.bu_code",
            "ma_code"                               => "customer_master.ma_code",
        ];
    
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from("(SELECT * FROM k12_details UNION ALL SELECT * FROM tmd_details UNION ALL SELECT * FROM lmd_details) tbl_details")
            ->join('customer_master','tbl_details.school_code=customer_master.school_code AND tbl_details.transaction_id=customer_master.transaction_id')
            ->where('tbl_details.transaction_id',$data['transaction_id'])
            ->where('tbl_details.school_code != 0',null,false)
        ;

        if(isset($data['evaluation_period']) AND $data['evaluation_period']){
            $this->db->where('tbl_details.evaluation_period',$data['evaluation_period']);
        }

        if(isset($data['sales_person_code']) AND !empty($data['sales_person_code'])){
            $this->db->where_in('customer_master.ma_code',$data['sales_person_code']);
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
        
        if(isset($data['id'])){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function program_schedule($data, $no_limit = false){
        $columns = [
            "school_code"                           => "customer_program.school_code",
            "schedule"                              => "customer_program.month_of",
            "school_name"                           => "customer_master.school_name",
            "business_unit"                         => "expense_account.business_unit",
            "sub_bu"                                => "IF(expense_account.sub_bu = '' ,'N/A',expense_account.sub_bu)",
            "revenue_target"                        => "(net_target.printed_amount+net_target.epub_amount+net_target.pdf_amount)",
            "exam_copy_distribution"                => "net_target.Product_Category_1",
            "initiative"                            => "expense_account.next_year_initiative",
            "ma_code"                               => "customer_master.ma_code",
        ];
    
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from("(SELECT * FROM k12_details UNION ALL SELECT * FROM tmd_details UNION ALL SELECT * FROM lmd_details) tbl_details")
            ->join('customer_master','tbl_details.school_code=customer_master.school_code AND tbl_details.transaction_id=customer_master.transaction_id')
            ->join("customer_program","customer_master.school_code=customer_program.school_code AND customer_master.transaction_id=customer_program.transaction_id AND tbl_details.evaluation_period=customer_program.month_of")
            ->join('expense_account','customer_program.initiative=expense_account.id')
            ->join('net_target','tbl_details.school_code=net_target.school_code AND tbl_details.transaction_id=net_target.transaction_id','left')
            ->where('customer_program.transaction_id',$data['transaction_id'])
        ;

        if(isset($data['schedule']) AND $data['schedule']){
            $this->db->where('tbl_details.evaluation_period',$data['schedule']);
        }

        if(isset($data['sales_person_code']) AND !empty($data['sales_person_code'])){
            $this->db->where_in('customer_master.ma_code',$data['sales_person_code']);
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
        
        if(isset($data['id'])){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function initiative($data, $no_limit = false){
        $columns = [
            "school_code"                           => "customer_program.school_code",
            "school_name"                           => "customer_master.school_name",
            "business_unit"                         => "customer_program.business_unit",
            "sub_bu"                                => "customer_program.business_unit",
            "month"                                 => "customer_program.month_of",
            "revenue_target"                        => "SUM(customer_program.rbsi + customer_program.adb + customer_program.digital)",
            "activity"                              => "'INITIATIVE'",
            "details"                               => "customer_program.initiative",
            "ma_code"                               => "customer_master.ma_code",
            "zone"                                  => "customer_master.zone",
        ];
        
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from('customer_program')
            ->join('customer_master','customer_program.school_code=customer_master.school_code AND customer_program.transaction_id=customer_master.transaction_id','left')
            // ->join('aop_targets','customer_master.ma_code=aop_targets.ma_code AND customer_master.transaction_id=aop_targets.transaction_id','left')
            ->where('customer_program.transaction_id',$data['transaction_id'])
            ->group_by(array('customer_program.initiative','customer_master.school_name'))
        ;

        if(isset($data['sales_person_code']) AND !empty($data['sales_person_code'])){
            $this->db->where_in('customer_master.ma_code',$data['sales_person_code']);
        }

        if(isset($data['bu']) AND $data['bu'] != ""){
            $this->db->where('customer_program.business_unit',$data['bu']);
        }

        if(isset($data['sub_bu']) AND $data['sub_bu'] != ""){
            $this->db->where('customer_program.sub_bu',$data['sub_bu']);
        }

        if(isset($data['region']) AND !empty($data['region'])){
            $this->db->where('customer_master.region',$data['region']);
        }

        if(isset($data['schedule']) AND $data['schedule']){
            $this->db->where('customer_program.month_of',$data['schedule']);
        }
        
        if(isset($data['slspn_code']) AND $data['slspn_code'] != ""){
            $this->db->where($columns['ma_code'],$data['slspn_code']);
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
                if(isset($columns[$val['data']]) && $val['data'] != "revenue_target"){
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
        }else{
            return $this->db->get()->result_array();
        }
    }

    public function exam_copy($data, $no_limit = false){
        $columns = [
            "school_code"                           => "customer_master.school_code",
            "school_name"                           => "customer_master.school_name",
            "business_unit"                         => "customer_master.bu_code",
            "sub_bu"                                => "IF(net_target.sub_bu = '' ,'N/A',net_target.sub_bu)",
            "revenue_target"                        => "(net_target.printed_amount+net_target.epub_amount+net_target.pdf_amount)",
            "activity"                              => "'EXAM COPY'",
            "details"                               => "net_target.Product_Category_1",
            "ma_code"                               => "customer_master.ma_code",
            "region"                                => "customer_master.region",
        ];
    
        $this->db
            ->select($this->common->arr_value_as_key($columns))
            ->from("(SELECT * FROM k12_details UNION ALL SELECT * FROM tmd_details UNION ALL SELECT * FROM lmd_details) tbl_details")
            ->join('customer_master','tbl_details.school_code=customer_master.school_code AND tbl_details.transaction_id=customer_master.transaction_id')
            ->join('net_target','tbl_details.school_code=net_target.school_code AND tbl_details.transaction_id=net_target.transaction_id','left')
            ->where('net_target.transaction_id',$data['transaction_id'])
            ->where('net_target.exam_copy > 0',null,false)
            ->where($columns['revenue_target'].' > 0',null,false)
        ;

        if(isset($data['schedule']) AND $data['schedule']){
            $this->db->where('tbl_details.evaluation_period',$data['schedule']);
        }

        if(isset($data['sales_person_code']) AND !empty($data['sales_person_code'])){
            $this->db->where_in('customer_master.ma_code',$data['sales_person_code']);
        }

        if(isset($data['bu']) AND $data['bu'] != ""){
            $this->db->where('customer_master.bu_code',$data['bu']);
        }

        if(isset($data['sub_bu']) AND $data['sub_bu'] != ""){
            $this->db->where('net_target.sub_bu',$data['sub_bu']);
        }

        if(isset($data['region']) AND !empty($data['region'])){
            $this->db->where('customer_master.region',$data['region']);
        }
        
        if(isset($data['slspn_code']) AND $data['slspn_code'] != ""){
            $this->db->where($columns['ma_code'],$data['slspn_code']);
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
        
        if(isset($data['id'])){
            $this->db->where($columns['id'],$data['id']);
            return $this->db->get()->row_array();
        }else{
            return $this->db->get()->result_array();
        }
    }
    
}