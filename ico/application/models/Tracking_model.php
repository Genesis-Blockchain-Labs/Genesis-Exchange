<?php
include_once(APPPATH.'libraries/security.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
     }


/****************************************************************************
  FUNCTION IS USE TO Save tracking of the user_error
*************************************************************************/
	function save_track($user_id,$device_id,$device_type,$ip_address){
		$this->db->where('user_id',$user_id);
		$user_track = $this->db->get('user_track')->row_array();
		if(!empty($user_track)){			
			return true;
		}else{
			$data = array('user_id'=>$user_id,'device_id'=>$device_id,'device_type'=>$device_type,'ip_address'=>$ip_address);
			$user_track = $this->db->insert('user_track',$data);
			return true;
		}
		
	}
	
	
}