<?php
include_once(APPPATH.'libraries/security.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Verify_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
     }
	 
	/***************************************************
	FUNCTION IS USE TO GET IP TOKEN 
  ***************************************************/
	public function get_ip_token($token){
		$this->db->select('*');
		$this->db->where('ip_token',$token);
		$query = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $query;
	}	

	/********************************************************
	FUNCTION IS USE TO update ip address
	*********************************************************/
	public function verifing($data){
		$user_id = $data['user_id'];	 	
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('status','failed');
		$this->db->order_by('login_history_id','DESC');
		$datas = $this->db->get(DB_PREFIX.'login_history')->row_array();	
		if(!empty($datas)){				
			$login_history_id = $datas['login_history_id'];			
			$update_data['ip_address'] = $datas['ip_address'];	
			$update_data['status'] = 'success';			
			$this->db->where('login_history_id',$login_history_id);
			$this->db->where('user_id',$user_id);
			$update = $this->db->update(DB_PREFIX.'login_history',$update_data);
			
			$ip_token['ip_token'] = '';					
			$this->db->where('user_id',$user_id);
			$updates = $this->db->update(DB_PREFIX.'user_config',$ip_token);
					
					
			return true;
		}else{			
			return false;
		}
	}	
	 
}