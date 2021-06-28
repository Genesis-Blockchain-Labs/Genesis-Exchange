<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {
	 public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("user_model");
		$this->load->model("contact_model");
		$this->load->model("authentication_model");
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('googlelib/GoogleAuthenticator');
		
	}
	
/*****************************************************
 FUNCTION IS USE TO SAVE THE CONTACT DETAIL OF USERS
******************************************************/ 
	public function save_contact(){
		$this->form_validation->set_rules('name', '', 'trim|required');
		$this->form_validation->set_rules('email', '', 'trim|required');
		$this->form_validation->set_rules('subject', '', 'trim|required');
		$this->form_validation->set_rules('message', '', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('index');
		}
		else
		{ 		
			$data['name'] = $this->security->sanitize_filename($this->input->post('name'));
			$data['email'] = $this->security->sanitize_filename($this->input->post('email'));
			$data['subject'] = $this->security->sanitize_filename($this->input->post('subject'));
			$data['message'] = $this->security->sanitize_filename($this->input->post('message'));			
			$return = $this->contact_model->save_contact($data);
			if($return)
			{
				$this->session->set_flashdata('success','Your infomation saved.');
				$this->load->view('index'); 
			}
			else
			{
				$this->session->set_flashdata('error','Your infomation not saved.');
				$this->load->view('index'); 
			}
		}
	}
	
	
	
}