<?php

class User_roles_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('user_roles_model');
	}

	public function _remap(){
		redirect('site/error');
    }
    
    public function user_roles_list(){
        $data = $this->input->post();
        $res = $this->user_roles_model->user_roles_list($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->user_roles_model->user_roles_list($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
        );
        echo json_encode($resData);
    }

    public function _create(){
        $data = $this->input->post('data');
        
        $res = $this->user_roles_model->user_roles_list($data);

        if($res){
            echo json_encode($this->common->apiData("error","error","User role name already exist!"));
            exit();
        }

        $data['created_by'] = $this->session->userdata('user_id');
		if($this->user_roles_model->insert_role($data)){
			echo json_encode($this->common->apiData("success","success","Successfully saved!"));
		}else{
			echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
		}
    }

    public function update_details(){
        $data = $this->input->post('data');
        $current = $this->user_roles_model->user_roles_list(["id" => $data['id']]);
        $res = $this->user_roles_model->user_roles_list(["name" => $data['name']]);
        
        if(!is_null($res) AND $current['name'] != $res['name']){
            echo json_encode($this->common->apiData("error","error","User role name already exist!"));
            exit();
        }

        if($this->user_roles_model->update_details([$data])){
            echo json_encode($this->common->apiData("success","success","Successfully saved!"));
        }else{
            echo json_encode($this->common->apiData("warning","warning","No changes!"));
        }
    }

    public function _functions(){
        $data = $this->input->post();
        $res = $this->user_roles_model->_functions($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->user_roles_model->_functions($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
        );
        echo json_encode($resData);
    }

    public function add_form(){
        $this->load->view('user_roles/forms/add');
    }

    public function add_function(){
        $data = $this->input->post('data');
		if($this->user_roles_model->insert_function($data)){
			echo json_encode($this->common->apiData("success","success","Successfully saved!"));
		}else{
			echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
        }
    }

    public function remove_function(){
        $data = $this->input->post('data');
        if($this->user_roles_model->remove_function($data)){
			echo json_encode($this->common->apiData("success","success","Successfully saved!"));
		}else{
			echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
        }
    }
}