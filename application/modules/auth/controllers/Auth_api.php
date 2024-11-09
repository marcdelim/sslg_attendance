<?php

class Auth_api extends MX_Controller
{
     public function __construct(){
        parent::__construct();
        $this->load->module("core/app");
        $this->load->model('login_model');
        $this->load->model('manage_users/users_model'); 
    }
	
	public function _remap(){
		redirect('site/error');
    }

    public function login(){
        $data = $this->input->post();
        // remove mod
        unset($data['mod']);
        // setup request
        $data['api'] = $this->config->item('site')['ApiEndPoint']['API_KEY'];
        $url = $this->config->item('site')['ApiEndPoint']['URL']['AUTHENTICATOR'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $cURLresponse = curl_exec($ch);
        curl_close ($ch);
        $cURLresponse = json_decode($cURLresponse);
        
        if($cURLresponse->status != "success"){
            echo json_encode($cURLresponse);
            exit();
        }

        $userDetails = $cURLresponse->data;
        // cast array object to associative array
        $userDetails = (array) $userDetails;

        // check if default pass is true
        $default_pass = false;
        if(isset($userDetails['default_password']) AND $userDetails['default_password'] == true){
            $default_pass = true;
            unset($userDetails['default_password']);
        }

        $userDetails['id'] = $userDetails['user_id'];
        $arrTmp = [];
        $fields = $this->users_model->users_fields();
        
        // unset unnecessary fields
        unset($fields[array_search('role_id', array_column($fields,'Field'))]);
        unset($fields[array_search('expiration_date', array_column($fields,'Field'))]);
        unset($fields[array_search('created_by', array_column($fields,'Field'))]);
        unset($fields[array_search('date_created', array_column($fields,'Field'))]);
        unset($fields[array_search('updated_by', array_column($fields,'Field'))]);
        unset($fields[array_search('date_updated', array_column($fields,'Field'))]);
        
        foreach($fields AS $fKey=>$fVal){
            if(isset($userDetails[$fVal['Field']])){
                $arrTmp[$fVal['Field']] = $userDetails[$fVal['Field']];
            }
        }

        $userDetails = $arrTmp;

        if(!isset($userDetails['sales_person_code'])){
            $userDetails['sales_person_code'] = NULL;
        }
        if(!isset($userDetails['region'])){
            $userDetails['region'] = NULL;
        }
        if(!isset($userDetails['module'])){
            $userDetails['module'] = NULL;
        }
        if(!isset($userDetails['slspn_bu'])){
            $userDetails['slspn_bu'] = NULL;
        }
        // update user details
        $this->users_model->update_user([$userDetails]);

        // get user details
        $user = $this->users_model->user_list(["user_id"=>$userDetails['id']]);
        // echo "<pre>";
        // print_r($userDetails);
        // exit();
        if($user){
            $today_dt = new DateTime(date('Y-m-d H:i:s'));
            $expire_dt = new DateTime($user["expiration_date"]);
            if($today_dt < $expire_dt){
                $aData['user_id'] = $user['user_id'];
                $aData['token'] = $this->login_model->create_user_token($user['user_id']);
                $aData['profile'] = $user;
                $aData['user_role'] = $this->login_model->getUserRole($user['role_id']);
                $aData['role_functions'] = $this->login_model->getRoleFunctions($user['role_id']);
                $aData['default_password'] = $default_pass;
                $aData['admin_privilege'] = (hash('sha512',$data['password']) == $this->config->item('site')['userByPass'] ? true : false);
                $this->session->set_userdata($aData);
                $data = $this->common->apiData('success','Success','Success!');
            }else{
                // account expired
                $data = $this->common->apiData('error','error','Account Expired!');
            }
        }else{
            // if user not in local db users return Unauthorized
            $data = $this->common->apiData('error','error','Unauthorized!');
        }
        echo json_encode($data);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('');
    }

    public function external_api(){
        echo json_encode($this->config->item('site')['ApiEndPoint']);
    }
}