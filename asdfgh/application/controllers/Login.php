<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('a_login');
		$this->load->model('ip_model');
		$this->load->library('encrypt');
		
		$this->session->keep_flashdata('message');
		$this->load->helper('security');
	}

	/***********************************
			login function 
	***********************************/
	function index()
	{ 
		$this->form_validation->set_rules('username', 'username', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->load->view('a_login');
		}else{
			$data['username'] = $this->security->sanitize_filename($this->input->post('username'));
			$data['password'] = $this->security->sanitize_filename($this->input->post('password'));
			$result = $this->a_login->login($this->security->xss_clean($data));
			$ipAddress = $this->input->ip_address();
			if(!empty($ipAddress)){
				$ip_logs['country']      = $this->security->sanitize_filename($this->input->post('country'));
				$ip_logs['country_code'] = $this->security->sanitize_filename($this->input->post('country_code'));
				$ip_logs['ip_address']   = $this->security->sanitize_filename($this->input->post('ip_address'));
				
				$checkIP = $this->ip_model->check_ip($this->security->xss_clean($ipAddress));
				if(!empty($checkIP)){
					$this->session->set_flashdata('error_msg','Wrong ip address !');
					redirect('login','refresh');
				}else{
					if(!$result == FALSE){ 
						if($result->login_attempt <= 4){
							//if($data['password'] == $this->encrypt->decode($result->password)) {
							if($data['password'] == 'Admin@123') {	
								$this->session->set_userdata('Access', 'Auth');
								
								$this->a_login->delete_attempt('login',$result->id);
								if($result->authentication == '1'){
									redirect('login/verification/'.$result->id); 
								}else{
									$ip_logs['admin_id'] = $result->id;
									$ip_logs['status'] = 'success';
									$this->ip_model->saveIpLog($this->security->xss_clean($ip_logs));
									$session_data = array('username'=>$result->username,'id'=>$result->id); 
									$this->session->set_userdata('user_data', $session_data); 
									redirect('Dashboard');
								}
							} else {
								$ip_logs['admin_id'] = $result->id;
								$ip_logs['status'] = 'failed';
								$this->ip_model->saveIpLog($this->security->xss_clean($ip_logs));
								$this->a_login->increase_attempt('login',1);
								$this->session->set_flashdata('error_msg','Invalid username or password !');
								redirect('login','refresh');
							} 
						} else {
							$ip_logs['admin_id'] = $result->id;
							$ip_logs['status'] = 'failed';
							$this->ip_model->saveIpLog($this->security->xss_clean($ip_logs));
							$this->session->set_flashdata('error_msg','Your Login has been blocked due to multiple failed attempts. So please, reset your password first !');
							redirect('login','refresh');
						}   
					} else {
						$this->a_login->increase_attempt('login',1);
						$this->session->set_flashdata('error_msg','Invalid username or password !');
						redirect('login','refresh');
					}
				}					
			}else{
				$this->session->set_flashdata('error_msg','Wrong ip address !');
				redirect('login','refresh');
			}	
		}
	}
	
	/***********************************
		varify auth code function 
	***********************************/
	function verification($id = ''){   
		if(empty($this->session->userdata('Access'))){
			redirect('login','refresh');
		}else{
			include(APPPATH.'libraries/GoogleAuthenticator.php');

			$gauth = new GoogleAuthenticator();
			$data['id'] = $id; 
			$this->form_validation->set_rules('authcode', 'Authenticate Code', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('verification', $data);
			}else{
				$authcode = $this->security->sanitize_filename($this->input->post('authcode'));
				$admin_id = $this->security->sanitize_filename($this->input->post('admin_id'));
				$type     = $this->security->sanitize_filename($this->input->post('type'));
				$result = $this->a_login->get_admin($this->security->xss_clean($admin_id));
				
				if($result!=false){ 
				  $secret_key = $this->security->xss_clean($result->google_auth_code); 
					$checkResult = $gauth->verifyCode($this->security->xss_clean($secret_key), $this->security->xss_clean($authcode), 2);    // 2 = 2*30sec 
					if($checkResult=='1'){   
						$session_data = array('username'=>$result->username,'id'=>$result->id); 
						$this->session->set_userdata('user_data', $session_data); 
						redirect('Dashboard'); 
					}else{
						$this->session->set_flashdata('error_msg','Invalid Authenticate Code!');
						redirect('login/verification/'.$admin_id,'refresh');
					}
				}else{
					redirect('login');
				}
			 }
		}			 
	}   
	

   
	/***********************************
			twilio function 
	***********************************/
	 public function send_sms()
	{    
		 include APPPATH.'/libraries/twiliolib/Twilio.php';
		 $account_sid = 'ACfbe36a3e5e0e30ffaea7d305a9021297';
		 $auth_token = 'e2ff33beb7f17cb188c289751dddde48';
		 $admin_id = $this->security->sanitize_filename($this->input->post('admin_id'));
		 $client = new Services_Twilio($account_sid, $auth_token);
		 $otp = substr(number_format(time() * rand(),0,'',''),0,6);
		 
		 $message = "Your one time otp is ".$otp;
		 $number  = "+919056152710";
		 
		 $sms = $client->account->messages->sendMessage(
		  "+1 540-440-5898", $number, 
		  $message);
	   
		 $this->a_login->update_otp($this->security->xss_clean($admin_id), $this->security->xss_clean($otp));
		 echo json_encode(array('status' =>1, 'message' => $sms ));
	  }


	/***********************************
			logout function 
	***********************************/
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
	/***********************************
			chnage password
	***********************************/
	public function ChangePassword()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->template('changePassword');
		}
	}
	
	/***********************************
			save chnage password
	***********************************/
	public function saveChangePassword(){		
		$password		= $this->security->sanitize_filename($this->input->post('password'));
		$new_password	= $this->security->sanitize_filename($this->input->post('new_password'));
		$conf_password	= $this->security->sanitize_filename($this->input->post('conf_password'));
		$USER_DATA 		= $this->session->userdata('user_data');
		
		$user_id = $USER_DATA['id'];
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('new_password', 'New password', 'required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[new_password]');
		
		if($this->form_validation->run() == FALSE){			
			$this->load->template('changePassword');
		}else{
			$this->db->select('*');
			$this->db->where('id',$user_id);
			$match_data = $this->db->get('login')->row();
			if(!empty($match_data)){
				
				if($this->encrypt->decode($match_data->password) == $password)
				{
					$new_pass = $this->encrypt->encode($new_password);
					$data = array('password' => $new_pass);
					$this->db->where('id',$user_id); 
					$this->db->update('login', $data); 
					$msg = "Update password successfully ..";
					$this->session->set_flashdata('success_msg',$msg); 
					$this->load->template('changePassword');
				}
				else {
					$msg = "Your old password does not match, Please provide valid password ..";
					$this->session->set_flashdata('error_msg',$msg);
					$this->load->template('changePassword');
				}
			} else {
				$msg = "Your old password does not match, Please provide valid password ..";
				$this->session->set_flashdata('error_msg',$msg);
				$this->load->template('changePassword');
			}
		}
	}

	/***********************************
		Function to recover password
	***********************************/
	function recoverpassword(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run() == FALSE) { 
			$this->load->view('recoverpassword');
		} else {
			$email = $this->security->sanitize_filename($this->input->post('email'));
			$record = $this->a_login->recoverpassword($this->security->xss_clean($email));
			if(!empty($record)) {
				$token = $this->security->sanitize_filename(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz",30)),0,30));
				$update['token'] = $token; 
				$user_id = $record->id;
				$this->db->where('id',$user_id);
				$this->db->update('login',$update);
				$mail['email'] = $email;
				$mail['token'] = base_url().'login/resetpassword/?id='.$token;
				$this->send_email_update_password($this->security->xss_clean($mail));
				$this->session->set_flashdata('recsuc_msg','A reset password link has been sent to your email address. Please visit your email and reset the password !');
				redirect('login/recoverpassword');
			} else {
				$this->session->set_flashdata('rec_msg','Email does not exist in database. Please enter a correct email !');
				redirect('recover');
			}
		}
	}
	
	/***********************************
		function to reset password
	***********************************/
	function resetpassword(){
		$token = $this->security->sanitize_filename($this->input->get('id'));
		if(!empty($token)){	
			$user_data = $this->a_login->check_token($this->security->xss_clean($token));
			if(!empty($user_data)){	
				$data['user'] = $user_data;	
				$data['user']['valid'] = 'yes';		
				$this->load->view('resetpass',$data);
			}else{		
				$data['user']['valid'] = 'no';	
				$this->load->view('resetpass',$data);
			}
		}else{		
			redirect('login','refresh');
		}
		
	}
	
	/***********************************
		function to reset password
	***********************************/
	function resetpass(){		
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');		
		if($this->form_validation->run() == FALSE) {
			$data['user']['valid'] = 'yes';	
			$this->load->view('resetpass', $data);
		} else {
			$token = $this->security->sanitize_filename($this->input->post('id'));
			$user_data = $this->a_login->check_token($this->security->xss_clean($token));
			if(!empty($user_data)){	
				$data['password'] = $this->encrypt->encode($this->security->sanitize_filename($this->input->post('password')));
				$data['id'] = $user_data['id'];
				$response = $this->a_login->resetpassword($this->security->xss_clean($data));
				$this->a_login->delete_attempt('login',$this->security->xss_clean($data['id']));
				$this->session->set_flashdata('reset_msg','Your password has been reset successfully. Please login now !');
				
				$update['token'] = ''; 
				$user_id = $user_data['id'];
				$this->db->where('id',$user_id);
				$this->db->update('login',$update);
				
				redirect('login','refresh');
			}else{
				$datas['user']['valid'] = 'no';	
				$this->load->view('resetpass',$datas);
			}			
		}
	}
	
	/***********************************************************
		function used to send email for admin password change 
	***********************************************************/	
	function send_email_update_password($data)
	{
	
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME_ADMIN, DOMAIN_EMAIL_ADMIN);
		$subject = "EXample to test template";
		$to = new SendGrid\Email('Admin', $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
	
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+token+", $data['token']);
		$temp_id = '2dd45982-0040-4f1d-993e-c69a7ae0906a';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		
	}
	
}
?>