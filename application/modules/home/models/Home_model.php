<?php
class Home_model extends MY_Model{

    public function __construct(){
		parent::__construct();
    }

    public function questions($user_id){
        return $this->db
        ->select('*')
        ->from('test_questionaire')
        ->join('test_answer','test_questionaire.id=test_answer.question_id AND test_answer.user_id=1','left')
        ->get()->result_array();
    }

    public function choices(){
        return $this->db
        ->select('*')
        ->from('test_choices')
        ->order_by('order_id')
        ->get()->result_array();
    }
}