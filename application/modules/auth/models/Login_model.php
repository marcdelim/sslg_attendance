<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct(){
		$this->load->database();
		parent::__construct();
	}

	public function checkCredentials($username){
		return $this->db
		->select('*')
		->from('users')
		->where('username',$username)
		->get()->row_array();
	}

	public function create_user_token($user_id){
		$this->db->insert('user_tokens',["user_id" => $user_id]);
		$last_id = $this->db->insert_id();
		$token = $this->common->encrypt_string($last_id);
		$this->db->where('id',$last_id)->update('user_tokens',["token"=>$token]);
		return $token;
	}

	public function getUserProfile($profile_id){
		return $this->db
		->select('*')
		->from('user_profile')
		->where('id',$profile_id)
		->get()->row_array()
		;
	}

	public function getUserRole($role_id){
		return $this->db
		->select('*')
		->from('user_roles')
		->where('id',$role_id)
		->get()->row_array()
		;
	}

	public function getRoleFunctions($role_id){
		return $this->db
		->select('*, CONCAT(module_functions.menu_name,"_",module_functions.name) AS user_function')
		->from('role_functions')
		->join('module_functions','role_functions.module_function_id=module_functions.id')
		->where('user_role_id',$role_id)
		->get()->result_array();
	}

	public function getUserDetails($token){
		$columns = [
			"user_id" => "users.id",
			"username" => "users.username",
			"login_date" => "user_tokens.date_created"
		];
		return $this->db
		->select($this->common->arr_value_as_key($columns))
		->from('user_tokens')
		->join('users','user_tokens.user_id=users.id')
		->where('token',$token)
		->get()->row_array();
	}
}