<?php
class Rles_model extends MY_Model{
	public function __construct(){
    parent::__construct();
  }

  public function list($data, $no_limit = false){
    $macola_id = $data['sub_bu'] == "k10" ? "macola_id_k10" : "macola_id_shs";
    $Hmacola_id = $data['sub_bu'] == "k10" ? "k10_macola_code" : "shs_macola_code";
    // $Hformat = strtolower($data['product_format']) == "print" ? "print" : "pdf_item_code";
    $columns = [
      "business_unit" => "customer_master.bu_code",
      "sub_bu" => "'".$data['sub_bu']."'",
      "region" => "customer_master.region",
      "ma_code" => "customer_master.ma_code",
      "macola_id_k10" => "customer_master.macola_id_k10",
      "macola_id_shs" => "customer_master.macola_id_shs",
      "cis_id" => "''",
      "school_code" => "customer_master.school_code",
      "customer_name" => "customer_master.school_name",
      "market_segment" => "customer_master.market_segmentation",
      "customer_objective" => "customer_master.customer_objective",
      "item_code" => "",
      "item_description" => "item_master.Item_Description",
      "grade_level" => "item_master.Grade_Level",
      "product_disposition" => "item_master.Product_Status",
      "subject" => "item_master.Subject",
      "product_type" => "item_master.Product_Category_1",
      "market_owner" => "item_master.Business_Unit",
      "historical_3_qty" => "(COALESCE(tbl_year_1.".$data['product_format']."_1st_half,0)+COALESCE(tbl_year_1.".$data['product_format']."_2nd_half,0))",
      "historical_3_revenue" => "ROUND((COALESCE(tbl_year_1.".$data['product_format']."_1st_half_amount,0)+COALESCE(tbl_year_1.".$data['product_format']."_2nd_half_amount,0)),2)",
      "historical_2_qty" => "(COALESCE(tbl_year_2.".$data['product_format']."_1st_half,0)+COALESCE(tbl_year_2.".$data['product_format']."_2nd_half,0))",
      "historical_2_revenue" => "ROUND((COALESCE(tbl_year_2.".$data['product_format']."_1st_half_amount,0)+COALESCE(tbl_year_2.".$data['product_format']."_2nd_half_amount,0)))",
      "historical_1_qty" => "(COALESCE(tbl_year_3.".$data['product_format']."_1st_half,0)+COALESCE(tbl_year_3.".$data['product_format']."_2nd_half,0))",
      "historical_1_revenue" => "ROUND((COALESCE(tbl_year_3.".$data['product_format']."_1st_half_amount,0)+COALESCE(tbl_year_3.".$data['product_format']."_2nd_half_amount,0)))",
    ];

    if(isset($data['product_format'])){
      if($data['product_format'] === "printed"){
          $columns['item_code'] = "item_master.PRINT_Item_Code";
          $sf_qty = "(sales_forecast.half_1_target_print+sales_forecast.half_2_target_print)";
          $Hitem_code = "print_item_code";
          $Item_Code = "PRINT_Item_Code";
          $srp = "PRINT_SRP";
      }elseif($data['product_format'] === "pdf"){
          $columns['item_code'] = "item_master.EBOOK_PDF_Item_Code";
          $sf_qty = "(sales_forecast.half_1_target_pdf+sales_forecast.half_2_target_pdf)";
          $Hitem_code = "ebook_pdf_item_code";
          $Item_Code = "EBOOK_PDF_Item_Code";
          $srp = "EBOOK_PDF_SRP";
      }else{
          return [];
      }
    }else{
      return [];
    }

    $columns["bp_yr_qty"] = "CEILING(SUM".$sf_qty."*(COUNT(DISTINCT sales_forecast.item_code) / COUNT(sales_forecast.item_code)))";
    $columns["bp_yr_revenue"] = "ROUND(CEILING(SUM".$sf_qty."*(COUNT(DISTINCT sales_forecast.item_code) / COUNT(sales_forecast.item_code)))*COALESCE(item_master.".$srp."))";
    
    $this->db
      ->select($this->common->arr_value_as_key($columns))
      ->from("customer_master")
      ->join("sales_forecast",'customer_master.school_code=sales_forecast.school_code AND '.$sf_qty.' > 0 AND sales_forecast.module = "'.$data['sub_bu'].'"','left')
      ->join("item_master",'sales_forecast.item_code=item_master.item_code','left')
      ->join("historical_data tbl_year_1",'customer_master.'.$macola_id.'=tbl_year_1.'.$Hmacola_id.' AND tbl_year_1.transaction_year=2019 AND tbl_year_1.'.$Hitem_code.' = item_master.'.$Item_Code.'','left')
      ->join("historical_data tbl_year_2",'customer_master.'.$macola_id.'=tbl_year_2.'.$Hmacola_id.' AND tbl_year_2.transaction_year=2020 AND tbl_year_2.'.$Hitem_code.' = item_master.'.$Item_Code.'','left')
      ->join("historical_data tbl_year_3",'customer_master.'.$macola_id.'=tbl_year_3.'.$Hmacola_id.' AND tbl_year_3.transaction_year=2021 AND tbl_year_3.'.$Hitem_code.' = item_master.'.$Item_Code.'','left')
      ->where("customer_master.bu_code","K12")
      ->where("customer_master.".$macola_id." != ''",null,false)
      // ->where("customer_master.ma_code","NW6")
      // ->group_start()
      // ->where($columns['historical_3_qty']." > 0",null,false)
      // ->or_where($columns['historical_3_revenue']." > 0",null,false)
      // ->or_where($columns['historical_2_qty']." > 0",null,false)
      // ->or_where($columns['historical_2_revenue']." > 0",null,false)
      // ->or_where($columns['historical_1_qty']." > 0",null,false)
      // ->or_where($columns['historical_1_revenue']." > 0",null,false)
      // ->group_end()
      ->group_by("customer_master.school_code, item_master.item_code,customer_master.region,customer_master.ma_code")
    ;

    foreach($columns AS $key=>$val){
      if(isset($data[$key]) AND !in_array($data[$key],["sub_bu","historical_3_qty","historical_3_revenue","historical_2_qty","historical_2_revenue","historical_1_qty","historical_1_revenue","bp_yr_qty","bp_yr_revenue",])){
        $this->db->where($val,$data[$key]);
      }
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