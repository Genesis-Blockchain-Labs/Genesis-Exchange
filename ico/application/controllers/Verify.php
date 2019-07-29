<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Verify extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("verify_model");
		$this->load->model("user_model");
		$this->load->model("Dashboard_model");
		$this->load->model("authentication_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		
	}
	
	/****************************************************************
	 function is use to verify link from email for ip address	
	****************************************************************/ 
	public function verify_ip(){	
		$token = $this->security->sanitize_filename($this->input->get('link'));		
		$return = $this->verify_model->get_ip_token($this->security->xss_clean($token));
		if(!empty($return)){
			$data['userdata'] = $return;			
			$data['content'] = 'Your registration is successful. An email has been sent to your email address with a verification link to verify your email address. Please login to your email address and open the email and click on the verification link.';			
		}else{			
			$data['content'] = 'Somthing went wrong.';
		}
		$this->load->view('verify_ip',$data);
	}
	
	/***************************************************************
	 function is use to verify link from email for ip address	
	**************************************************************/ 
	public function verifing(){	
		$token  = $this->security->sanitize_filename($this->input->post('token'));		
		$return = $this->verify_model->get_ip_token($this->security->xss_clean($token));
		if(!empty($return)){
			$return = $this->verify_model->verifing($this->security->xss_clean($return));
			$data['sucs_msg'] = 'Your ip address changed. Try to login again.';			
			$this->load->view("includes/header",$data);
			$this->load->view('login',$data); 		
		}else{			
			$data['content'] = 'Somthing went wrong.';
			$this->load->view('verify_ip',$data);
		}
		
	}
	/***************************************************************
	 function is use to verify link from email for ip address	
	**************************************************************/ 
	public function verifingipaddres(){	
		$data['sucs_msg'] = 'Your ip address changed. Try to login again.';			
		$this->load->view("includes/header",$data);
		$this->load->view('login',$data); 
	}	
	
	
}