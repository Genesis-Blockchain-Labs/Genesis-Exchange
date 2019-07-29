<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Referral extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("Dashboard_model");
		$this->load->model("Referral_model");
		$this->load->model("user_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('session');
		
	}
	
	/********************************************************************
	  FUNCTION IS USE USE TO GET DATA OF REFEREL USER FOR DASHBOARD PAGE
	*********************************************************************/  
	public function get_referral(){
		
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['active_class'] = 'referral';
		if(!empty($session_data))
		{			
			$email = $session_data['email'];
			$data['userdata'] = $this->Dashboard_model->do_login($this->security->xss_clean($email));			
			$user_id = $session_data['user_id'];
			$config_data = $this->Dashboard_model->get_user_info($this->security->xss_clean($user_id));
			$refernce_id = $config_data['reference_id'];			
			$percentage = $data['contribution']['referral_bonus_percentage'];
			$data['refrel_usr'] = $this->Referral_model->refrel_usr($this->security->xss_clean($refernce_id));						
			$this->load->view('referral',$data);
		} else {
			redirect('login');
		}
	}	
	

	
}