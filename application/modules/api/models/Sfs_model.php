<?php
class Sfs_model extends MY_Model{
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
      $macolaCode = "customer_master.macola_id_".strtolower($data['business_unit']);
    }else{
      return [];
    }
    unset($data['business_unit']);
    $columns = [
        "macola_code"         => $macolaCode,
        "school_name"         => "customer_master.school_name",
        "ma_code"             => "customer_master.ma_code",
        "business_unit"       => "sales_forecast.module",
        "deped_id"            => "customer_master.deped_id",
    ];
    if(isset($data['product_format'])){
        if($data['product_format'] === "print"){
            $columns['item_code'] = "sales_forecast.item_code_print";
            $columns['item_description'] = "item_master_maintenance.pfp_scc_item_description";
            $columns['initial_qty'] = "(if(sales_forecast.half_1_target_print is null,0,sales_forecast.half_1_target_print)+if(sales_forecast.half_2_target_print is null,0,sales_forecast.half_2_target_print))";
            $columns['initial_rev'] = "(if(sales_forecast.half_1_target_print is null,0,sales_forecast.half_1_target_print)+if(sales_forecast.half_2_target_print is null,0,sales_forecast.half_2_target_print)) *
                                        if(price_list.standard_cost is null,0,price_list.standard_cost)";
            $this->db->join('item_master_maintenance','sales_forecast.item_code_print=item_master_maintenance.pfp_scc_itemcode AND item_master_maintenance.archived is null','left');
            $this->db->join('price_list','sales_forecast.item_code_print=price_list.item_code AND price_list.archived is null');
            $this->db->where('LOWER(sales_forecast.item_code_print)!=','null');
        }elseif($data['product_format'] === "pdf"){
            $columns['item_code'] = "sales_forecast.item_code_digital";
            $columns['item_description'] = "item_master_maintenance.pfnp_scc_item_description";
            $columns['initial_qty'] = "(if(sales_forecast.half_1_target_pdf is null,0,sales_forecast.half_1_target_pdf)+if(sales_forecast.half_2_target_pdf is null,0,sales_forecast.half_2_target_pdf))";
            $columns['initial_rev'] = "(if(sales_forecast.half_1_target_pdf is null,0,sales_forecast.half_1_target_pdf)+if(sales_forecast.half_2_target_pdf is null,0,sales_forecast.half_2_target_pdf)) * 
                                      if(price_list.standard_cost is null,0,price_list.standard_cost)";
            $this->db->join('item_master_maintenance','sales_forecast.item_code_digital=item_master_maintenance.pfnp_scc_item_code AND item_master_maintenance.archived is null','left');
            $this->db->join('price_list','sales_forecast.item_code_digital=price_list.item_code AND price_list.archived is null','left');
            $this->db->where('LOWER(sales_forecast.item_code_digital)!=','null');
        }else{
            return [];
        }
    }else{
        return [];
    }
    
    $this->db
      ->select($this->common->arr_value_as_key($columns))
      ->from("sales_forecast")
      ->join('customer_master','sales_forecast.school_code=customer_master.school_code','left')
      ->where('sales_forecast.transaction_id',$data['transaction_id'])
      ->where($macolaCode.' != ""',null,false)
      ->where($columns['initial_qty']." > 0",null,false)
      ->where('sales_forecast.module',strtoupper($xbu))    ;

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