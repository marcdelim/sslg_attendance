<?php
class Oms_sf_model extends MY_Model{
	public function __construct(){
    parent::__construct();
  }

  public function list($data, $no_limit = false){
    $macolaCode = "";
    $bu = "";
    $xbu = "";
    if(isset($data['business_unit'])){
      $xbu = $data['business_unit'];
      $bu = strtolower($data['business_unit']);
      $bu = in_array($bu,["k10","shs"]) ? "K12" : $bu;
      if($bu === "K12"){
        $macolaCode = "CONCAT(customer_master.macola_id_k10,'-',customer_master.macola_id_shs)";
      }else{
        $macolaCode = "customer_master.macola_id_".strtolower($data['business_unit']);
      }
    }else{
      return [];
    }
    unset($data['business_unit']);
    $columns = [
        "macola_code"         => $macolaCode,
        "school_code"         => "customer_master.school_code",
        "school_name"         => "customer_master.school_name",
        "ma_code"             => "customer_master.ma_code",
        "item_description"    => "item_master_maintenance.Item_Description",
        "business_unit"       => "sales_forecast.module",
        "forecast_year"       => "bpim_transactions.next_year",
    ];
    if(isset($data['product_format'])){
        if($data['product_format'] === "print"){
            $columns['item_code'] = "item_master_maintenance.pfp_scc_itemcode";
            $columns['item_description'] = "item_master_maintenance.pfp_scc_item_description";
            $this->db->join('item_master_maintenance','sales_forecast.item_code_print=item_master_maintenance.pfp_scc_itemcode AND 
            item_master_maintenance.archived is null','left');
            $columns['initial_qty'] = "(sales_forecast.half_1_target_print + sales_forecast.half_2_target_print)";
        }elseif($data['product_format'] === "pdf"){
            $columns['item_code'] = "item_master_maintenance.pfnp_scc_item_code";
            $columns['item_description'] = "item_master_maintenance.pfnp_scc_item_description";
            $this->db->join('item_master_maintenance','item_master_maintenance.pfnp_scc_item_code=sales_forecast.item_code_digital AND 
            item_master_maintenance.archived is null','left');
            $columns['initial_qty'] = "(sales_forecast.half_1_target_pdf + sales_forecast.half_2_target_pdf)";
        }else{
            return [];
        }
    }else{
        return [];
    }

    if(isset($data['ma_code']) AND $data['ma_code']!=""){
      $this->db->where($columns['ma_code'],$data['ma_code']);
    }else{
      return [];
    }
    
    
    $this->db
      ->select($this->common->arr_value_as_key($columns))
      ->from("sales_forecast")
      ->join('customer_master','sales_forecast.school_code=customer_master.school_code')
      ->join('bpim_transactions','sales_forecast.transaction_id=bpim_transactions.id','left')
      ->where('sales_forecast.transaction_id',$data['transaction_id'])
      ->where($macolaCode.' != ""',null,false)
      ->where($columns['initial_qty']." > 0",null,false)
      ->where('sales_forecast.module',strtoupper($xbu))
      ->where($columns['item_code'].' != ""',null,false)
    ;

    foreach($columns AS $key=>$val){
        if(isset($data[$key])){
            $this->db->where($val,$data[$key]);
        }
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