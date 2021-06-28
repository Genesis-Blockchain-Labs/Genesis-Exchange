<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	 public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("user_model");
		$this->load->model("authentication_model");
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('googlelib/GoogleAuthenticator');
		
	}

/***************************************
   load view for two face authentication  
*************************************/	
	function index(){
		$data['active_class'] = 'authentication';
		$data['google_auth_class'] = 'display:block';
		$data['twilio_auth_class'] = 'display:none';
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		$gauth = new GoogleAuthenticator();
		$secret = $gauth->createSecret();
		$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
		$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
		$this->load->view('authentication',$data);
	}	
/**********************************
   save google auth code    
**********************************/	
	function save_google_auths($id=""){	   
		$data['active_class'] = 'sec_setting';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));	
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session['user_id']));
		if(!empty($session))
		{
			$data = array();
			$action = ($this->input->post('action')!="") ? $this->security->sanitize_filename($this->input->post('action')): '' ;
			$datas['google_auth_code'] = $data['google_auth_code'] = $this->security->sanitize_filename($this->input->post('google_auth_code'));
			$datas['login_type'] = $data['login_type'] = $this->security->sanitize_filename($this->input->post('login_type'));	

			/*****validate auth****/				
			$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session['user_id']);
			$gauth = new GoogleAuthenticator();
			if(!empty($result['google_auth_code'])){
				$secret = $result['google_auth_code'];
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
			}
			else{
				$secret = $gauth->createSecret();	
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
			}	
			
			$data['id'] = $id; 
			$this->form_validation->set_rules('authcode', 'Authenticate Code', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{	
				$data['active_class'] = 'sec_setting';			
				$this->load->view('security_setting', $data);
			}
			else
			{  	
				$authcode = $this->security->sanitize_filename($this->input->post('authcode'));
				$u_id = $this->security->sanitize_filename($this->input->post('admin_id'));
				$google_auth_code = $this->security->sanitize_filename($this->input->post('google_auth_code'));		        
					$checkResult = $gauth->verifyCode($google_auth_code, $authcode, 2);   // 2 = 2*30sec clock tolerance
					if ($checkResult)
					{ 
							if($action=='disable_auth')
							{
								$this->authentication_model->disable_google_auth($session['user_id']);
								$this->session->set_flashdata('error_msg','Google Authentication has been disabled successfully.');	
							}
							else
							{
								$this->authentication_model->save_google_auth($this->security->xss_clean($datas),$session['user_id']);
								$this->session->set_flashdata('error_msg','Google Authentication has been enabled successfully.');
							}
							redirect('security_setting','refresh');
					}
					else
					{
						$this->session->set_flashdata('error_msgs','Invalid Authentication Code! Please re-scan the QR code to enable secure login.');
						$this->load->view('security_setting',$data);
					}
			 }
		}
		else
		{
			redirect('/');
		}
		
		
	}
/***********************************************	
    save google auth code    
***********************************************/	
	function save_google_auth(){	
		$data['active_class'] = 'authentication';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session))
		{
			$data['google_auth_class'] = 'block';
			$data['twilio_auth_class'] = 'none';
			$session_data['login_type'] = $this->user_model->get_user_auth($session['user_id']);
			$data = array();
			if(!$session_data['login_type']['google_auth_code'])
			{
				$data['google_auth_code'] = $this->security->sanitize_filename($this->input->post('google_auth_code'));
			}
			$data['phone'] = '';
			$data['login_type'] = $this->security->sanitize_filename($this->input->post('login_type'));		
			$this->authentication_model->save_google_auth($this->security->xss_clean($data),$session['user_id']);
			$this->session->set_flashdata('error_msg','Google Authentication has been enabled successfully.');
			
			$gauth = new GoogleAuthenticator();
			$secret = $gauth->createSecret();
			$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
			$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
			$this->load->view('authentication',$data);
		}
		else{
			redirect('/');
		}
	}
