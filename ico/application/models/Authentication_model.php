<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authentication_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 
     }
	 
	/************************************************************
	 function is use to get user auth if it allready have
	 ************************************************************/
	function get_user_auth($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$auth = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $auth;
	}
	
	/****************************************************************
	 function is use to save google auth info of user
	 *************************************************************/
	function save_google_auth($data,$user_id){
		unset($data['id']);
		$this->db->where('user_id',$user_id); 
		$auth = $this->db->update(DB_PREFIX.'user_config',$data);
	}
	/****************************************************************
	Function is used to disable google auth
	****************************************************************/	
	function disable_google_auth($user_id){
		$data['login_type'] = "";
		$this->db->where('user_id',$user_id);
		$auth = $this->db->update(DB_PREFIX.'user_config',$data);
		return $auth;   
}
	/**************************************************************
	 function is use to save new otp
	 *************************************************************/
	function save_otp($data,$user_id){
		$this->db->where('user_id',$user_id);
		$auth = $this->db->update(DB_PREFIX.'user_config',$data);
		return $auth;
	}
	/**************************************************
		function is use to save twilio_token
	**************************************************/
	function save_twilio_token($user_id,$token,$mobile_no){
		$data = array('twilio_token'=>$token,'phone'=>$mobile_no);
		$this->db->where('user_id',$user_id);
		$auth = $this->db->update(DB_PREFIX.'user_config',$data);
		return $auth;
	}
	/***********************************************************
		function is use to check twilio code
	*****************************************************/
	function check_twilio_code($user_id,$twilio_token){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('twilio_token',$twilio_token);
		$auth = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $auth;
	}
	
	/**************************************************
		function is use to save email authentication code
	*************************************************/
	function save_email_authetication_code($user_id,$code,$date){
		$data = array('mail_authetication_code'=>$code,'mail_authetication_date'=>$date);
		$this->db->where('user_id',$user_id);
		$auth = $this->db->update(DB_PREFIX.'user_config',$data);
		return $auth;
	}
	/*****************************************************
		function is use to check authentication code
	*****************************************************/
	function check_authetication_code($user_id,$authcode){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('mail_authetication_code like binary',$authcode);
		$auth = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $auth;
	}
	/*******************************************************
		Function to check  login status 
	*******************************************************/
	function check_login_status()
	{
		$this->db->select('*');
		$auth = $this->db->get(DB_PREFIX.'system_settings')->row_array();
		return $auth;
	}
	
	
	 
}