<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("user_model");
		$this->load->model("Dashboard_model");
		$this->load->model("authentication_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		 $this->load->helper('cookie');
		
	}

	/*************	Home page     ************/	 
	public function index(){	
		$this->load->view('index');
	}
	
	public function login(){		
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session_data)){
			redirect('dashboard');
		}else{
			$this->load->view("includes/header");
			$this->load->view('login',$meta); 
		}
	}
	
	/*********************************************
		Function used for the	Log Out      
	*********************************************/
	function logout(){
		$user_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($user_data)){
			foreach ($user_data as $key => $value){
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity'){
					$this->session->unset_userdata($key);
				}
			}
			$this->session->sess_destroy();
			redirect('login');
		}else{
			redirect('login');
		}
	}
	
	/************	This is use for sign up page   **************/	
	public function registration(){	
		if(!empty($this->input->get('refid'))){
			$refid = $this->security->sanitize_filename($this->input->get('refid'));
			$user_refrence = $this->check_model->reference_id($refid);
			if(!empty($user_refrence)){
				$data['refid'] = $user_refrence['reference_id'];
			 set_cookie('refid',$data['refid'],'1800'); //set cookies for reference id
			}
			else{
					$data['refid'] = ''; 
				}		 
			$this->load->view("includes/header");
			$this->load->view('register',$data);
		}else{
			$data['refid'] = get_cookie('refid'); //get reference is from cookies
			$this->load->view("includes/header");
			$this->load->view('register',$data);
		}
	}

/************	This is use for forget password page   **************/		
	public function forgot(){		
		$this->load->view('forgot');
	}

/************	This is use for forget password page   **************/			
	public function thankyou(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));if(!empty($session_data)){
			$thank_page_sess = $this->security->xss_clean($this->session->userdata('get_thank_page'));
			if(!empty($thank_page_sess)){
				$this->session->unset_userdata('get_thank_page');
				$this->load->view('thankyou');
			}else{
				redirect('/');
			}
		}else{
			redirect('/');
		}		
	}
	