/***********************************************
 function is use to view load for auth
***********************************************/
	function verification($id= ''){	
		if(!empty($id)){;
			$this->load->view('verification', array('id' => $id));
		}else{
			redirect('login');
		}
				
	}
/****************************************************
  function is use to authentication user 
***************************************************/
	function auth($id = ""){
		$result = $this->authentication_model->get_user_auth($id);							
		if($result['login_type']=="twilio"){
				$data['id'] = $id; 
				$this->form_validation->set_rules('authcode', 'Authenticate Code', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{				
				$this->load->view('twilio_auth', $data);
			}
			else
			{
					/***gernerate otp and save into db**/
							
								$authcode = $this->security->sanitize_filename($this->input->post('authcode'));
									$u_id = $this->security->sanitize_filename($this->input->post('admin_id'));
									$user = $this->user_model->get_usr_data($this->security->xss_clean($u_id));
									$result['firstname'] = $user['firstname'];	
									$result['lastname'] = $user['lastname'];
									$result['profile_pic'] = $user['profile_pic'];
									$result['email'] = $user['email'];
									$result['id'] = $result['user_id'];
									/**match**/
									$checkResult = $this->authentication_model->check_twilio_code($u_id,$authcode);
										if ($checkResult){
											$check_login_status = $this->authentication_model->check_login_status();
											if($check_login_status)
											{
												if($check_login_status['login_status'] == 1)
												{
													$this->session->set_userdata('user_data',$result);				  
													redirect('dashboard');
												}
												else
												{
													$data['error_msg'] = 'SafeCardano login has been temporarily disabled. Please be patient we will get back to you soon. Stay connected with us.';
													$this->load->view("includes/header",$data);
													$this->load->view('login',$data);
												}
											}
											else
											{
												$this->session->set_userdata('user_data',$result);				  
												redirect('dashboard');
											}
											
											}
										else{
											$this->session->set_flashdata('error_msg','Invalid Authentication Code!');
											redirect('authenticate/'.$u_id,'refresh');
										}
			}
		}
		
		else if($result['login_type']=="google"){
			$gauth = new GoogleAuthenticator();
			$data['id'] = $id; 
			$this->form_validation->set_rules('authcode', 'Authenticate Code', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('Auth', $data);
			}else
			{  	
				$authcode = $this->security->sanitize_filename($this->input->post('authcode'));
				$u_id = $this->security->sanitize_filename($this->input->post('admin_id'));
				$user = $this->user_model->get_usr_data($this->security->xss_clean($u_id));
				$result = $this->authentication_model->get_user_auth($u_id);
				$result['firstname'] = $user['firstname'];	
				$result['lastname'] = $user['lastname'];
				$result['profile_pic'] = $user['profile_pic'];
				$result['email'] = $user['email'];
				$result['id'] = $result['user_id'];
				if(!empty($result))
				{		      
					$checkResult = $gauth->verifyCode($result['google_auth_code'], $authcode, 2);    // 2 = 2*30sec clock tolerance
					if ($checkResult)
					{ 
						$check_login_status = $this->authentication_model->check_login_status();
											if($check_login_status)
											{
												if($check_login_status['login_status'] == 1)
												{
													$this->session->set_userdata('user_data',$result);				  
													redirect('dashboard');
												}
												else
												{
													$data['error_msg'] = 'SafeCardano login has been temporarily disabled. Please be patient we will get back to you soon. Stay connected with us.';
													$this->load->view("includes/header",$data);
													$this->load->view('login',$data);
												}
											}
											else
											{
												$this->session->set_userdata('user_data',$result);				  
												redirect('dashboard');
											}
						
					}
					else
					{
						$this->session->set_flashdata('error_msg','Invalid Authentication Code!');
						redirect('authenticate/'.$u_id,'refresh');
					}
				}
				else
				{
				  redirect('login');
				}
			 }
		}
		else
		{
			$data['id'] = $id;
			$this->session->set_userdata('temp_user_id',$data);			
			$this->form_validation->set_rules('authcode', 'Authenticate Code', 'trim|required');
			if($this->form_validation->run() == FALSE)
			{				
				$this->load->view('email_auth', $data);
			}
			else
			{
					
							
								$authcode = $this->security->sanitize_filename($this->input->post('authcode'));
									$temp_user_id = $this->session->userdata('temp_user_id');
									$u_id = $temp_user_id['id'];	
									$user = $this->user_model->get_usr_data($this->security->xss_clean($u_id));
									$result['firstname'] = $user['firstname'];	
									$result['lastname'] = $user['lastname'];
									$result['profile_pic'] = $user['profile_pic'];
									$result['email'] = $user['email'];
									$result['id'] = $result['user_id'];
									
									$user_detail_code = $this->authentication_model->get_user_auth($id);
									$close_date = date("Y-m-d H:i:s", strtotime($user_detail_code['mail_authetication_date'] . "+30 minutes"));
									$date = date('Y-m-d H:i:s');
									if($date < $close_date)
									{
										$checkResult = $this->authentication_model->check_authetication_code($u_id,$authcode);
										if ($checkResult){
											$check_login_status = $this->authentication_model->check_login_status();
											if($check_login_status)
											{
												if($check_login_status['login_status'] == 1)
												{
													$this->session->unset_userdata('temp_user_id');
													$this->session->set_userdata('user_data',$result);
													redirect('dashboard');
												}
												else
												{
													$data['error_msg'] = 'SafeCardano login has been temporarily disabled. Please be patient we will get back to you soon. Stay connected with us.';
													$this->load->view("includes/header",$data);
													$this->load->view('login',$data);
												}
											}
											else
											{
												$this->session->unset_userdata('temp_user_id');
												$this->session->set_userdata('user_data',$result);
												redirect('dashboard');
											}											
											
											}
										else{
											
											$this->session->set_flashdata('error_msg','Invalid verification code (remember they are cAsE sEnSiTiVe)! If it has been over 30 minutes since your code was sent you will need to log in again.');
											redirect('authenticate/'.$u_id,'refresh');
										}
									}
									else
									{
										$this->session->set_flashdata('error_msg','Invalid verification code (remember they are cAsE sEnSiTiVe)! If it has been over 30 minutes since your code was sent you will need to log in again.');
										redirect('authenticate/'.$u_id,'refresh');
									}
			}
			
			
		}
	}	
	
/************************************************
   save twilio auth type   
************************************************/   
	function save_twilio_auth(){	
		$data['active_class'] = 'authentication';
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session)){
			$session_data['login_type'] = $this->user_model->get_user_auth($session['user_id']);
			$this->form_validation->set_rules('phone', '', 'required|numeric');
			$data['google_auth_class'] = 'none';
			$data['twilio_auth_class'] = 'block';
			if ($this->form_validation->run() == FALSE){
				$this->load->view('authentication',$data);
			}else{			
				if(!$session_data['login_type']['phone']){
					$update_data['phone'] = $this->security->sanitize_filename($this->input->post('phone'));
				} 
				$update_data['google_auth_code'] = '';
				$update_data['login_type'] = $this->security->sanitize_filename($this->input->post('login_type'));
				$this->authentication_model->save_google_auth($this->security->xss_clean($update_data),$session['user_id']);
				$this->session->set_flashdata('error_msg','Twilio authentication save.');
				$data['google_auth']['auth_url'] = '';
				$data['google_auth']['auth_code'] = '';
				$this->load->view('authentication',$data);
			}
		}else{
			redirect('/');
		}
	}
	
	function twiliomessage($id='')
	{
		$data['active_class'] = 'sec_setting';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));	
		$data['user'] = $this->user_model->get_usr_data($this->security->xss_clean($session['user_id']));
		if(!empty($session)){
			if(isset($_POST['twilio_msg']))
			{
					$data = array();
							$datas['google_auth_code'] = $data['google_auth_code'] = $this->security->sanitize_filename($this->input->post('google_auth_code'));
							$datas['login_type'] = $data['login_type'] = $this->security->sanitize_filename($this->input->post('login_type'));
							
							$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session['user_id']);
									$gauth = new GoogleAuthenticator();
								if(!empty($result['google_auth_code'])){
									
									$secret = $result['google_auth_code'];
									$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
									$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
								}
								else
								{
									$secret = $gauth->createSecret();	
									$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
									$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
								}	
							$data['id'] = $id;
							$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|regex_match[/^[0-9]{12}$/]');
							$this->form_validation->set_message('regex_match', 'Please enter valid mobile number.');
							if($this->form_validation->run() == FALSE)
							{					
								$data['active_class'] = 'sec_setting';
								$this->load->view('security_setting', $data);
							}else{
									$mobile_no = $this->security->sanitize_filename($this->input->post('mobile_no'));
									$token = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
									$data1 = $this->send_sms($token,$mobile_no);
									$this->authentication_model->save_twilio_token($session['user_id'],$token,$mobile_no);
									$this->session->set_flashdata('error_msgs_phone','The OTP has been sent to your mobile number. Use that OTP for secure your account with Twilio.');
									$data['sent_message'] = 'sent_message';
									$this->load->view('security_setting', $data);	
								}
			}
			else
			{
				
				$data = array();
				$action = ($this->input->post('action')!="") ? $this->security->sanitize_filename($this->input->post('action')): '' ;
				$datas['google_auth_code'] = $data['google_auth_code'] = $this->security->sanitize_filename($this->input->post('google_auth_code'));
				$datas['login_type'] = $data['login_type'] = $this->security->sanitize_filename($this->input->post('login_type'));	

								/*****validate auth****/
									$data['is_exist_auth'] = $result = $this->authentication_model->get_user_auth($session['user_id']);
									$gauth = new GoogleAuthenticator();
								if(!empty($result['google_auth_code'])){
									$secret = $result['google_auth_code'];
									$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
									$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$result['google_auth_code']);
								}
								else{
									$secret = $gauth->createSecret();	
									$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['email'], $secret,DOMAIN_NAME);
									$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
								}	
								$data['id'] = $id; 
								$this->form_validation->set_rules('authcode_twilio', 'Authenticate Code', 'trim|required');
								
								if($this->form_validation->run() == FALSE){
									$data['active_class'] = 'sec_setting';
									$this->load->view('security_setting', $data);
								}else{  	
									$authcode = $this->security->sanitize_filename($this->input->post('authcode_twilio'));
									$u_id = $this->security->sanitize_filename($this->input->post('admin_id'));
									$google_auth_code = $this->security->sanitize_filename($this->input->post('google_auth_code'));	     			
									$checkResult = $this->authentication_model->check_twilio_code($session['user_id'],$authcode);
										if ($checkResult)
										{ 
												if($action=='disable_auth')
												{
													$this->authentication_model->disable_google_auth($session['user_id']);
													$this->session->set_flashdata('error_msg','Twilio Authentication has been disabled now.');	
												}
												else
												{
												$this->authentication_model->save_google_auth($this->security->xss_clean($datas),$session['user_id']);
												$this->session->set_flashdata('error_msg','Twilio Authentication has been enabled successfully.');
											}
												redirect('security_setting','refresh');
										}
										else
										{
											$this->session->set_flashdata('error_msgs','Invalid Authentication Code!');
											$this->load->view('security_setting',$data);
										}
								 }
		}
		}else{
			redirect('/');
		}
	}
	/************************************************
		Function for sending messages using twilio
    ***********************************************/
	public function send_sms($message, $contn)
	{
		$contno='+'.$contn;	
	    include APPPATH.'/libraries/twiliolib/Twilio.php';
		$account_sid = ACCOUNT_SID;
	    $auth_token = AUTH_TOKEN;
	    $client = new Services_Twilio($account_sid, $auth_token);
	    $people = array(
            $contno => $contno
   		);
		foreach ($people as $number => $name)
	   		{
		        $sms = $client->account->messages->sendMessage(
			"+442891042496",$number,"Your SafeCardano authentication code is: ".$message);

		}
		
 	}
	
}