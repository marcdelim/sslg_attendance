<?php
class Evaluation_model extends MY_Model{
	public function __construct(){
    parent::__construct();
  }

  public function evaluation($data, $no_limit = false){
    $mainTbl = "";
    $macolaCode = "";
    if(isset($data['business_unit'])){
      $bu = strtolower($data['business_unit']);
      $mainTbl = $bu."_details";
      $macolaCode = "customer_master.macola_id_".strtolower($data['business_unit']);
    }else{
      return [];
    }
    $columns = [
      "school_code"         => "customer_master.school_code",
      "macola_code"         => $macolaCode,
      "business_unit"       => "customer_master.bu_code",
      "school_name"         => "customer_master.school_name",
      "ma_code"             => "customer_master.ma_code",
      "region"              => "customer_master.region",
      "market_segmentation" => "customer_master.market_segmentation",
      "customer_objective"  => "customer_master.customer_objective",
      "evaluation_period"   => "evaluation_tbl.evaluation_period",
    ];
    
    $this->db
      ->select($this->common->arr_value_as_key($columns))
      ->from($mainTbl." AS evaluation_tbl")
      ->join('customer_master','evaluation_tbl.school_code=customer_master.school_code AND evaluation_tbl.transaction_id=customer_master.transaction_id')
      ->where('evaluation_tbl.transaction_id',$data['transaction_id'])
      ->where($columns['business_unit'],strtoupper($bu))
    ;

    if(isset($data['school_code'])){
      $this->db->where($columns['school_code'],$data['school_code']);
    }
    if(isset($data['macola_code'])){
      $this->db->where($columns['macola_code'],$data['macola_code']);
    }
    if(isset($data['school_name'])){
      $this->db->where($columns['school_name'],$data['school_name']);
    }
    if(isset($data['ma_code'])){
      $this->db->where($columns['ma_code'],$data['ma_code']);
    }
    if(isset($data['region'])){
      $this->db->where($columns['region'],$data['region']);
    }
    if(isset($data['market_segmentation'])){
      $this->db->where($columns['market_segmentation'],$data['market_segmentation']);
    }
    if(isset($data['customer_objective'])){
      $this->db->where($columns['customer_objective'],$data['customer_objective']);
    }
    if(isset($data['evaluation_period'])){
      $this->db->where($columns['evaluation_period'],$data['evaluation_period']);
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