/********   FUNTION IS USE TO login   *************/
	public function do_login(){		
		$this->form_validation->set_rules('password', '', 'required');
		$this->form_validation->set_rules('email', '', 'trim|required|valid_email');
		$this->form_validation->set_rules('g-recaptcha-response', '', 'required|callback_validate_captcha');
		if($this->form_validation->run() == FALSE){            			
			$this->load->view("includes/header");
			$this->load->view('login'); 
        }else{
			$email = $this->security->sanitize_filename($this->input->post('email'));
			$password = $this->security->sanitize_filename($this->input->post('password'));
			$device_id = $this->security->sanitize_filename($this->input->post('deviceFingerPrint'));
			$device_type = $this->security->sanitize_filename($this->input->post('deviceFingerprintTechnology'));
			$captcha = $this->security->sanitize_filename($this->input->post('captcha'));
			$ip_address = $_SERVER['REMOTE_ADDR'];
			
			$user_data = $this->Dashboard_model->do_login($this->security->xss_clean($email));	
			$check_login_attempt = $this->authentication_model->check_login_status();			
			$id ="";
			if(!empty($user_data)){
				// check ip address
				$ip_logs['country']      = $this->security->sanitize_filename($this->input->post('country'));
				$ip_logs['country_code'] = $this->security->sanitize_filename($this->input->post('country_code'));
				$ip_logs['ip_address']   = $this->security->sanitize_filename($this->input->post('ip_address'));
				$check_ip_block = $this->user_model->check_ip_block($this->security->xss_clean($ip_logs['ip_address']));
				if($check_ip_block)
				{
					$data['error_msg'] = 'Sorry for the inconvenience but your IP address is blocked due to security reasons please contact SafeCardano team for support.';
					$this->load->view("includes/header",$data);
					$this->load->view('login',$data);
				}
				else
				{
				$check_ip_address = $this->check_ip_address($this->security->xss_clean($user_data),$this->security->xss_clean($ip_logs));
				
				/*if($check_ip_address){ */
					$user_id = $user_data['user_id']; 					
			// check user soft deleted by admin	
				
									
					$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
					$decrypted = UnsafeCrypto::decrypt($user_data['password'], $key, true);
						
					if($user_data['status'] == '0'){
						$data['error_msg'] = 'Please verify your email address first before logging in.';			
						$this->load->view("includes/header",$data);
						$this->load->view('login',$data); 					
					}else if($user_data['login_attempt'] > $check_login_attempt['login_failed_limit']){
						//$return='6';								
						$data['error_msg'] = 'Your Login has been blocked due to multiple failed attempts. So please, reset your password first !';			
						$this->load->view("includes/header",$data);
						$this->load->view('login',$data); 
					}else if($password != $decrypted){
						$this->user_model->increase_attempt(DB_PREFIX.'user_config',$this->security->xss_clean($user_id));						
						$data['error_msg'] = 'Please enter valid Email and Password.';			
						$this->load->view("includes/header",$data);
						$this->load->view('login',$data); 
					}else if($user_data['status'] == '3'){
						$data['error_msg'] = 'Your account has been temporarily suspended. Please contact SafeCardano team to continue with your account.';
						$this->load->view("includes/header",$data);
						$this->load->view('login',$data); 					
					}else{						
						$id = $user_data['id'];
						//bounty check
						$session_bounty = $this->security->xss_clean($this->session->userdata('bounty'));	
						if(!empty($session_bounty)){
							$this->user_model->update_bounty($this->security->xss_clean($user_data['id']));
						}
						
						$this->user_model->delete_attempt($this->security->xss_clean($user_id));
						
						
						$data = array(
									'user_id'=>$user_id,
									'device_id'=>$device_id,
									'device_type'=>$device_type,
									'ip_address'=>$ip_address
								);
						
						$this->user_model->save_tracking($this->security->xss_clean($data));
						
				// check user have two phase auth
						if(!empty($user_data['login_type'])){
							/**to send sms to mobile during login**/
									if($user_data['login_type']=="twilio"){
											$result = $this->authentication_model->get_user_auth($id);	
											$mobile_no = $result['phone'];
											$token = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);											
																					
											$data1 = $this->send_sms($token,$mobile_no);
											$this->authentication_model->save_twilio_token($id,$token,$mobile_no);
										}
										/**end**/
							redirect('verification/'.$id);							
						}else{
							
							$result = $this->authentication_model->get_user_auth($id);
							$date = date('Y-m-d H:i:s');
							if($result['mail_authetication_date'] == '')
							{
								$close_date = $date;
								
							}
							else{
								
							   $close_date = date("Y-m-d H:i:s", strtotime($result['mail_authetication_date'] . "+30 minutes"));
							}
							
							if($date >= $close_date)
							{
								$user_data['code'] = $this->genrate_token(10);
								$this->send_email_user_authetication($user_data);
								$this->authentication_model->save_email_authetication_code($id,$user_data['code'],$date);
							}
							redirect('verification/'.$id);
						}					
						
					}
			}				
			}else{						
				$data['error_msg'] = 'Please enter valid Email and Password.';			
				$this->load->view("includes/header",$data);
				$this->load->view('login',$data);
			}
		}
	}


