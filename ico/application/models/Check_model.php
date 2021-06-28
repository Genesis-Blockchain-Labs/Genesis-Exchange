<?php
class Check_model extends CI_Model{
	public function __construct(){
         parent::__construct(); 
    }
	/*************************************************
		Function to check email exist in database
	*************************************************/
	public function check_email($email){
		$this->db->select('*');
		$this->db->where('email',$email);
		$return = $this->db->get(DB_PREFIX.'users')->row_array();
		return $return;
	}
	/*************************************************
		Function to check phone number exist in database
	*************************************************/
	public function check_phone($phone){
		$this->db->select('*');
		$this->db->where('phone',$phone);
		$return = $this->db->get(DB_PREFIX.'users')->row_array();
		return $return;
	}
	/*************************************************
		Function to check user exist in database
	*************************************************/
	public function check_id($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$return = $this->db->get(DB_PREFIX.'users')->row_array();
		return $return;
	}
	/*************************************************
		Function to check user with reference id exist in database
	*************************************************/
	public function check_ref_id($reference_id){
		$this->db->select('*');
		$this->db->where('reference_id',$reference_id);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $return;
	}
	/*************************************************
		Function to get reference ids  
	*************************************************/
	public function reference_id($reference_id){
		$this->db->select('*');
		$this->db->where('reference_id',$reference_id);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		if(!empty($return)){
			return $return;
		}else{
			$user_refrence = $this->check_reference_code($reference_id);
			if(!empty($user_refrence)){
				$user_refrence['reference_id'] = $user_refrence['reference_code'];
			}else{
				$user_refrence['reference_id'] = '';
			}
			return $user_refrence;
		}
		
	}
	/*************************************************
		Function to check token exist in database
	*************************************************/
	public function check_token($token){
		$this->db->select('*');
		$this->db->where('token',$token);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		echo $this->db->last_query();exit;
		return $return;
	}
	/*************************************************
		FUNTION IS USE TO CHECK TOKEN IS PRESENT OR NOT
	*************************************************/
	public function get_email_token($token){
		$this->db->select('*');
		$this->db->where('token',$token);
		$return = $this->db->get(DB_PREFIX.'users')->row_array();
		return $return;
	}
	
	/***************************************************
		FUNTION IS USE TO GET REWARD NAME BY ID
	***************************************************/
	public function get_reward_name($reward_id){
		$this->db->select('*');
		$this->db->where('reward_id',$reward_id);
		$return = $this->db->get('reward_point')->row_array();
		return $return;
	}	
	
	/*******************************************   
		FUNTION IS USE TO GET DATA BY TOKEN
	*****************************************/
	public function forgot_token($token){
		$this->db->select('*');
		$this->db->where('forgot_token',$token);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $return;
	}

	/******************************************************************
		FUNTION IS USE TO CHECK TOKEN IS VALID AND IT IS NOT EXPIRATION 
	*******************************************************************/
	public function check_expiration($token){
		$WHERE = array('link_expire'=>'1','forgot_token'=>$token);
		$this->db->select('*');
		$this->db->where($WHERE);
		$user = $this->db->get('users')->row_array();
		if(!empty($user)){
			$user_id = $user['id'];
			$data = array('link_expire'=>'0','forgot_token'=>'');
			$this->db->where('id',$user_id);
			$update = $this->db->update(DB_PREFIX.'users',$data);
			$return = $user;
		}else{
			$return = '';
		}
		return $return;
	}	
	 
	/*************************************************
		Check promo code 
	********************************************/   
	function check_reference_code($code){
		$this->db->select('*');
		$this->db->where('reference_code',$code);
		$query = $this->db->get('promotional_code')->row_array();
		return $query;
	}

	/**********************************************
	FUNTION IS USE TO GET DATA OF USER FROM CONFIG TABLE  
	**********************************************/
	public function get_user_data($id){
		$this->db->select('*');
		$this->db->where('user_id',$id);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $return;
	}	
	 
}