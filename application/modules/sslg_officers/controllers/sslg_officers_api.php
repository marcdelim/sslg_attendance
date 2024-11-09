<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sslg_officers_api extends MX_Controller
{
    private $transaction = [];
    public function __construct(){
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('sslg_officers_model');
        $this->load->module('transactions/transactions_api');
	}

	public function _remap(){
		redirect('site/error');
    }

    public function save(){
        $data = $this->input->post('data');
        $data['transaction_id'] = $this->transaction['data']['transaction_id'];
        $sslg_officers = $this->sslg_officers_model->list($data);
        $arrUpdate = [];
        foreach($sslg_officers as $key=>$val){
            $update_row = [];
            $sslg_officers_code = $sslg_officers[$key]['sslg_officers_code'];
            $changes = false;
            for($i = 1; $i <= 5; $i++){
                if($data[$sslg_officers_code."_".$i."_start"] >  $data[$sslg_officers_code."_".$i."_end"]){
                    exit(json_encode($this->common->apiData("error","error","Value in ".$i."_start for Financial Ratio: ".$sslg_officers[$key]['sslg_officers_code']." is greater than ".$i."_end")));
                }
                $update_row[$i."_start"] = $data[$sslg_officers_code."_".$i."_start"];
                $update_row[$i."_end"] = $data[$sslg_officers_code."_".$i."_end"];

                $update_row[$i."_start"] = $data[$sslg_officers_code."_".$i."_start"];
                $update_row[$i."_end"] = $data[$sslg_officers_code."_".$i."_end"];
                if($sslg_officers[$key][$i."_start"] != $data[$sslg_officers_code."_".$i."_start"] || $sslg_officers[$key][$i."_end"] != $data[$sslg_officers_code."_".$i."_end"]){
                    $changes = true;
                }
            }

            if($sslg_officers[$key]["weight"] != $data[$sslg_officers_code."_weight"]){
                $changes = true;
                $update_row['weight'] = $data[$sslg_officers_code."_weight"];
            }

            if($changes){
                $update_row['updated_by'] = $this->session->userdata('user_id');
                $update_row['date_updated'] = date('Y-m-d H:i:s');
            }
            $update_row['id'] = $sslg_officers[$key]['id'];
            $update_row['sslg_officers'] = $sslg_officers[$key]['sslg_officers'];
            $arrUpdate[] = $update_row;
        }
        $this->db->trans_begin();
        

        if($arrUpdate){
            $arrFieldCount = [1,2,3,4,5];
            foreach($arrUpdate as $key=>$val){
               
                for($i = 1; $i <= 5; $i++){
                    $to_check = $arrUpdate[$key][$i."_start"];
                    unset($arrFieldCount[$i-1]);
                    foreach($arrFieldCount as $arrField){
                        if($to_check >= $arrUpdate[$key][$arrField."_start"] AND $to_check <= $arrUpdate[$key][$arrField."_end"]){
                            exit(json_encode($this->common->apiData("error","error","Value in ".$i."_start Financial Ratio: ".$arrUpdate[$key]['sslg_officers']." exist in ".$arrField."_start and " .$arrField."_end")) );
                        }
                    }
                    $arrFieldCount = [1,2,3,4,5];
                }

                for($i = 1; $i <= 5; $i++){
                    $to_check = $arrUpdate[$key][$i."_end"];
                    unset($arrFieldCount[$i-1]);
                    foreach($arrFieldCount as $arrField){
                        if($to_check >= $arrUpdate[$key][$arrField."_start"] AND $to_check <= $arrUpdate[$key][$arrField."_end"]){
                            exit(json_encode($this->common->apiData("error","error","Value in ".$i."_end Financial Ratio: ".$arrUpdate[$key]['sslg_officers']." exist in ".$arrField."_start and " .$arrField."_end")) );
                        }
                    }
                    $arrFieldCount = [1,2,3,4,5];
                }
            }
            $this->sslg_officers_model->update_batch($arrUpdate);
        }
        if($this->db->trans_status() === false){
            $this->db->trans_rollback();
            $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
        }else{
            $this->db->trans_commit();
            $data = $this->common->apiData('success','success_saving','Successfully saved');
        }

        echo json_encode($data);
    }
    
	public function list(){
		$data = $this->input->post();
        $res = $this->sslg_officers_model->list($data);
		$resData = array(
            "data"              => $res
		);
		echo json_encode($resData);
	}
}