/********   FUNTION IS USE TO FORGET PASSWORD   *************/
	public function forget_pass(){
		$this->form_validation->set_rules('email', 'Email', 'required');
		if($this->form_validation->run() == FALSE){
            echo "Email can not be null, Please provide valid email address.";
        }else{
			$email = $this->security->sanitize_filename($this->input->post('email'));
			$captcha = $this->security->sanitize_filename($this->input->post('captcha'));
			$user_data = $this->Dashboard_model->do_login($this->security->xss_clean($email));
			if(!empty($user_data)){
				$name=$user_data['firstname'];
				$u_id=$user_data['id'];
				
				$message='';
				$headers='';
				$token = $this->security->sanitize_filename(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz",30)),0,30));
				
				$msg = '';
				$subject = 'Reset Password for '.DOMAIN_NAME.'!';
				$template_id = 'd17293c0-c8be-4d2d-9a88-0c9ee9a98c40';
				$user_data['token'] = base_url()."resetpass/?id=".$token; 
				$user_data['refrence_link'] = base_url().'registration/?refid='.$user_data['reference_id'];
				$this->send_email_user($email,$user_data,$subject,$template_id);
				
				
				$data = array(
					'u_id'=>$u_id,
					'token'=>$token
				);
			
				$updated = $this->user_model->expir_link($this->security->xss_clean($data));				
				
				$msg = "We have sent reset password link in your email.";
				echo json_encode(array('status'=>1,'msg'=>$msg));
			}else{
				
				$msg = "You have entered an invalid email address. Please try again.";
				echo json_encode(array('status'=>0,'msg'=>$msg));
			}
		}
	}	
	
/********   FUNTION IS USE TO RESET PASSWOED   *************/
	public function reset_pass(){
		$session = $this->session->userdata('set_pass');
		if(!empty($this->security->sanitize_filename($this->input->get('id')))){
			$token = $this->security->sanitize_filename($this->input->get('id'));
			$token_data = $this->check_model->forgot_token($this->security->xss_clean($token));
			if(!empty($token_data)){
				$data['token_data'] = $token_data;			
				$this->session->set_userdata('set_pass',$token_data);
				$this->load->view('resetpass',$data);
			}else{
				$data['token_data'] = '';
				$this->load->view('resetpass',$data);				
			}
		}else if(!empty($session)){
			$data['token_data'] = $this->session->userdata('set_pass');
			$this->load->view('resetpass',$data);
		}else{
			$this->load->view('resetpass');
		}
	}	
	
/*******************************************************
   FUNTION IS USE TO RESET PASSWOED   
   ****************************************************/
	public function update_pass(){
		$this->form_validation->set_rules('password', '', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('Confirm-Password', '', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
            $data['token_data'] = $this->session->userdata('set_pass');
			$this->load->view('resetpass',$data);
        }else{			
			$token = $this->security->sanitize_filename($this->input->post('token'));
			$token_data = $this->check_model->forgot_token($this->security->xss_clean($token));
			if(!empty($token_data)){
				$password = $this->security->sanitize_filename($this->input->post('password'));
				$user_id  = $token_data['user_id'];
				$data = array(
					'user_id'=>$user_id,
					'password'=>$password
				);
				
				$sfdsf = $this->user_model->update_pass($this->security->xss_clean($data));
				$user_data = $this->user_model->get_usr_data($this->security->xss_clean($user_id));
				$this->sendEmailPass($user_data);
				$this->user_model->delete_attempt($this->security->xss_clean($user_id));
				
				$data['token_data'] = $this->session->userdata('set_pass');
				
				$data['pass_save'] = 'Password has been changed successfully!';
				$this->load->view('resetpass',$data);
				$this->session->unset_userdata('set_pass');
			}else{
				$data['pass_save'] = 'Something went wrong.';
				$this->load->view('resetpass',$data);
			}
		}
	}	


	public function save_tracking($device_id,$device_type,$ip_address){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$data = array(
				'user_id'=>$user_id,
				'device_id'=>$device_id,
				'device_type'=>$device_type,
				'ip_address'=>$ip_address
			);
						
			$this->user_model->save_tracking($this->security->xss_clean($data));
		}else{
			$this->load->view("includes/header");
			$this->load->view('login');
		}
	  
	}	
	
/********************************************************
   FUNTION for check email allready exist   
   *****************************************************/	
	public function email_check(){ 
		$email = $this->security->sanitize_filename($this->input->post('email'));
		$check_email = $this->check_model->check_email($this->security->xss_clean($email));
		if(!empty($check_email)){
			$this->form_validation->set_message('email_check','The email you enter is already taken.');
			return false;
		}else{
			
			return true;
		}
	} 
   /************************************************************
   FUNTION for registration   
   ************************************************************/
	public function register_ajax(){ 

		$this->form_validation->set_rules('Firstname', '', 'required');
		$this->form_validation->set_rules('Lastname', '', 'required');
		$this->form_validation->set_rules('email','','trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('Phone', '', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('Password', '', 'required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('Retype-password', '', 'required|matches[Password]');
		$this->form_validation->set_rules('g-recaptcha-response', '', 'required|callback_validate_captcha');
		$this->form_validation->set_message('regex_match', 'Please enter only 10 digit mobile number.');
		if($this->form_validation->run() == FALSE){
			$data['refid'] = $this->security->sanitize_filename($this->input->post('reference_code'));
			$this->load->view("includes/header");
			$this->load->view('register',$data);
		}else{
			//bounty check
			$session_bounty = $this->security->xss_clean($this->session->userdata('bounty'));	
			if(!empty($session_bounty)){
				$data['bounty'] = $session_bounty['val'];
			} 
						
			$user_data['firstname'] = $this->security->sanitize_filename($this->input->post('Firstname'));			
			$user_data['lastname'] 	= $this->security->sanitize_filename($this->input->post('Lastname'));			
			$user_data['email'] 	= $this->security->sanitize_filename($this->input->post('email'));			
			//$user_data['phone'] 	= $this->security->sanitize_filename($this->input->post('Phone'));
			$phonecode = 		$this->security->sanitize_filename($this->input->post('phonecodeHidden'));
			$phone = 		$this->security->sanitize_filename($this->input->post('Phone'));
			$user_data['phone'] = $phonecode.''.$phone;
			$password 				= $this->security->sanitize_filename($this->input->post('Password'));	
			
			$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
			$encrypted = UnsafeCrypto::encrypt($password, $key, true);
			$user_data['password'] = $encrypted;
			
			$email = $user_data['email'];							
			$referenace_id = strtotime(date('Y-m-d h:i:s'));
			$token = $this->security->sanitize_filename(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz",30)),0,30));
						
			$config_data['token'] = $token;
			$config_data['reference_id'] = $referenace_id;
			$reference_code = $this->security->sanitize_filename($this->input->post('reference_code'));
			if(!empty($reference_code)){
				$config_data['refered_id'] = $reference_code;
			}else{
				$config_data['refered_id'] = ''; 
			}
			$refferal_status = $this->Dashboard_model->refferal_status();
			if(!empty($refferal_status)){
				
				$config_data['refered_status'] = $refferal_status['system_management'];
			}
			$check_login_status = $this->authentication_model->check_login_status();
			if($check_login_status)
			{
				if($check_login_status['register_status'] == 1)
				{
					
					$datas = $this->Dashboard_model->register_ajax($this->security->xss_clean($user_data),$this->security->xss_clean($config_data));
					if(!empty($datas))
					{ 		
						$user_data['refrence_link'] = base_url().'registration/?refid='.$referenace_id;
						$user_data['token'] = base_url().'verify?id='.$token;				
						$subject = 'Welcome To '.DOMAIN_NAME.'! Confirm Your Email'; 
						$template_id = '8c44deb6-8185-4c4e-b97c-ea02bb6adb87';
						$this->send_email_user($email,$user_data,$subject,$template_id);
					//	$this->registerMessage($user_data,$user_data['phone']);
						$this->load->view('register_thank');				
					}
				}
				else
				{
					$data['refid'] = $this->security->sanitize_filename($this->input->post('reference_code'));
					$data['error_msg'] = 'SafeCardano registration has been temporarily disabled. Please be patient we will get back to you soon. Stay connected with us.';
					$this->load->view("includes/header");
					$this->load->view('register',$data);
				}
			}
			else
			{
				
				$datas = $this->Dashboard_model->register_ajax($this->security->xss_clean($user_data),$this->security->xss_clean($config_data));
				if(!empty($datas)){ 		
				
				$user_data['refrence_link'] = base_url().'registration/?refid='.$referenace_id;
				$user_data['token'] = base_url().'verify?id='.$token;				
				$subject = 'Welcome To '.DOMAIN_NAME.'! Confirm Your Email'; 
				$template_id = 'cf155c64-a29c-41dd-bd52-ce6ab1321577';
				$this->send_email_user($email,$user_data,$subject,$template_id);
			//	$this->registerMessage($user_data,$user_data['phone']);
				$this->load->view('register_thank'); 
				}
			}
						
		}	
		
	}
	/**************************************************
	function for recaptcha
	********************************************/
	 function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
	
         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcnG0gUAAAAAFxafBwTi1qYvS_hKEY5N2UAG533&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
			$this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
/*****************************************************
   FUNTION IS USE TO verify email   
   ******************************************************/
	public function verify_mail(){
		
		$token = $this->security->sanitize_filename($this->input->get('id'));
		$user_data['userdata'] = $this->user_model->verify_mail($this->security->xss_clean($token));
		if(!empty($user_data['userdata'])){	
			$user_id = $user_data['userdata']['user_id'];
			$userdatas = $this->user_model->get_usr_data($this->security->xss_clean($user_id));
			
			$user_data['userdata']['active_status'] = $userdatas['status'];
			
			$date_register = $user_data['userdata']['date'];
			$date_current  = date('Y-m-d h:i:s');
			
			$date1=date_create($date_current);
			$date2=date_create($date_register);
			$diff=date_diff($date1,$date2);
			
			$days = $diff->format("%a");
			
			if($days <= '5'){
				$this->load->view('email_verify',$user_data);
			}else{
				$user_datas['userdata']['token'] = '';
				$this->load->view('email_verify',$user_datas);
			}
			
				
		}else{
			redirect('login');
		}
	}	
	
/*****************************************************
   FUNTION IS USE TO GET REFERREL USER DETAIL   
   **************************************************/
	public function referrel_link(){
		if(!empty($this->input->get('refid'))){
			$refid = $this->security->sanitize_filename($this->input->get('refid'));
			$user_refrence = $this->check_model->reference_id($this->security->xss_clean($refid));
			if(!empty($user_refrence)){
				$data['refid'] = $user_refrence['reference_id'];
			}else{
				$data['refid'] = ''; 
			}
			$this->load->view("includes/header");
			$this->load->view('register',$data);
		}	
	}	
	


/*****************************************************
  FUNCTION IS USE TO SET PASSWOED
  *****************************************************/
	public function set_password(){
		$this->form_validation->set_rules('user_id', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == FALSE){
            redirect('/');
        }else{
			$user_id = $this->security->sanitize_filename($this->input->post('user_id'));
			$password = $this->security->sanitize_filename($this->input->post('password'));
			$return = $this->user_model->set_password($this->security->xss_clean($user_id),$this->security->xss_clean($password));
			if($return){
				$user_data = $this->check_model->check_id($this->security->xss_clean($user_id));
				$this->session->set_userdata('user_data',$user_data); 
				echo '1';exit;
			}else{
				echo '0';exit;
			}
		}
	}

/*******************************************************
  FUNCTION IS USE TO VIEW THANKYOU PAGE AFTER REGISTER EMAIL
  ***************************************************************/
	public function register_thank(){
		$session_data = $this->security->xss_clean($this->session->userdata('new_user'));
		if(!empty($session_data)){
			$this->load->view('register_thank');
		}else{
			redirect('/');
		}
	}

	

/***********************************************
  FUNCTION IS USE TO GET BOUNTY ADDRESS	
  *********************************************/
	public function bounty($bounty=false){	
		if(!empty($bounty)){
			$data = array('val'=>'yes');
			$this->session->set_userdata('bounty',$data);
			redirect('/');
		}else{
			redirect('/');
		}
	}
	
	/******************************************************
    FUNCTION IS USE TO SEND EMAIL   
	******************************************************/
	 function send_email($email,$data,$template_name,$subject){
		  $from = DOMAIN_EMAIL;
		  $message = ''; 
		  $message = $this->load->view("email_template/".$template_name,$data, TRUE);
		  $headers .= 'MIME-Version: 1.0' . "\r\n";
		  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		  // Create email headers
		  $headers .= 'From: '.$from."\r\n".
		   'Reply-To: '.$from."\r\n" .
		   'X-Mailer: PHP/' . phpversion();   
		  require APPPATH."libraries/sendgrid-php/sendgrid-php.php";

		  $from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		  $subject = $subject;
		  $to = new SendGrid\Email($data['firstname'], $email);
		  $content = new SendGrid\Content("text/html", $message);
		  $mail = new SendGrid\Mail($from, $subject, $to, $content);
		  $apiKey = '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';
		  $sg = new \SendGrid($apiKey);

		  $response = $sg->client->mail()->send()->post($mail);
	 }	
	 
	 function thank_page(){
		 $this->load->view("includes/header");
		 $this->load->view('register_thank');
	 }
	 
/**********************************************************
   FUNTION for check user old ip address   
   ************************************************************/	
	public function check_ip_address($user_data,$ip_logs){	
		$token = $this->security->sanitize_filename(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz",30)),0,30));
		
		$user_data['ip_token'] = $token;
		
		$return = $this->user_model->check_ip_address($this->security->xss_clean($user_data),$this->security->xss_clean($ip_logs));
		if($return == '1'){
			return true;
		}/* else{			
			$email 		 = $user_data['email'];
			$subject 	 = 'Ip address not match';
			$template_id = 'ba95d9b1-f355-470b-8438-1fb5e13afbfb';
						
			$reference_id = $user_data['reference_id'];
			$user_data['token'] = base_url().'ip_address/?link='.$token;
			$user_data['refrence_link'] = base_url().'registration/?refid='.$reference_id;		
			$this->send_email_user($email,$user_data,$subject,$template_id);			
			return false;
		} */		
	}	 
	 
/**************************************************************
    FUNCTION IS USE TO SEND EMAIL   
	***********************************************************/
	function send_email_user($email,$data,$subject,$template_id){
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$to = new SendGrid\Email($data['firstname'], $email);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+domain+", DOMAIN_NAME);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		$mail->personalization[0]->addSubstitution("+token+", $data['token']);
		$mail->personalization[0]->addSubstitution("+refferal+", $data['refrence_link']);
		$mail->setTemplateId($template_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
	 }
	/************************************************
		Function for sending messages using twilio
    ***********************************************/
	public function send_sms($message, $contn){
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

/*******************************************************
   FUNTION IS USE TO VERIFY EMAIL FROM TOKEN   
   **********************************************************/
	public function verify_acc(){
		$token = $this->security->sanitize_filename($this->input->post('id'));
		$user_data = $this->user_model->verify_mail($this->security->xss_clean($token));		
		if(!empty($user_data)){		
			$user_data = $this->user_model->verify_acc($this->security->xss_clean($token));
			redirect('login');
		}else{
			redirect('login');
		}
	}
	/*****************************************************
    FUNCTION IS USE TO SEND EMAIL   
	*****************************************************/
	function send_email_user_authetication($data){
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($data['firstname'], $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		$mail->personalization[0]->addSubstitution("+code+", $data['code']);
		$temp_id = '41f27d4c-7c85-4eea-a52e-9f0f63debc08';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail); 
	 }
/*****************************************
    Function for generate rendom string
	*****************************************/
	public function genrate_token($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
    }	 
	/*************************************
	function to redirect the page to manantiance view
	**********************************************/
	public function mantainance()
	{
		$this->load->view('maintenance');
	}
	/************************************************
		Function for sending messages on register
    ***********************************************/
	public function registerMessage($user_data, $contno)
	{
		//$user_data['firstname'];$user_data['lastname']
		$nameuser = $user_data['firstname'].' '.$user_data['lastname'];
		include APPPATH.'/libraries/twiliolib/Twilio.php';
		$account_sid = ACCOUNT_SID;
	    $auth_token = AUTH_TOKEN;
		//+442891042496
		 //$account_sid = 'AC2aa7a28e906f5730c943c38e448cdd24';
	   // $auth_token = 'abb904b184dd4654da7d90c89e2ed978';
	   //+1 678-263-2721
	    $client = new Services_Twilio($account_sid, $auth_token);
	    $people = array(
            $contno => $contno
   		);
	
		foreach ($people as $number => $name)
	   		{
		        $sms = $client->account->messages->sendMessage(
			"+442891042496",$number,'Hi '.$nameuser.',

Thank you for signing up for SafeCardano.

Best regards,
SafeCardano Team.');

		}

 	}
	
       /*********************************************
		Function to send eamil for change passoword
		*********************************************/
		function sendEmailPass($data){
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($data['firstname'], $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		$temp_id = '9b1f7b45-d145-4876-be73-971951e79525';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		}
		
	/*************************************
	function to redirect the page to block ip
	**********************************************/
	public function ipBlocked()
	{
		$this->load->view('ip_blocked');
	}
		
}