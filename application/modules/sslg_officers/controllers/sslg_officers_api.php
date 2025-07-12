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
    
	public function list(){
		$data = $this->input->post();
        $res = $this->sslg_officers_model->list($data);
		$recordsTotal = count($res);
        $data['count_result'] = true;
		$recordsFiltered = $this->sslg_officers_model->list($data,true);
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
		);
		echo json_encode($resData);
	}

     public function update(){
        $data = $this->input->post('data');
        $id = $data['id'];
        parse_str($data['details'],$data);

        if($data['password'] != 'Matthew30!'){
            exit(json_encode($this->common->apiData("error","error","Incorrect Password")));
        }

        unset($data['password']);
        $this->db->trans_begin();
        $this->sslg_officers_model->update($data,["id"=>$id]);
        
        if($this->db->trans_status() === false){
            $this->db->trans_rollback();
            $data = $this->common->apiData("error","error","An error occurred while updating!");
        }else{
            $this->db->trans_commit();
            $data = $this->common->apiData("success","success","Successfully updated!");
        }
        echo json_encode($data);
        
    }


    public function create(){
        $data = $this->input->post('data');
        parse_str($data,$data);
        
        if($data['password'] != 'Matthew30!'){
            exit(json_encode($this->common->apiData("error","error","Incorrect Password")));
        }

        unset($data['password']);

        if($this->sslg_officers_model->insert([$data])){
            echo json_encode($this->common->apiData("success","success","Successfully saved!"));
        }else{
            echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
        }
    }

    public function create_form(){
        $this->load->model('maintenance/maintenance_model');
        $this->load->view('forms/add');
    }

    public function edit_form(){
        $this->load->model('maintenance/maintenance_model');
        $data = $this->input->post('data');
        $aData['details'] = $this->sslg_officers_model->list($data);
        $this->load->view('forms/edit',$aData);
    }
}