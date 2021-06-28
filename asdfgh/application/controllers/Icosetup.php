<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Icosetup extends CI_Controller {
	function __construct(){
		
      parent::__construct();
      $this->load->model('user_model');
	  $this->load->model('ico_model');
      $this->load->library('form_validation');
      $this->load->library('pagination'); 
	  $this->load->helper('security');
	  $this->load->library('GoogleAuthenticator');
    }
	/***********************************************************
			function used for load ico setup view
	************************************************************/
	public function index()
	{
		$data['pro_ico'] = $this->ico_model->check_ico('pre_ico');
		$data['ico'] = $this->ico_model->check_ico_list('ico');
		$data['last_stage'] = $this->ico_model->last_stage('ico');
		$this->load->template('ico_setup',$data);
	}
	function numeric_decimal ($str)
	{
   if(preg_match('/^[0-9.]+$/', $str))
   {
	   return true;
   }
   else{
	   $this->form_validation->set_message('numeric_decimal', 'Only numbers are allowed in this field.( No special characters)');
	   return false;
   }
	}
	/***********************************************************
		function used for pre ico detail insert update
	************************************************************/
	public function pre_ico_setting()
	{
		$datas['pro_ico'] = $this->ico_model->check_ico('pre_ico');
		$datas['ico'] = $this->ico_model->check_ico_list('ico');
		$this->form_validation->set_rules('details', '', 'required');
		$this->form_validation->set_rules('start_date', '', 'required');
		$this->form_validation->set_rules('end_date', '', 'required');
		$this->form_validation->set_rules('token_supply', '', 'required');
		$this->form_validation->set_rules('token_price', '', 'required|callback_numeric_decimal');
		$this->form_validation->set_rules('extra_bonus', '', 'required');
		$this->form_validation->set_rules('dollar_to_safeada', '', 'required');
		if($this->form_validation->run() == FALSE){				
			$this->load->template('ico_setup',$datas); 
			
		}else{
		
			$data['details'] = $this->security->sanitize_filename($this->input->post('details'));	
			$data['start_date'] = $start_date = $this->input->post('start_date');	
			$data['end_date'] = $end_date = $this->input->post('end_date');
			$data['token_supply'] = $this->security->sanitize_filename($this->input->post('token_supply'));
			$data['token_price'] = $this->security->sanitize_filename($this->input->post('token_price'));
			$data['extra_bonus'] = $this->security->sanitize_filename($this->input->post('extra_bonus'));
			$data['dollar_to_safeada'] = $this->security->sanitize_filename($this->input->post('dollar_to_safeada'));
			$data['ico_type'] = $ico_type =  $this->security->sanitize_filename($this->input->post('ico_type'));
			
			$check_ico = $this->ico_model->check_ico($ico_type);
			$id = $check_ico['id'];
			if(!empty($check_ico)){
			$response = $this->ico_model->update_ico($id,$data);
			}else{
				$response = $this->ico_model->insert_ico($data);
			}
			$this->session->set_flashdata('success_msg', 'Details saved.');
			$datas['pro_ico'] = $this->ico_model->check_ico('pre_ico');
			$datas['ico'] = $this->ico_model->check_ico('ico');
			$this->load->template('ico_setup',$datas); 
		}
	}
	
	/***********************************************************
		function used for ico detail insert update
	************************************************************/
	public function ico_setting()
	{
		$datas['pro_ico'] = $this->ico_model->check_ico('pre_ico');
		$datas['ico'] = $this->ico_model->check_ico_list('ico');
		$datas['last_stage'] = $this->ico_model->last_stage('ico');
		$datas['tab'] = 'ico';
		$form_count = count($this->input->post('detailss'));
		
		$datas['total_fields'] = $form_count;
		$this->form_validation->set_rules('detailss[]', '', 'required');
		$this->form_validation->set_rules('start_dates[]', '', 'required');
		$this->form_validation->set_rules('end_dates[]', '', 'required');
		$this->form_validation->set_rules('token_supplys[]', '', 'required');
		$this->form_validation->set_rules('token_prices[]', '', 'required');
		$this->form_validation->set_rules('extra_bonuss[]', '', 'required');
		$this->form_validation->set_rules('stages[]', '', 'required');
		if($this->form_validation->run() == FALSE){				
			$this->load->template('ico_setup',$datas); 
		}else{
			$details = $this->input->post('detailss');
			$start_date = $this->input->post('start_dates');	
			$end_date = $this->input->post('end_dates');
			$token_supply = $this->input->post('token_supplys');
			$token_price = $this->input->post('token_prices');
			$extra_bonus = $this->input->post('extra_bonuss');
			$stages =  $this->input->post('stages');
			$ico_setup_id = $this->input->post('ico_setup_id');
			$ico_stage = $this->input->post('ico_stage');
			
			for($i = 0; $i < $form_count; $i++)
			{
				$data['details'] = $this->security->sanitize_filename($details[$i]);
				$data['start_date'] = $start_date[$i];
				
				$data['end_date'] = $end_date[$i];
				$data['token_supply'] = $this->security->sanitize_filename($token_supply[$i]);
				$data['token_price'] = $this->security->sanitize_filename($token_price[$i]);
				$data['extra_bonus'] = $this->security->sanitize_filename($extra_bonus[$i]);
				$data['stages_title'] =  $this->security->sanitize_filename($stages[$i]);
				$data['ico_type'] = $ico_type =  $this->security->sanitize_filename($this->input->post('ico_type'));
				$data['stages'] =  $this->security->sanitize_filename($ico_stage[$i]);
				if(isset($ico_setup_id[$i]))
				{
					$response = $this->ico_model->update_ico($ico_setup_id[$i],$data);
					$this->session->set_flashdata('success_msg', 'Stages updated successfully.');
				}
				else
				{
					$response = $this->ico_model->insert_ico($data);
					$this->session->set_flashdata('success_msg', 'Stages added successfully.');
				}
			}
			$datas['pro_ico'] = $this->ico_model->check_ico('pre_ico');
			$datas['ico'] = $this->ico_model->check_ico_list('ico');
			$datas['last_stage'] = $this->ico_model->last_stage('ico');
			$this->load->template('ico_setup',$datas);
			
		}
	}
	
	/***********************************************************
		function used for website setup view
	************************************************************/
	function website_setup()
	{
		$data['admin_setup'] = $this->ico_model->admin_setup();
		$this->load->template('website_setup',$data);
	}
	/***********************************************************
		function used for website setup on/off
	************************************************************/
	function website_setup_update()
	{
		$website_status = $this->security->sanitize_filename($this->input->post('website_status'));
		$data = array('website_status' => $website_status);
		$this->ico_model->website_status($data);
		$this->session->set_flashdata('success_msg',success_message('Status updated successfully.'));
		redirect('website_setup');
		
	}
	/***********************************************************
		function used for allow user login view
	************************************************************/
	function login_setup()
	{
		$data['admin_setup'] = $this->ico_model->admin_setup();
		$this->load->template('login_setup',$data);
	}
	
	/***********************************************************
		function used for website setup on/off
	************************************************************/
	function login_setup_update()
	{
		$login_status = $this->security->sanitize_filename($this->input->post('login_status'));
		$data = array('login_status' => $login_status);
		$this->ico_model->website_status($data);
		$this->session->set_flashdata('success_msg',success_message('Status updated successfully.'));
		redirect('login_setup');
		
	}
	
	/***********************************************************
		function used for allow user login view
	************************************************************/
	function register_setup()
	{
		$data['admin_setup'] = $this->ico_model->admin_setup();
		$this->load->template('register_setup',$data);
	}
	
	/***********************************************************
		function used for website setup on/off
	************************************************************/
	function register_setup_update()
	{
		$register_status = $this->security->sanitize_filename($this->input->post('register_status'));
		$data = array('register_status' => $register_status);
		$this->ico_model->website_status($data);
		$this->session->set_flashdata('success_msg',success_message('Status updated successfully.'));
		redirect('register_setup');
		
	}
	
	/***********************************************************
		function used for allow user login view
	************************************************************/
	function activate_setup()
	{
		$data['admin_setup'] = $this->ico_model->admin_setup();
		$this->load->template('activation_email_setup',$data);
	}
	
	/***********************************************************
		function used for website setup on/off
	************************************************************/
	function activate_setup_update()
	{
		$activation_email_status = $this->security->sanitize_filename($this->input->post('activation_email_status'));
		$data = array('activation_email_status' => $activation_email_status);
		$this->ico_model->website_status($data);
		$this->session->set_flashdata('success_msg',success_message('Status updated successfully.'));
		redirect('activate_setup');
		
	}
	
	/***********************************************************
		function used for login attempt view
	************************************************************/
	function attempt_setup()
	{
		$data['admin_setup'] = $this->ico_model->admin_setup();
		$this->load->template('login_attempt_setup',$data);
	}
	
	/***********************************************************
		function used for website setup on/off
	************************************************************/
	function attempt_setup_update()
	{
		$login_failed_limit = $this->security->sanitize_filename($this->input->post('login_failed_limit'));
		$data = array('login_failed_limit' => $login_failed_limit);
		$this->ico_model->website_status($data);
		$this->session->set_flashdata('success_msg',success_message('Status updated successfully.'));
		redirect('attempt_setup');
		
	}
}