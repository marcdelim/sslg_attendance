<?php

class Transactions_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('transactions_model');
	}

	public function _remap(){
		redirect('site/error');
    }

    public function transaction_list(){
        $data = $this->input->post();
        $res = $this->transactions_model->list($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->transactions_model->list($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
        );
        echo json_encode($resData);
    }

    public function create_form(){
        $this->load->view('forms/create');
    }

    public function create_transaction(){
        $data = $this->input->post('data');
        $school_year = $data['school_year'];
        $data['school_year'] = $school_year." - ".($school_year + 1);
        $data['previous_year'] = $school_year - 2;
        $data['current_year'] = $school_year -1;
        $data['next_year'] = $school_year;
        $this->db->trans_begin();
        $transaction = $this->transactions_model->create_transaction($data);
        $this->transactions_model->create_transaction_status([
            "transaction_id"    => $transaction,
            "status"            => "inactive",
            "locked"            => 1,
            "created_by"        => $this->session->userdata('user_id'),
        ]);

        if($this->db->trans_status() === false){
			$this->db->trans_rollback();
			echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
		}else{
			$this->db->trans_commit();
			echo json_encode($this->common->apiData("success","success","Successfully saved!"));
        }
    }

    public function edit_form(){
        $data = $this->input->post('data');
        $aData['details'] = $this->transactions_model->list(['transaction_id'=>$data['transaction_id']]);
        $this->load->view('forms/edit',$aData);
    }

    public function update_transaction(){
        $data = $this->input->post('data');
        $details = $this->transactions_model->list(['transaction_id'=>$data['transaction_id']]);
        $this->db->trans_begin();
        $this->transactions_model->update_transaction([
            [
                "id" => $data['transaction_id'],
                "description" => $data['description'],
                "school_year" => $data['school_year'],
                "previous_year" => $data['previous_year'],
                "current_year" => $data['current_year'],
                "next_year" => $data['next_year'],
            ]
        ]);
        if($details['status_code'] != $data['status'] OR $details['locked'] != $data['locked']){
            $transaction_checker = $this->transactions_model->list(["status_code"=>"active"]);
            if($transaction_checker AND $transaction_checker[0]['transaction_id'] != $data['transaction_id']){
                $this->db->trans_rollback();
                echo json_encode($this->common->apiData("warning","warning","Unable to change status!"));
                exit();
            }else{
                $this->transactions_model->update_transaction_status([
                    [
                        "id" => $details['status_id'],
                        "archived" => date('Y-m-d H:i:s')
                    ]
                ]);
                $this->transactions_model->create_transaction_status([
                    "transaction_id" => $data['transaction_id'],
                    "status" => $data['status'],
                    "locked" => $data['status'] == "inactive" ? 1 : $data['locked'],
                    "created_by" => $this->session->userdata('user_id')
                ]);
            }
        }
        if($this->db->trans_status() === false){
			$this->db->trans_rollback();
			echo json_encode($this->common->apiData("error","error","An error occurred while saving!"));
		}else{
			$this->db->trans_commit();
			echo json_encode($this->common->apiData("success","success","Successfully saved!"));
        }
    }

    public function active(){
        $res = $this->transactions_model->list(["active"=>true]);
        if($res){
            return $this->common->apiData("success","active_transaction","Active Transaction!",$res);
        }else{
            return $this->common->apiData("error","no_transaction","No Active Transaction!");
        }
    }
}