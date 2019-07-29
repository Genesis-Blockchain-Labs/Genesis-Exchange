<?php
include_once(APPPATH.'libraries/security.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
     }
	/**********************************************************
	Function to get the user detail
	**********************************************************/	 
	function get_usr_data($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$check = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $check; 
	}
	/************************************************************
	Function to register the user detail
	*************************************************************/	 
	function registration_ajax($data){
		$email = $data['email'];
		$password = $data['password'];
		$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		$encrypted = UnsafeCrypto::encrypt($password, $key, true);
		$data['password']=$encrypted;
		
		$return = $this->db->insert(DB_PREFIX.'users',$data);
		if($return=='1'){
			$this->db->select('*');
			$this->db->where('email',$email);
			$user_data = $this->db->get(DB_PREFIX.'users')->row_array();
		}else{
			$user_data = '';
		}
		return $user_data;		
	 }

	/*****************************************************************
		FUNTION IS USE TO verify email 
	*****************************************************************/	 
	function verify_mail($token){
		$this->db->select('*');
		$this->db->where('token',$token);
		$check = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $check;
		
	}
	
	/****************************************************************
	FUNTION IS USE TO VERIFY EMAIL FROM TOKEN   
	***************************************************************/
	function verify_acc($token){
		$this->db->select('*');
		$this->db->where('token',$token);
		$check = $this->db->get(DB_PREFIX.'user_config')->row_array();
		if(!empty($check)){
			$user_id = $check['user_id'];
			$this->db->where('id',$user_id);
			$data = array('status'=>'1');
			$this->db->update(DB_PREFIX.'users',$data);
			return $check;				
		}else{
			return $check;
		}
		return $check;
		
	}	
	
	/******************************************************
		FUNTION IS USE TO login   
	*********************************************************/	 
	function do_login($email){
		$this->db->select('*');
		$this->db->where('email',$email);
		$check = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $check; 
	}

	/******************************************************************
	FUNTION IS USE TO CHECK USER IS SOFT DELETED OR NOT 
	****************************************************************/	 
	function soft_delete($email){
		$this->db->select('*');
		$this->db->where('email',$email);
		$this->db->where('sdelete','0');
		$check = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $check; 
	}	
	
	/**************************************************************
		FUNTION IS USE TO INCREASE LOGIN ATTEMPT  
	***************************************************************/
	function increase_attempt($table,$user_id){
		$query = "UPDATE $table SET login_attempt = login_attempt + 1 where user_id = '$user_id'";
		$this->db->query($query);
		return $this->db->affected_rows();
	}
	
	
	/******************************************************************
	FUNTION IS USE TO delete ATTEMPT   
	*******************************************************************/
	function delete_attempt($user_id){
		$this->db->set('login_attempt', '0');
		$this->db->where('user_id',$user_id);
		$this->db->update(DB_PREFIX.'user_config');
		return $this->db->affected_rows();
		
	}

	/*******************************************************************
	FUNTION IS USE TO GET COUNTRY   
	*******************************************************************/	 
	function get_country(){
		$this->db->select('*');
		$this->db->order_by('country_name','ASC');
		$country = $this->db->get(DB_PREFIX.'country')->result_array(); 
		return $country;
	}

	/***************************************************************
		FUNTION IS USE TO GET proof   
	***************************************************************/	 
	function get_proof($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$proof = $this->db->get('proof')->result_array();
		return $proof;
	}	

	/************************************************************
		FUNCTION IS USE TO SUBMIT KYC    
	**********************************************************/	 
	function submit_kyc($data){
		$kyc = $this->db->insert('proof',$data);
		if($kyc){
			$user_id = $data['user_id'];
			$update_data['name'] = $data['firstname'];
			$update_data['phone'] = $data['phone'];
			$this->db->where('id',$user_id);
			$kyc = $this->db->update(DB_PREFIX.'users',$update_data);
		}
		return $kyc;
	}
	
	
	/********************************************************
		FUNCTION IS USE TO UPDATE KYC    
	*********************************************************/	 
	function update_kyc($data,$id){
		$this->db->where('id',$id);
		$return = $this->db->update('proof',$data);
		if($return){
			$user_id = $data['user_id'];
			$update_data['name'] = $data['firstname'];
			$update_data['phone'] = $data['phone'];
			$this->db->where('id',$user_id);
			$kyc = $this->db->update(DB_PREFIX.'users',$update_data);
		}
		return TRUE;
	}
	
	/***************************************************************
		function is use to updae expire link   
	***************************************************************/
	function expir_link($data){
		$u_id = $data['u_id'];
		$token = $data['token'];
		
		$data = array('link_expire'=>'1','forgot_token'=>$token);
		$this->db->where('user_id',$u_id);
		$update = $this->db->update(DB_PREFIX.'user_config',$data);
		if($update){
			return true;
		}else{
			return false;
		}
	}

	
	/********************************************************************
		function is use to update password  
	*******************************************************************/
	function update_pass($data){
		$user_id  = $data['user_id'];
		$password = $data['password'];
		$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		$encrypted = UnsafeCrypto::encrypt($password, $key, true);
		$data = array('password'=>$encrypted);
		$this->db->where('id',$user_id);
		$update = $this->db->update(DB_PREFIX.'users',$data);
		if($update){
			return true;
		}else{   
			return false;       
		}    
	}
	/*********************************************************
	function is used to update personal information
	***********************************************************/  
	function update_information($data,$user_id){
		$this->db->where('id',$user_id);
			$update = $this->db->update(DB_PREFIX.'users',$data); 	
			if($update){
				return true;
			}else{
				return false;          
			}      
	}

	/******************************************************************************
	Function is used to verify otp
	********************************************************************************/	
	function verify_otp($id,$verification)
	{
		$this->db->select('*');
		$this->db->where('user_id',$id);
		$this->db->where('otp',$verification);
		$reward = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $reward;
	}
	/**************************************************************
	Function used to get the user auth code 
	*****************************************************************/
	function get_user_auth($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$reward = $this->db->get(DB_PREFIX.'user_config')->row_array();
		
		return $reward;
	}
	/**************************************************************
	Function used to update otp
	****************************************************************/
	function update_otp($u_id, $otp)
	{
		$data = array('otp'=>$otp);
		$this->db->where('user_id',$u_id);
		$this->db->update(DB_PREFIX.'user_config',$data);
	}
	/*******************************************************
	Function used to update auth key
	*******************************************************/
	function get_auth_key_update($user_id,$key)
	{
		$data=array('google_auth_code'=>$key);
		$this->db->where('id',$user_id);
		$this->db->update(DB_PREFIX.'users',$data);
	}
	/************************************************
	Function used to save google auth 
	************************************************/
	function save_google_auth_ajax($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(DB_PREFIX.'users',$data);
	} 
	/****************************************************
	Function used to save tracking
	**********************************************************/
	function save_tracking($data){	
		$user_id = $data['user_id'];	
		$this->db->where('user_id',$user_id);
		$user_track = $this->db->get(DB_PREFIX.'user_track')->row_array();
		if(!empty($user_track)){				
			return true;
		}else{
			$user_track = $this->db->insert(DB_PREFIX.'user_track',$data);
			return true;
		}			
				
	} 
	
	/**********************************************************
		FUNCTION IS USE TO save tracking
	*********************************************************/
	function save_track($user_id,$device_id,$device_type,$ip_address){
		$this->db->where('user_id',$user_id);
		$user_track = $this->db->get('user_track')->row_array();
		if(!empty($user_track)){			
			return true;
		}else{
			$data = array('user_id'=>$user_id,'device_id'=>$device_id,'device_type'=>$device_type,'ip_address'=>$ip_address);
			$user_track = $this->db->insert('user_track',$data);
			return $user_track;
		}
		
	}
	

	/****************************************************
		FUNCTION IS USE TO GET THE data from the accounts table
	************************************************************/
	function accounts_usr($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$user_accounts = $this->db->get('accounts')->row_array();		
		return $user_accounts;
	}
	/**************************************************************
	Function used to save detail
	*****************************************************************/
	function register_ajax($data){
		$email = $data['email'];		
		$return = $this->db->insert(DB_PREFIX.'users',$data);
		if($return){ 
			$this->db->select('*');
			$this->db->where('email',$email);
			$user_data = $this->db->get(DB_PREFIX.'users')->row_array();
		}else{
			$user_data = '';
		}
		return $user_data;		
	}


	/*************************************************************  
	FUNCTION IS USE TO set or update user password
	*************************************************************/
	function set_password($user_id,$password){
		$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		$encrypted = UnsafeCrypto::encrypt($password, $key, true);
		$data = array('password'=>$encrypted);
		$this->db->where('id',$user_id);
		$update = $this->db->update(DB_PREFIX.'users',$data);
		if($update){
			return true;
		}else{
			return false;
		}
	}

	/**************************************************
	FUNCTION IS USE TO GET max serial no 
	*************************************************/
	function getLastSerial(){
		$mxserial_no = $this->db->query('SELECT MAX(serial_no) AS `mxserial_no` FROM '.DB_PREFIX.'kyc_detail` where sdelete = 0')->row()->mxserial_no;
		$serial_no = $mxserial_no + 1;
		return $serial_no;
	}	


	/**********************************************************
	FUNCTION IS USE TO GET PROGRESS BAR DATA
	**********************************************************/
	public function get_progress(){
		$this->db->select('*');
		$this->db->where('id','1');
		$query = $this->db->get('progress_bar')->row_array();
		return $query;
	}

	/*************************************************************
	FUNCTION IS USE TO update user as bounty address
	*****************************************************************/
	function update_bounty($user_id){
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$bounty = $this->db->get(DB_PREFIX.'users')->row_array();	
		if(!empty($bounty)){
			if($bounty['bounty']==''){
				$update['bounty'] = 'yes';
				$this->db->where('id',$user_id);
				$bounty = $this->db->update(DB_PREFIX.'users',$update);
			}
		}
		return $bounty;
	}
 
	/*****************************************************************
	Function to get the log history of the user
	***************************************************************/
	function get_usr_loghistory($limit,$offset,$user_id){
	$this->db->select('*');
	$this->db->limit($limit,$offset);
		$this->db->where('user_id',$user_id);
		$this->db->order_by('login_history_id','DESC');
		$datas = $this->db->get(DB_PREFIX.'login_history')->result_array();	
		foreach($datas as $data){
			$weekday = date('l', strtotime($data['login_date'])); // note: first arg to date() is lower-case L
			$data['weekday'] = $weekday;
			$result[] = $data;
		}
		return $result;
	}
	/************************************************
	Function to get the count of record
	************************************************/
	function get_usr_loghistory_count($user_id) {
	$this->db->select('count(*) as total');
	$this->db->where('user_id',$user_id);
	$datas = $this->db->get(DB_PREFIX.'login_history')->row_array();
	return $datas;
}
	
	/********************************************************
	FUNTION for check user old ip address   
	*********************************************************/	
	function check_ip_address($user_data,$ip_logs){
		$user_id = $user_data['user_id'];	 	
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('status','success');
		$this->db->order_by('login_history_id','DESC');
		$datas = $this->db->get(DB_PREFIX.'login_history')->row_array();	
		
		
		$insert['user_id'] 	 	= $user_id;
		$insert['country']    	= $ip_logs['country'];
		$insert['country_code'] = $ip_logs['country_code'];
		if(!empty($datas)){
			if($datas['ip_address'] != $ip_logs['ip_address']){	
				
				$insert['ip_address'] 	= $ip_logs['ip_address'];	
				
				$insert['status'] = 'failed';			
				$retrn = $this->db->insert(DB_PREFIX.'login_history',$insert);
				
				$update_data['ip_token'] = $user_data['ip_token'];
				
				$this->db->where('user_id',$user_id);
				$update = $this->db->update(DB_PREFIX.'user_config',$update_data);		
		
				return '2';
			}else{
				
				$insert['ip_address'] 	= $ip_logs['ip_address'];
				$insert['status'] = 'success';			
				$retrn = $this->db->insert(DB_PREFIX.'login_history',$insert);
				return '1';
			}
		}else{
			
			$insert['ip_address'] 	= $ip_logs['ip_address'];
			$insert['status'] = 'success';			
			$retrn = $this->db->insert(DB_PREFIX.'login_history',$insert);
			return '1';
		}
		
	}
	/*************************************************
	Function check is ip blocked or not
	***********************************************/
	function check_ip_block($ip)
	{
			$this->db->select('*');
			$this->db->where('ip',$ip);
			$query = $this->db->get(DB_PREFIX.'user_ip')->row_array();
			return $query;
	}	
	
	
 }
?>