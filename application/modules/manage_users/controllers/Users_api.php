<?php

class Users_api extends MX_Controller
{
	public function __construct(){
    	
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('users_model');
	}

	public function _remap(){
		redirect('site/error');
    }
    
    public function users_list(){
        $data = $this->input->post();
        $res = $this->users_model->user_list($data);
		$recordsTotal = count($res);
		$recordsFiltered = count($this->users_model->user_list($data,true));
		$draw = isset ( $data['draw'] ) ? intval( $data['draw'] ) : 0;
		$resData = array(
			"draw"              => $draw,
			"recordsTotal"      => $recordsTotal,
            "recordsFiltered"   => $recordsFiltered,
            "data"              => $res
        );
        echo json_encode($resData);
    }

    public function sso_users_list(){
        $data = $this->input->post();
        unset($data['mod']);
        $data['api'] = $this->config->item('site')['ApiEndPoint']['API_KEY'];
        $url = $this->config->item('site')['ApiEndPoint']['URL']['MANAGE_USERS'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url."?".http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $cURLresponse = curl_exec($ch);
        curl_close($ch);
        $cURLresponse = json_decode($cURLresponse);
        echo json_encode($cURLresponse);
    }

    public function edit_form(){
        $data = $this->input->post('data');
        $this->load->model('user_roles_model');
        $aData['user_roles'] = $this->user_roles_model->user_roles_list([],true);
        $aData['user_details'] = $this->users_model->user_list($data);
        $profile_columns = $this->users_model->users_fields();
        foreach($profile_columns AS $key=>$val){
            if(in_array($val['Field'],['id','date_updated','updated_by','date_created','created_by'])){
                unset($profile_columns[$key]);
            }
        }
        $aData['profile_columns'] = $profile_columns;
        $this->load->view('users/forms/edit',$aData);
    }

    public function create_user(){
        $post = $this->input->post();
        $data = array();
        parse_str($post['data'], $data);

        $postData = array_diff($data,['user_role']);
        $postData['created_by'] = $this->session->userdata('user_id');
        $postData['api'] = $this->config->item('site')['ApiEndPoint']['API_KEY'];
        $url = $this->config->item('site')['ApiEndPoint']['URL']['MANAGE_USERS'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        curl_close ($ch);
        $cURLresponse = json_decode($cURLresponse);

        // check cURL response status
        if($cURLresponse->status != "success"){
            echo json_encode($cURLresponse);
            exit();
        }

        // get cURL response data and cast array object to associative array
        $userDetails = (array) $cURLresponse->data;
        $userDetails['id'] = $userDetails['user_id'];
        $userDetails['role_id'] = $data['user_role'];
        $userDetails['created_by'] = $this->session->userdata('user_id');

        unset($userDetails['date_created']);
        unset($userDetails['expiration_date']);
        unset($userDetails['user_id']);
        
        $this->db->trans_begin();
        $this->users_model->add_user($userDetails);
        if($this->db->trans_status() === false){
            $this->db->trans_rollback();
            $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
        }else{
            $this->db->trans_commit();
            $data = $this->common->apiData('success','success_saving','Successfully saved');
        }
        
        echo json_encode($data);
    }

    public function force_change_password(){
        $data = $this->input->post('data');
        $postData['api'] = $this->config->item('site')['ApiEndPoint']['API_KEY'];
        $postData['user_id'] = $data['user_id'];
        $postData['password'] = $data['password'];
        $url = $this->config->item('site')['ApiEndPoint']['URL']['MANAGE_USERS'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        curl_close ($ch);
        $cURLresponse = (array) json_decode($cURLresponse);
        
        echo json_encode($cURLresponse);
    }

    public function reset_password(){
        $data = $this->input->post('data');
        $postData['api'] = $this->config->item('site')['ApiEndPoint']['API_KEY'];
        $postData['user_id'] = $data['user_id'];
        $postData['password'] = $this->config->item('site')['defaultPass'];
        $url = $this->config->item('site')['ApiEndPoint']['URL']['MANAGE_USERS'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        curl_close ($ch);
        $cURLresponse = (array) json_decode($cURLresponse);
        
        echo json_encode($cURLresponse);
    }

    public function update_user(){
        $data = $this->input->post('data');
        $user_details = $this->users_model->user_list(["user_id"=>$data['user_id']]);
        parse_str($data['profile'], $data);

        $arrData['role_id'] = $data['role_id'];
        $arrData['expiration_date'] = $data['expiration_date'] == "" ? null : $data['expiration_date'];
        $arrData['id'] = $user_details['user_id'];

        $arrData['updated_by'] = $this->session->userdata('user_id');
        $arrData['date_updated'] = date('Y-m-d H:i:s');
        unset($arrData['user_id']);
        unset($arrData['role']);
        unset($arrData['date_created']);
        unset($arrData['date_archived']);

        $res = $this->users_model->update_user([$arrData]);
        if($res){
            $data = $this->common->apiData('success','success_saving','Successfully saved');
        }else{
            $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
        }
        echo json_encode($data);
    }

    public function import_users(){
        // ini_set('max_input_vars', '-1');
        $data = $this->input->post('data');

        $arrData = [];
        $fields = $this->users_model->users_fields();
        // unset unnecessary fields
        unset($fields[array_search('role_id', array_column($fields,'Field'))]);
        unset($fields[array_search('expiration_date', array_column($fields,'Field'))]);
        unset($fields[array_search('created_by', array_column($fields,'Field'))]);
        unset($fields[array_search('date_created', array_column($fields,'Field'))]);
        unset($fields[array_search('updated_by', array_column($fields,'Field'))]);
        unset($fields[array_search('date_updated', array_column($fields,'Field'))]);

        foreach($data AS $dKey=>$dVal){
            $arrTmp = [];
            $arrTmp['id'] = $dVal['user_id'];
            $arrTmp['created_by'] = $this->session->userdata('user_id');
            $user_details = $this->users_model->user_list(["user_id"=>$dVal['user_id']]);
            if($user_details){
                unset($data[$dKey]);
            }

            foreach($fields AS $fKey=>$fVal){
                if(isset($dVal[$fVal['Field']])){
                    $arrTmp[$fVal['Field']] = $dVal[$fVal['Field']];
                }
            }

            $arrData[] = $arrTmp;
        }

        if(!empty($data)){
            $res = $this->users_model->add_user_batch($arrData);
            if($res){
                $data = $this->common->apiData('success','success_saving','Successfully saved');
            }else{
                $data = $this->common->apiData('error','error_saving','An error occurred while saving!');
            }
        }else{
            $data = $this->common->apiData('error','error_saving','No data to import!');
        }

        echo json_encode($data);
    }

}