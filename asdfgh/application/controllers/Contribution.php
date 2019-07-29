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
	
	/******************************************************
		Function is use to save and update contribution
	*****************************************************/
	function update_contribution($id){   
		$user_id = $this->security->sanitize_filename($this->input->post('user_id'));
		$data = array();
		if(!empty($this->security->sanitize_filename($this->input->post('contribution_amount')))){
			$data['contribution_amount']  = $this->security->sanitize_filename($this->input->post('contribution_amount'));
		}else{
			$data['contribution_amount'] = '';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('bonus')))){
			$data['bonus'] = $this->security->sanitize_filename($this->input->post('bonus'));
		}else{
			$data['bonus'] = '0';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('total_coins')))){
			$data['total_coins'] = $this->security->sanitize_filename($this->input->post('total_coins'));
		}else{
			$data['total_coins'] = '';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('contributed_currency')))){
			$data['contributed_currency'] = $this->security->sanitize_filename($this->input->post('contributed_currency'));
		}else{
			$data['contributed_currency'] = '';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('transaction_id')))){
			$data['transaction_id'] = $this->security->sanitize_filename($this->input->post('transaction_id'));
		}else{
			$data['transaction_id'] = '';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('contribution_in_dollar')))){
			$data['contribution_in_dollar'] = $this->security->sanitize_filename($this->input->post('contribution_in_dollar'));
		}else{
			$data['contribution_in_dollar'] = '';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('referral_bonus_percentage')))){
			$data['referral_bonus_percentage'] = $this->security->sanitize_filename($this->input->post('referral_bonus_percentage'));
		}else if($this->input->post('referral_bonus_percentage') == '0'){
			$data['referral_bonus_percentage'] = '0';
		}else{
			$data['referral_bonus_percentage'] = '10';
		}
		
		if(!empty($this->security->sanitize_filename($this->input->post('status')))){
			$data['contribute_status'] = $this->security->sanitize_filename($this->input->post('status'));
		}
		
		  	
		$refered_id = $this->security->sanitize_filename($this->input->post('refered_id'));
		$back = $this->contribution_model->update_contribution($user_id,$this->security->xss_clean($data),$refered_id);
		
		if($back){
			$return = array('C'=>100,'M'=>'Save successfully');
		}else{
			$return = array('C'=>101,'M'=>'Not save');
		}
		
		redirect('kyc_detail/'.$user_id); 
	} 

	/******************************************************
		function is use to chage the status of investment
	*****************************************************/
	function change_status(){
		$id = $this->security->sanitize_filename($this->input->post("user_id"));
		$status = $this->security->sanitize_filename($this->input->post("status"));
		$this->contribution_model->change_status($id,$status);
	}

	
	
}

