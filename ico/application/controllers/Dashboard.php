<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("Dashboard_model");
		$this->load->model("user_model");
		$this->load->model("Referral_model");
		$this->load->model("authentication_model");	
		$this->load->model("invest_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->library('pagination');
		
		$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');
		$this->load->library('googlelib/GoogleAuthenticator');
	}
	
	/*********************************************************  
	FUNCTION IS USE USE TO GET DATA OF USER FOR DASHBOARD PAGE
	**********************************************************/
	public function dashboard(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['active_class'] = 'dashboard';
		if(!empty($session_data))
		{
			$data['active_class'] = 'dashboard';
			$user_id = $session_data['user_id'];
			$refernce_id = $session_data['reference_id'];
			$data['get_user_info'] = $this->Dashboard_model->soft_delete($this->security->xss_clean($user_id));
			$data['total_referral'] = $this->Dashboard_model->total_referral($this->security->xss_clean($refernce_id));
			$percentage = $data['contribution']['referral_bonus_percentage'];
			$data['refrel_usr'] = $this->Referral_model->refrel_usr($this->security->xss_clean($percentage),$this->security->xss_clean($refernce_id));
			$data['count_refrel_usr'] = $this->Dashboard_model->count_refrel_usr($this->security->xss_clean($refernce_id)); 		
			$data['referel_total_invst'] = $this->Referral_model->referel_total_invst($refernce_id);
			$data['total_site_coins'] = $this->Dashboard_model->total_ref_coins();
			//$data['total_invested_user'] = $this->Dashboard_model->total_invested_user();
			$data['total_invested'] = $this->Dashboard_model->total_invest();
			$data['percentage'] = $this->Dashboard_model->ico();
			$data['ico_setup'] = $this->invest_model->ico_setup_data('pre_ico');
			$this->load->view('new_dashboard',$data);
		} 
		else 
		{
			redirect('login');
		} 
	}
	
	/*********************************  
	FUNCTION IS USE contribution PAGE
	*********************************/	
	public function contribution_view(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data))
		{
			$data['reward_point'] = $this->user_model->reward_point($this->security->xss_clean($session_data['user_id']));
			$this->load->view('contribution',$data);
		}
		else
		{
			redirect('login');
		} 
	}
	
	/**************************************** 
	FUNCTION IS USE SUBMIT contribution
	****************************************/
	function submit_contribution(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
        if(!empty($session_data))
		{
			$data['reward_point'] = $this->user_model->reward_point($session_data['user_id']);
			if(empty($this->input->post()))
			{
				redirect('dashboard');
			}
			else
			{				
				$url =$this->security->sanitize_filename($this->input->post('url'));
				$this->form_validation->set_rules('type', '', 'required');
				if(empty($this->input->post('url')) && empty($this->input->post('file'))){
					$this->form_validation->set_rules('url', '', 'callback_check_url_file');
					$data['validation_error'] = 'You must select at least one field from url or file.';	
					$this->load->view('contribution',$data);			
				}
				if ($this->form_validation->run() == FALSE){
					$this->load->view('contribution',$data);
				}else{
					
				}
			}				
		}
		else
		{
			redirect('/');
		}
	}

	/**************************************************
	 FUNCTION IS USE VALIDATE CONTRIBUTION URL AND FILE 
	***************************************************/ 
	function check_url_file(){
		$this->form_validation->set_message('check_url_file','You must select at least one field from url or file.');
		return false;
	}	
	
	/*************************************************
	  FUNCTION IS USE UPLOAD contribution image	
	*************************************************/  
	function image_contribution(){	
		if(!empty($_FILES['file']['name'])){
			$file_name = $_FILES['file']['name'];
			$file_name = time().$_FILES["file"]['name'];
			$file_size = $_FILES['file']['size'];
			$file_tmp  = $_FILES['file']['tmp_name'];
			$file_type = $_FILES['file']['type'];
			$config['file_name'] = $file_name;

			$config['upload_path']          = './uploads/contribution/';
			$config['max_size']             = 2048;
			$config['allowed_types']        = 'png|PNG|jpg|jpeg|gif|xlsx|doc|docx|ppt|pptx|txt|pdf'; 
			$this->load->library('upload', $config);                 	
			if(!$this->upload->do_upload('file')){  
				$this->form_validation->set_message('image_contribution','The File size has been exceeded by 2mb. Max Size should upto 2mb.');
				return false;
			} else { 
				$image = $this->upload->data('file_name');
				$this->session->set_userdata('image_contribution',$image);
				return true;
			}
		}else{
			 $this->form_validation->set_message('image_contribution', "No file selected");
			 return false;
		}
	}

	function invest(){
			$this->load->view('invest');
		}
		
	/*******************************************
	  FUNCTION IS USE contribution PAGE	
	********************************************/  
	public function profile_view(){   
		$data['active_class'] = 'profile';
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
		if(!empty($session_data))
		{	
			$this->load->view('profile',$data);
		}
		else
		{
			redirect('login');
		} 
	}
	/*************************************
	  FUNCTION IS USE contribution PAGE	
	**************************************/  
	public function setting(){	
		$data['active_class'] = 'sec_setting';
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
		if(!empty($session_data)){
			/***google auth|***/
			$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session_data['user_id']);
			$gauth = new GoogleAuthenticator();
			if(!empty($result['google_auth_code'])){
				$secret = $result['google_auth_code'];
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
			}
			else
			{
				$secret = $gauth->createSecret();	
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
			}	
			/***end**/
			$this->load->view('security_setting',$data);
		}else{
			redirect('login');
		} 
	}

	/***************************************
	  FUNCTION IS USE UPDATE PROFILE	
	****************************************/  
	public function update_profile(){
		$data['active_class'] = 'sec_setting';
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
		$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session_data['user_id']);
			$gauth = new GoogleAuthenticator();
			if(!empty($result['google_auth_code'])){
				$secret = $result['google_auth_code'];
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
			}
			else{
				$secret = $gauth->createSecret();	
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
			}	
		if(!empty($session_data)){
			$this->form_validation->set_rules('old_password', '', 'required|callback_check_old_password');
			$this->form_validation->set_rules('New-password', '', 'trim|required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('Repeat-Password', '', 'required|matches[New-password]');
			if($this->form_validation->run() == FALSE){				
				$this->load->view('security_setting',$data); 
			}
			else
			{
			
				$data['password'] = $this->security->sanitize_filename($this->input->post('New-password'));	
				$data['user_id'] = $this->security->xss_clean($session_data['user_id']);
				$response = $this->user_model->update_pass($data);
				$this->sendEmail($data);				
				$this->session->set_flashdata('error_msg','Your password updated successfully.');
				redirect('security_setting');
			}
		}
		else
		{
			redirect('login');
		} 
	}
	/*******************************************
	Function for update personal information
	******************************************/
	public function update_info(){
		$data['active_class'] = 'profile';
		$uplod = array();
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
		$user = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
		$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session_data['user_id']);
		$gauth = new GoogleAuthenticator();
		if(!empty($result['google_auth_code'])){
			$secret = $result['google_auth_code'];
			$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
			$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
		}else{
			$secret = $gauth->createSecret();	
			$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session_data['email'], $secret,DOMAIN_NAME);
			$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
		}	
		if(!empty($session_data))
		{
				if(!empty($_FILES['profile_pic']['name'])){
					$uplod['file_name'] = time().str_replace(" ","_",$_FILES["profile_pic"]['name']);
					$uplod['file_size'] = $_FILES['profile_pic']['size'];
					$uplod['file_tmp']  = $_FILES['profile_pic']['tmp_name'];
					$uplod['file_type'] = $_FILES['profile_pic']['type'];
					$res = $this->upload_profie_pic($uplod);   
					if($res==1)
					{  
						$datas['profile_pic'] = $uplod['file_name'];  
					}
					else
					{
						$this->session->set_flashdata('error_msgs','The File size has been exceeded by 5mb. Max Size should upto 5mb.');
					$this->load->view('profile',$data); 
					return false;
					}
				}
				$datas['phone'] = $this->security->xss_clean($this->input->post('phone'));				
				$user_id = $this->security->xss_clean($session_data['user_id']);
				$response = $this->user_model->update_information($datas,$user_id);
				$data['user'] = $user_data = $this->user_model->get_usr_data($this->security->xss_clean($session_data['user_id']));
				$user_data['user_id'] = $user_data['id'];
				$this->session->set_userdata('user_data',$user_data);				
				$this->session->set_flashdata('error_msg','Your personal information updated successfully.');
				redirect('profile');
		}
		else
		{
			redirect('login');
		} 
	}
	/***************************************************
	   FUNTION for check email allready exist   
	 **************************************************/	
	public function email_check(){ 
		$email = $this->security->sanitize_filename($this->input->post('email'));
		$check_email = $this->check_model->check_email($this->security->xss_clean($email));
		if(!empty($check_email)){
			$this->form_validation->set_message('email_check','The email you enter is already taken.');
			return false;
		}
		else
		{
			return true;
		}
	} 
	/**************************************
		FUNTION for upload profile pic
	**************************************/
	public function upload_profie_pic($data){
			$file_name = $data['file_name'];
			$file_size = $data['file_size'];
			$file_tmp  = $data['file_tmp'];
			$file_type = $data['file_type'];
			$config['file_name'] = $file_name;
			$config['upload_path']          = './uploads/profile_pic/';
			$config['max_size']             = 5120;
			$config['allowed_types']        = 'png|PNG|jpg|jpeg|gif'; 
			$this->load->library('upload', $config);    
   
			$this->upload->do_upload('profile_pic');
		
			if(!$this->upload->do_upload('profile_pic')){  
			
				$this->form_validation->set_message('profile_pic','The File size has been exceeded by 5mb. Max Size should upto 5mb.Please upload  only image');
				return false;
			} else { 
				$image = $this->upload->data('file_name');
				$this->session->set_userdata('profile_pic',$image);
				return true;
			}
}

	/******************************************
	   FUNCTION for check old password 
	******************************************/	
	public function check_old_password(){ 
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$password = $this->security->sanitize_filename($this->input->post('old_password'));			
			$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
			$response = $this->check_model->check_id($this->security->xss_clean($session_data['user_id']));			
			$decrypted = UnsafeCrypto::decrypt($response['password'], $key, true);			
			if($decrypted != $password)
			{
				$this->form_validation->set_message('check_old_password','The old password does not match.');
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			redirect('login');
		} 
	}
	
	/*****************************************   
	FUNTION for check old password for json  
	****************************************/	
	public function check_password(){ 
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
			$password = $this->security->sanitize_filename($this->input->post('old_password'));			
			$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
			$response = $this->check_model->check_id($this->security->xss_clean($session_data['user_id']));			
			$decrypted = UnsafeCrypto::decrypt($response['password'], $key, true);		
			if($decrypted != $password){
				echo json_encode(array('status'=>0));
			}
			else
			{
				echo json_encode(array('status'=>1));
			}
		}
	/******************************************   
	FUNTION for support page   
	********************************************/	
	public function support_page(){ 
			$data['active_class'] = 'support';
			$this->load->view('supports',$data);
		}
	/**************************************************************
		Function used for support view
	***************************************************************/
	public function supports()
		{
			$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
			$data['active_class'] = 'support';
			/*pagination*/
			$config = array();
			$config["base_url"] = base_url()."supports";
			$total_row = $this->Dashboard_model->get_count($this->security->xss_clean($session_data['user_id']));
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
			/*end*/
			$data['support_questions'] = $this->Dashboard_model->supportList($this->security->xss_clean($config["per_page"]),$this->security->xss_clean($page),$this->security->xss_clean($session_data['user_id']));
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );
			$this->load->view('support_us',$data);
		}
		/**************************************************************
				function used for send support request
		***************************************************************/
		function sendSupports()
		{
			$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
			$data['subject'] = $this->security->xss_clean($this->input->post('subject'));
			$data['message'] = $this->security->xss_clean($this->input->post('message'));
			$data['user_id'] = $this->security->xss_clean($session_data['user_id']);
			$response = $this->Dashboard_model->sendSupports($this->security->xss_clean($data),$this->security->xss_clean($session_data['user_id']));
			$this->session->set_flashdata('success_msg','Your message send successfully.');
			redirect('supports');
		}
		/******************************************************
			Function to get the support chat detail
		*******************************************************/	
		function supportDetail($id)
		{
			$data['support_question'] = $this->Dashboard_model->supportQuestion($this->security->xss_clean($id));
			$data['support_reply'] = $this->Dashboard_model->supportReply($this->security->xss_clean($id));
			$this->load->view('support_us_detail',$data);
		}
		/****************************************************
			Function to send the reply to the admin
		***************************************************/
		function sendReply()
		{
			$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
			$data['ticket_no'] = $this->security->xss_clean($this->input->post('ticket_no'));
			$data['message'] = $this->security->xss_clean($this->input->post('message'));
			$data['user_id'] = $this->security->xss_clean($session_data['user_id']);
			$this->Dashboard_model->sendReply($this->security->xss_clean($data));
			redirect("supportDetail/".$data['ticket_no']);
		}
		/*********************************************
		Function to send eamil for change passoword
		*********************************************/
		function sendEmail($data){
			$userdata = $data['user'];
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($userdata['firstname'], $userdata['email']);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $userdata['firstname']);
		$temp_id = '9b1f7b45-d145-4876-be73-971951e79525';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		}
		
	/*******************************************
	  FUNCTION IS USE  for broadcast PAGE	
	*******************************************/ 
	public function broadcast_message($id){ 
	
		$data['user'] = $this->Dashboard_model->get_broad_message($this->security->xss_clean($id));
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		
		if(!empty($session_data))
		{	
			
			$this->load->view('broadcast_message',$data);
		}
		else
		{
			redirect('dashboard');
		} 
	} 
	
	
	/*******************************************
	  FUNCTION IS USE  for broadcast message list 	
	*******************************************/ 
	public function broadcast_list(){ 
	 
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));	
		 
		$user_id = $this->security->xss_clean($session_data['user_id']);
		
		/***pagination**/
			$config = array();
			
			$config["base_url"] = base_url() . "broadcastlist";
			 
			$total_row = $this->Dashboard_model->get_count_list();
			$config["total_rows"] = $total_row[0]->total;
			$config["per_page"] = 10;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] =  $total_row[0]->total;
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
			
		
		$data["user"] = $this->Dashboard_model->get_broadcast_list($this->security->xss_clean($config["per_page"]),$this->security->xss_clean($page), $this->security->xss_clean($user_id)); 
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$data['pages'] = $page;		
		if(!empty($session_data))
		{	
			$this->load->view('broadcast_list',$data);
		}
		else
		{
			redirect('dashboard');
		} 
	}
	/*******************************************
	  FUNCTION IS USE  for hide bedge	
	*******************************************/ 	
	function hide_bedge()
	{
		$user_id = $this->security->xss_clean($this->input->post('id'));
		$data = $this->Dashboard_model->hide_bedge($this->security->xss_clean($user_id));
		echo json_decode(array('data'=>$data));
	}
	
	
}
