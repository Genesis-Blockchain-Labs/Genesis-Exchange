<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Access_history extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model("user_model");
		$this->load->library('session');
		$this->load->library('pagination'); 
		
	}

	/*************	access history page    ************/	 
	public function index(){
		$data['active_class'] = 'acc_hist';
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$user_id = $this->security->xss_clean($session_data['id']);
			/***pagination**/
			$config = array();
			$config["base_url"] = base_url() . "access_history";
			$total_row = $this->user_model->get_usr_loghistory_count($this->security->xss_clean($user_id));
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
		$data['history'] = $this->user_model->get_usr_loghistory($this->security->xss_clean($config["per_page"]),$this->security->xss_clean($page), $this->security->xss_clean($user_id)); 
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );	
		$this->load->view('access_history',$data);   
	}
}