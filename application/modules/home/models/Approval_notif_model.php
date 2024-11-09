<?php
class Approval_notif_model extends MY_Model{

    public function __construct(){
		parent::__construct();
    }

    public function get_calendar($data,$module){
        $columns = [
            "region"        =>"rsm_calendar.region",
            "nsm_code"      =>"rsm_calendar.nsm_code",
            "date_start"    =>"rsm_calendar.date_start",
            "date_end"      =>"rsm_calendar.date_end",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('rsm_calendar');
        $this->db->where('region', $data);
        if($module=="tmd"){
            $this->db->where('nsm_code', 'TNSM');
        }
        else{
            $this->db->where('nsm_code', 'LNSM');
        }
        
        return $this->db->get()->row_array();
    }

    public function get_ma_list($data){
        $columns = [
            "ma_code"        =>"slspn_mapping.ma_code",
            "rsm_code"       =>"slspn_mapping.rsm_code",
            "rsm_name"       =>"users.fullname",
            "region"          =>"slspn_mapping.region",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('slspn_mapping');
        $this->db->join('users','slspn_mapping.rsm_code = users.sales_person_code');
        if(isset($data['nsm_code']) && !empty($data['nsm_code'])){
            $this->db->where('nsm_code', $data['nsm_code']);
        }
        if(isset($data['module']) && !empty($data['module'])){
            $this->db->like('business_unit', $data['module']);
        }
        if(isset($data['rsm_code']) && !empty($data['rsm_code'])){
            $this->db->where('rsm_code', $data['rsm_code']);
        }
        

        return $this->db->get()->result_array();
    }

    public function get_ma_list_email($data){
        $columns = [
            "ma_code"        =>"slspn_mapping.ma_code",
            "rsm_code"       =>"slspn_mapping.rsm_code",
            "nsm_code"       =>"slspn_mapping.nsm_code",
            "rsm_name"       =>"users.fullname",
            "region"         =>"slspn_mapping.region",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('slspn_mapping');
        $this->db->join('users','slspn_mapping.rsm_code = users.sales_person_code');
        if(isset($data['nsm_code']) && !empty($data['nsm_code'])){
            $this->db->where('nsm_code', $data['nsm_code']);
        }
        if(isset($data['module']) && !empty($data['module'])){
            $this->db->like('business_unit', $data['module']);
        }
        if(isset($data['rsm_code']) && !empty($data['rsm_code'])){
            $this->db->where('rsm_code', $data['rsm_code']);
        }
        if(isset($data['module']) && !empty($data['module']) && $data['module'] == "LMD"){
            $this->db->where('nsm_code', "LNSM");
        }
        else if(isset($data['module']) && !empty($data['module']) && $data['module'] == "TMD"){
            $this->db->where('nsm_code', "TNSM");
        }
        if(isset($data['type']) && !empty($data['type']) && $data['type'] == "sendmail_rsm"){
            $this->db->group_by('region');
        }
        else{
            $this->db->group_by('nsm_code');
        }
        

        return $this->db->get()->result_array();
    }


    public function insert_email($data){
        return $this->db->insert('email_checker_tbl',$data);
    }

    public function email_checker($data){
        $columns = [
            "ma_code"        =>"email_checker_tbl.ma_code",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('email_checker_tbl');
        $this->db->where('archived is null');
        if(isset($data['ma_code']) && !empty($data['ma_code'])){
            $this->db->where_in('ma_code', $data['ma_code']);
        }
        if(isset($data['transaction_id']) && !empty($data['transaction_id'])){
            $this->db->where('transaction_id', $data['transaction_id']);
        }
        return $this->db->get()->row_array();
    }

    public function get_approved_list($data){
        $columns = [
            "ma_code"        =>"rsm_approval.ma_code",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('rsm_approval');
        $this->db->where('archive is null');
        $this->db->where('status','Approved');
        if(isset($data['ma_list']) && !empty($data['ma_list'])){
            $this->db->where_in('ma_code', $data['ma_list']);
        }
        if(isset($data['module']) && !empty($data['module'])){
            $this->db->where_in('segment', $data['module']);
        }
        return $this->db->get()->result_array();
    }

    public function get_approved_list_rsm($data){
        $columns = [
            "region"        =>"nsm_approval.region",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('nsm_approval');
        $this->db->where('archive is null');
        $this->db->where('status','Approved');
        if(isset($data['region']) && !empty($data['region'])){
            $this->db->where_in('region', $data['region']);
        }
        if(isset($data['module']) && !empty($data['module'])){
            $this->db->where_in('segment', $data['module']);
        }
        return $this->db->get()->result_array();
    }

    public function get_calendar_nsm($data){
        $columns = [
            "nsm_code"      =>"nsm_calendar.nsm_code",
            "date_start"    =>"nsm_calendar.date_start",
            "date_end"      =>"nsm_calendar.date_end",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('nsm_calendar');
        $this->db->where('nsm_code', $data);

        return $this->db->get()->row_array();
    }

    public function get_distributor($data){
        $columns = [
            "module"            =>"distributor_list.module",
            "distributor_type"  =>"distributor_list.distributor_type",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('distributor_list');
        $this->db->where('module', $data);

        return $this->db->get()->result_array();
    }

    public function get_approved_distributor($data){
        $columns = [
            "report_type"        =>"rsm_approval.report_type",
            "status"             =>"rsm_approval.status",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('rsm_approval');
        $this->db->order_by("id", "desc");
        $this->db->limit(2);

        if(isset($data['ma_code']) && !empty($data['ma_code'])){
            $this->db->where_in('ma_code', $data['ma_code']);
        }
        if(isset($data['type']) && !empty($data['type'])){
            $this->db->where_in('type', $data['type']);
        }
        if(isset($data['report_type']) && !empty($data['report_type'])){
            $this->db->where_in('report_type', $data['report_type']);
        }
        if(isset($data['segment']) && !empty($data['segment'])){
            $this->db->where_in('segment', $data['segment']);
        }
        return $this->db->get()->result_array();
    }

    public function get_approved_distributor_rsm($data){
        $columns = [
            "report_type"        =>"nsm_approval.report_type",
            "status"             =>"nsm_approval.status",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('nsm_approval');
        $this->db->order_by("id", "desc");
        $this->db->limit(2);

        if(isset($data['ma_code']) && !empty($data['ma_code'])){
            $this->db->where_in('ma_code', $data['ma_code']);
        }
        if(isset($data['region']) && !empty($data['region'])){
            $this->db->where_in('region', $data['region']);
        }
        if(isset($data['type']) && !empty($data['type'])){
            $this->db->where_in('type', $data['type']);
        }
        if(isset($data['report_type']) && !empty($data['report_type'])){
            $this->db->where_in('report_type', $data['report_type']);
        }
        if(isset($data['segment']) && !empty($data['segment'])){
            $this->db->where_in('segment', $data['segment']);
        }
        return $this->db->get()->result_array();
    }

    public function get_approved_value($data){
        $columns = [
            "report_type"        =>"rsm_approval.report_type",
            "type"               =>"rsm_approval.type",
            "status"             =>"rsm_approval.status",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('rsm_approval');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);

        if(isset($data['ma_code']) && !empty($data['ma_code'])){
            $this->db->where_in('ma_code', $data['ma_code']);
        }
        if(isset($data['type']) && !empty($data['type'])){
            $this->db->where_in('type', $data['type']);
        }
        if(isset($data['report_type']) && !empty($data['report_type'])){
            $this->db->where_in('report_type', $data['report_type']);
        }
        if(isset($data['segment']) && !empty($data['segment'])){
            $this->db->where_in('segment', $data['segment']);
        }
        return $this->db->get()->row_array();
    }


    public function get_approved_value_rsm($data){
        $columns = [
            "report_type"        =>"nsm_approval.report_type",
            "type"               =>"nsm_approval.type",
            "status"             =>"nsm_approval.status",
        ];
        $this->db->select($this->common->arr_value_as_key($columns));
        $this->db->from('nsm_approval');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);

        if(isset($data['region']) && !empty($data['region'])){
            $this->db->where_in('region', $data['region']);
        }
        if(isset($data['type']) && !empty($data['type'])){
            $this->db->where_in('type', $data['type']);
        }
        if(isset($data['report_type']) && !empty($data['report_type'])){
            $this->db->where_in('report_type', $data['report_type']);
        }
        if(isset($data['segment']) && !empty($data['segment'])){
            $this->db->where_in('segment', $data['segment']);
        }
        return $this->db->get()->row_array();
    }

    public function user_info($data)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('sales_person_code',$data);
        $this->db->where('expiration_date is NULL');

        return $this->db->get()->row_array();
    }
}