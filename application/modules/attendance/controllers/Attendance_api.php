<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Attendance_api extends MX_Controller
{
    private $transaction = [];
    private $smodule;
    public function __construct(){
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
        $this->load->model('attendance_model');
        
	}

	public function _remap(){
		redirect('site/error');
    }
    

    public function save(){
        $data = $this->input->post('data');
        $time_in_details= [];
        parse_str($data['time_in_details'],$time_in_details);

        $data = array(
            "check_today" => true,
            "sslg_officers_id" =>  $time_in_details['sslg_officers_id'],
            "get_current_day_attendance" => true,
        );

        $exist_data = $this->attendance_model->list($data);
        if(empty($exist_data)){
            $data = array(
                "sslg_officers_id" => $time_in_details['sslg_officers_id']
            );
            $last_insert_id = $this->attendance_model->insert_data($data);
            $file_name = $last_insert_id."_time_in";
        }else{
            $update_data['time_out'] = date('Y-m-d H:i:s');
            $this->attendance_model->update($update_data,["id"=>$exist_data['id']]);
            $file_name = $exist_data['id']."_time_out";
        }

    
        $this->save_image($time_in_details['image'], $file_name);
        echo json_encode($this->common->apiData("success","success","Successfully saved!"));
    }

    public function view_form(){
        $data = $this->input->post('data');
        $aData['details'] = $this->attendance_model->list($data);
        $this->load->view('forms/view',$aData);
    }

	public function list(){
		$data = $this->input->post();
        $res = $this->attendance_model->list($data);
		$recordsTotal = count($res);
        $data['count_result'] = true;
		$recordsFiltered = $this->attendance_model->list($data,true);
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
		);
		echo json_encode($resData);
	}

    function save_image($img, $last_insert_id){

        $folderPath = APPPATH."modules/attendance/assets/uploads/";
    
        $image_parts = explode(";base64,", $img);
    
        $image_base64 = base64_decode($image_parts[1]);
    
        $fileName = $last_insert_id . '.png';
    
        $file = $folderPath . $fileName;
    
        file_put_contents($file, $image_base64);

        return $fileName;
    }
}