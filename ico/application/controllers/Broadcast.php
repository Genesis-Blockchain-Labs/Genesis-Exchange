<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model('Transaction_model');
		$this->load->library('pagination'); 
		
	}
	/**************************************
	FUNCTION TO GET THE TRANSACTION DETAIL
	**************************************/	 
	public function index(){
		$data['active_class'] = "transaction_detail";		
		 $session_data = $this->security->xss_clean($this->session->userdata('user_data'));	
		$user_id = $this->security->xss_clean($session_data['user_id']);
		/***pagination**/
			$config = array();
			$config["base_url"] = base_url() . "transaction_detail";
			$total_row = $this->Transaction_model->get_count($user_id);
			$config["total_rows"] = $total_row['total'];
			$config["per_page"] = 10;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $total_row['total'];
			$config['cur_tag_open'] = '&nbsp;<a class="current">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';

			$this->pagination->initialize($config);
			if($this->uri->segment(2)){
			$page = ($this->uri->segment(2));
			$page = $page - 1;
			$page = $page * 10;
			}
			else{
			$page = 0;
			}
		
		/**end**/
		$data['transaction_detail'] = $this->Transaction_model->transaction_detail($this->security->xss_clean($config["per_page"]),$this->security->xss_clean($page), $this->security->xss_clean($user_id)); 
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );	
		$this->load->view('transaction',$data);
	}
}