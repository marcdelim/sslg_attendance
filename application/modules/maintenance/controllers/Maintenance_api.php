<?php

class Maintenance_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('maintenance_model');
	}

	public function _remap(){
		redirect('site/error');
    }

    public function get_maintenance_value(){
        $data = $this->input->post('data');
        $result = $this->maintenance_model->get_maintenance_value($data,true);
        if($result){
            echo json_encode($this->common->apiData("success","success","Successfully saved!",$result));
        }else{
            echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
        }
    }

    public function maintenance_value(){
        $data = $this->input->post();
		$res = $this->maintenance_model->get_maintenance_value($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->maintenance_model->get_maintenance_value($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
		);
		echo json_encode($resData);
    }

    public function get_maintenance_type(){
        $data = $this->input->post();
		$res = $this->maintenance_model->maintenance_type($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->maintenance_model->maintenance_type($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
		);
		echo json_encode($resData);
    }

    public function edit_value_form(){
        $data = $this->input->post('data');
        $data['with_inactive'] = true;
        $aData['details'] = $this->maintenance_model->get_maintenance_value(["with_inactive"=>true,"id"=>$data['id']]);
        $this->load->view('general_maintenance/forms/edit_value',$aData);
    }

    public function update_value(){
        $data = $this->input->post('data');
        $data = array_map('strtoupper', $data);
        if($data['status'] == "ACTIVE"){
            $data['archived'] = null;
        }else{
            $data['archived'] = date('Y-m-d H:i:s');
        }
        unset($data['status']);
        $res = $this->maintenance_model->update_maintenance_value([$data]);
        if($res){
            $details = $this->maintenance_model->get_maintenance_value(["with_inactive"=>true,"id"=>$data['id']]);
            echo json_encode($this->common->apiData("success","success","Successfully updated!",$details));
        }else{
            echo json_encode($this->common->apiData("warning","warning","No changes!"));
        }
    }

    public function add_value_form(){
        $this->load->view('general_maintenance/forms/add_value');
    }

    public function add_value(){
        $data = $this->input->post('data');
        $data = array_map('strtoupper', $data);
        $details = $this->maintenance_model->get_maintenance_value(["with_inactive"=>true,"maintenance_type_code"=>$data['maintenance_type_code'],"code"=>$data['code']]);
        if(!$details){
            $res = $this->maintenance_model->add_maintenance_value($data);
            if($res){
                echo json_encode($this->common->apiData("success","success","Successfully saved!",$res));
            }else{
                echo json_encode($this->common->apiData("error","error","Error occurred while saving!"));
            }
        }else{
            echo json_encode($this->common->apiData("error","error","Code already exist!"));
        }
    }
}