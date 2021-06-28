<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Contribution extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('kyc_model');
		$this->load->model('contribution_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}

	/****************************************************
	  FUNCTION IS USE TO SUBMIT CONTRIBUTION BTC
	*****************************************************/  
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