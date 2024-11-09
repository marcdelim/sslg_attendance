<?php
class Slspn extends MX_Controller{
    private $cred = [
        "username" => "super_user",
        "password" => "qwer",
        "system" => "Rex Universe"
    ];
    private $arrData = [];
    public function __construct()
    {
        parent::__construct();
        // $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
        $this->load->model('slspn_model');
    }
    function _remap($param) {
        if($param === "migrate"){
            $this->migrate();
        }elseif($param === "sync"){
            $this->sync();
        }else{
            header("HTTP/1.1 401 Unauthorized");
        }
    }
    public function migrate(){
        echo $this->slspn_model->create_tbl();
    }
    public function sync(){
        $token = $this->generate_token();
        $this->generate_ma($token);
        $this->generate_rsm($token);
        $this->generate_nsm($token);
        $this->db->trans_begin();
        $this->slspn_model->clear_data();
        $this->slspn_model->insert_slspn($this->arrData);
        if($this->db->trans_status() === false){
            $this->db->trans_rollback();
            $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
        }else{
            $this->db->trans_commit();
            $data = $this->common->apiData('success','success_saving','Successfully saved');
        }
        echo json_encode($data);
    }
    private function generate_token(){
        $url = $this->config->item('site')['ApiEndPoint']['URL']['SPMS_AUTH'];
        $data = $this->cred;
        $error_msg = "";
        $token = "";
        $ch = curl_init();
        $headers = array(
            'Accept: application/json',
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close ($ch);
        $cURLresponse = json_decode($cURLresponse);
        if($error_msg != "" OR $cURLresponse->token == null OR $cURLresponse->token == "") {
            exit($error_msg);
        }else{            
            $token = $cURLresponse->token;
        }
        return $token;
    }
    private function get_data($token,$type){
        $headers = array(
            'Accept: application/json',
            'API:' . $token
        );
        $url = $this->config->item('site')['ApiEndPoint']['URL']['SPMS'].'/'.$type;
        if($type === "nsm"){
            $url = $url."?".http_build_query(["with_rsm"=>"true"]);
        }
        if($type === "rsm"){
            $url = $url."?".http_build_query(["with_ma"=>"true"]);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        curl_close($ch);
        $cURLresponse = json_decode($cURLresponse);
        return $cURLresponse;
    }
    private function generate_ma($token){
        $ma = $this->get_data($token,"ma");
        foreach($ma AS $key=>$val){
            $this->arrData[] = [
                "business_unit" => $val->bu_name,
                "ma_code" => $val->code,
                "ma_id" => $val->id,
                "full_name" => $val->first_name .' '.$val->middle_name.' '.$val->last_name,
                "rsm_bu" => "",
                "rsm_code" => "",
                "rsm_id" => "",
                "nsm_code" => "",
                "nsm_id" => "",
                "region" => $val->region_name,
                "company" => $val->company_code,
            ];
        }
    }
    private function generate_rsm($token){
        $data = $this->get_data($token,"rsm");
        foreach($data AS $key=>$val){
            $rsmID = $val->id;
            $rsmCode = $val->code;
            $rsmBU = $val->bu_name;
            $rsmRegion = $val->region_name;
            foreach($val->material_advisors AS $bkey=>$bval){
                $x = array_search($bval->material_advisor_id,array_column($this->arrData,"ma_id"));
                if($x !== false){
                    $this->arrData[$x]["rsm_code"] = $rsmCode;
                    $this->arrData[$x]["rsm_id"] = $rsmID;
                    $this->arrData[$x]["rsm_bu"] = str_replace(","," and ",$rsmBU);
                    $this->arrData[$x]["region"] = str_replace(","," and ",$rsmRegion);
                }
            }
        }
    }
    private function generate_nsm($token){
        $data = $this->get_data($token,"nsm");
        foreach($data AS $key=>$val){
            $nsmID = $val->id;
            $nsmCode = $val->code;
            $arrRsms = array_column($val->regional_sales_managers,"regional_sales_manager_id");
            $arrRsms = array_intersect(array_column($this->arrData,"rsm_id"),array_values($arrRsms));
            $arrRsms = array_keys($arrRsms);
            foreach($arrRsms AS $bkey=>$bval){
                $a = $this->arrData[$bval];
                $a['nsm_code'] = $nsmCode;
                $a['nsm_id'] = $nsmID;
                $arrTmp[] = $a;
            }
        }
        $this->arrData = $arrTmp;
    }
}