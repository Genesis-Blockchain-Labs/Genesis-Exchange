<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(e_all);
class Kyc extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("check_model");
		$this->load->model("Dashboard_model");
		$this->load->model("user_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('session');
		
		$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
	}
//  FUNCTION IS USE kyc_us DETAIAL PAGE	
	public function kyc_us(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$data['active_class'] = 'us';
			$user_id = $session_data['user_id'];
			$data['contry'] = $this->user_model->get_country();
			$data['reward_point'] = $this->user_model->reward_point($this->security->xss_clean($session_data['user_id']));
			$kyc_data = $this->Dashboard_model->get_kyc($this->security->xss_clean($user_id));
			if($kyc_data['type'] != ''){
				$data['kyc'] = $kyc_data;
				$this->load->view('edit_kyc_us',$data);
			}else{	
				$this->load->view('kyc_us',$data);
			}			
		}else{
			redirect('login');
		} 
	}
	
//  FUNCTION IS USE kyc nonus PAGE
	public function kyc_nonus(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){	
			$data['active_class'] = 'non_us';
			$user_id = $session_data['user_id'];
			$data['contry'] = $this->Dashboard_model->get_country();
			$kyc_data = $this->Dashboard_model->get_kyc($this->security->xss_clean($user_id));
			if($kyc_data['type'] != ''){
				$data['kyc'] = $kyc_data;
				$this->load->view('edit_kyc_nonus',$data);
			}else{	
				$this->load->view('kyc_nonus',$data);
			}
		} else {
			redirect('login');
		} 
	}

/******   FUNCTION IS USE TO SUBMIT KYC FOR US USER   **********/	
	public function submit_kyc_us(){
		$return_data['contry'] = $this->Dashboard_model->get_country();
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$return_data['active_class'] = 'us';
			
			if(empty($this->input->post())){
				
				redirect('dashboard');
			}else{				
				$this->form_validation->set_rules('name', '', 'required');
				$this->form_validation->set_rules('Date-Of-Birth', '', 'required');
				$this->form_validation->set_rules('occupation', '', 'required');
				$this->form_validation->set_rules('sources_of_income', '', 'required');
				$this->form_validation->set_rules('social_number', '', 'required');
				$this->form_validation->set_rules('street', '', 'required');
				$this->form_validation->set_rules('city', '', 'required');
				$this->form_validation->set_rules('state', '', 'required');
				$this->form_validation->set_rules('postcode', '', 'required');
				$this->form_validation->set_rules('country', '', 'required');
				$this->form_validation->set_rules('citizenship', '', 'required');
				$this->form_validation->set_rules('currency', '', 'required');
				$this->form_validation->set_rules('Purchase-amount', '', 'numeric');
				$this->form_validation->set_rules('wallet_address', '', 'trim|required|min_length[30]|max_length[50]');
				$this->form_validation->set_rules('issuence', '', 'required');
				$this->form_validation->set_rules('id_type', '', 'required');
			
				$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				
				if ($this->form_validation->run() == FALSE){
					$return_data['active_class'] = 'us';
					$this->load->view('kyc_us',$return_data);
				}else{	
					$eth_add = $this->input->post('wallet_address');
					$eth_adds = str_split($eth_add,'2');
					$final_eth = $eth_adds[0];
					if($final_eth != '0x'){	
						$return_data['validation_error'] = 'kyc_error_us';
						$return_data['eth_add_err'] = 'ETH address start from 0x and must be at least 30 characters in length.';
						$this->load->view('kyc_us',$return_data);
					}else{
						if(!empty($this->input->post('reference_id'))){
							$refered_id = $this->security->sanitize_filename($this->input->post('reference_id'));				
						}else{
							$refered_id = '';
						}
						
						$check_own_ref = $this->check_model->check_ref_id($this->security->xss_clean($data['refered_id']));
						if($check_own_ref['reference_id'] != $session_data['reference_id']){
							$user_id = $session_data['user_id'];
							
							$image_kyc = $this->security->xss_clean($this->session->userdata('image_kyc'));
							$data['image'] = $image_kyc;
							
							$data['name'] = $this->security->sanitize_filename($this->input->post('name'));
							$data['dob'] = $this->input->post('Date-Of-Birth');
							$data['occupation'] = $this->security->sanitize_filename($this->security->sanitize_filename($this->input->post('occupation')));
							$data['sources_of_income'] = $this->security->sanitize_filename($this->input->post('sources_of_income'));
							$data['ssn'] = $this->security->sanitize_filename($this->input->post('social_number'));
							$data['street'] = $this->security->sanitize_filename($this->input->post('street'));
							$data['city'] = $this->security->sanitize_filename($this->input->post('city'));
							$data['state'] = $this->security->sanitize_filename($this->input->post('state'));
							$data['postcode'] = $this->security->sanitize_filename($this->input->post('postcode'));
							$data['country'] = $this->security->sanitize_filename($this->input->post('country'));
							$data['citizenship'] = $this->security->sanitize_filename($this->input->post('citizenship'));
							$data['currency'] = $this->security->sanitize_filename($this->input->post('currency'));
							$data['purchase_amount'] =$this->security->sanitize_filename($this->input->post('Purchase-amount'));
							$data['eth_address'] = $this->security->sanitize_filename($this->input->post('wallet_address'));
							$data['issuance'] = $this->security->sanitize_filename($this->input->post('issuence'));
							$data['id_proof'] = $this->security->sanitize_filename($this->input->post('id_type'));					
							$data['type'] = 'us_customer';					
							
							$data['serial_no'] = $this->user_model->getLastSerial();
																
							$ip_address		= $_SERVER['REMOTE_ADDR']; 
							$device_id		= $this->security->sanitize_filename($this->input->post('deviceFingerPrint'));
							$device_type	= $this->security->sanitize_filename($this->input->post('deviceFingerprintTechnology'));
							
							$submit_kyc = $this->Dashboard_model->submit_kyc($user_id,$data,$refered_id);
													
							if($submit_kyc){
								$this->session->unset_userdata('image_kyc');
								
								$user_data = $this->check_model->check_id($session_data['user_id']);
								$msg1 = "Thank you for your applying to join the whitelist. If your application is successful, a member of our team will contact you and provide access to our token sale portal.";
								$msg = "There is new KYC submitted";
								$subject = 'Thanks for Submitting Your Information!';				
								$template_name = 'kyc_submit';
								$user_data['refrence_link'] = base_url().'registration/?refid='.$session_data['reference_id'];								
								$this->send_email($user_data['email'],$user_data,$template_name,$subject);
								
								$kyc_data = array('kyc_detail'=>'kyc_fill');
								$this->session->set_userdata('get_thank_page',$kyc_data);
																
								redirect('user/thankyou');
							} else {								
								$return_data['kyc_not_submit'] = 'KYC not submit yet';	
								$this->load->view('kyc_us',$return_data);
							}
						}else{
							$return_data['Refrence_error'] = 'Put Valid Refrence Code.';	
							$this->load->view('kyc_us',$return_data);
						}
					}
				}
			}
		}else{
			redirect('/');
		}			
	}

/******   FUNCTION IS USE TO SUBMIT KYC FOR NON US USER   **********/	
	public function submit_kyc_nonus(){
		$return_data['contry'] = $this->Dashboard_model->get_country();
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			
			if(empty($this->input->post())){
				
				redirect('dashboard');
			}else{				
				$this->form_validation->set_rules('name', '', 'required');
				$this->form_validation->set_rules('Date-Of-Birth', '', 'required');
				$this->form_validation->set_rules('occupation', '', 'required');
				$this->form_validation->set_rules('sources_of_income', '', 'required');
				//$this->form_validation->set_rules('social_number', '', 'required');
				$this->form_validation->set_rules('street', '', 'required');
				$this->form_validation->set_rules('city', '', 'required');
				$this->form_validation->set_rules('state', '', 'required');
				$this->form_validation->set_rules('postcode', '', 'required');
				$this->form_validation->set_rules('country', '', 'required');
				$this->form_validation->set_rules('citizenship', '', 'required');
				$this->form_validation->set_rules('currency', '', 'required');
				$this->form_validation->set_rules('Purchase-amount', '', 'numeric');
				//$this->form_validation->set_rules('high_risk_country', '', 'required');
				$this->form_validation->set_rules('wallet_address', '', 'trim|required|min_length[30]|max_length[50]');
				$this->form_validation->set_rules('issuence', '', 'required');
				$this->form_validation->set_rules('id_type', '', 'required');
				//$this->form_validation->set_rules('phone', '', 'required');
				$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				
				if ($this->form_validation->run() == FALSE){
					
					$return_data['validation_error'] = 'kyc_error_us';
					$this->load->view('kyc_nonus',$return_data);
				}else{	
					$eth_add = $this->input->post('wallet_address');
					$eth_adds = str_split($eth_add,'2');
					$final_eth = $eth_adds[0];
					if($final_eth != '0x'){	
						
						$return_data['validation_error'] = 'kyc_error_nonus';
						$return_data['eth_add_err'] = 'ETH address start from 0x and must be at least 30 characters in length.';
						$this->load->view('kyc_nonus',$return_data);
					}else{
						
						if(!empty($this->input->post('reference_id'))){
							$refered_id = $this->security->sanitize_filename($this->input->post('reference_id'));				
						}else{
							$refered_id = '';
						}
					
							$user_id = $session_data['user_id'];
							
							$image_kyc = $this->security->xss_clean($this->session->userdata('image_kyc'));
							$data['image'] = $image_kyc;
							
							$data['name'] = $this->security->sanitize_filename($this->input->post('name'));
							$data['dob'] = $this->input->post('Date-Of-Birth');
							$data['occupation'] = $this->security->sanitize_filename($this->security->sanitize_filename($this->input->post('occupation')));
							$data['sources_of_income'] = $this->security->sanitize_filename($this->input->post('sources_of_income'));
							$data['ssn'] = $this->security->sanitize_filename($this->input->post('social_number'));
							$data['street'] = $this->security->sanitize_filename($this->input->post('street'));
							$data['city'] = $this->security->sanitize_filename($this->input->post('city'));
							$data['state'] = $this->security->sanitize_filename($this->input->post('state'));
							$data['postcode'] = $this->security->sanitize_filename($this->input->post('postcode'));
							$data['country'] = $this->security->sanitize_filename($this->input->post('country'));
							$data['citizenship'] = $this->security->sanitize_filename($this->input->post('citizenship'));
							$data['currency'] = $this->security->sanitize_filename($this->input->post('currency'));
							$data['purchase_amount'] =$this->security->sanitize_filename($this->input->post('Purchase-amount'));
							$data['eth_address'] = $this->security->sanitize_filename($this->input->post('wallet_address'));
							$data['issuance'] = $this->security->sanitize_filename($this->input->post('issuence'));
							$data['id_proof'] = $this->security->sanitize_filename($this->input->post('id_type'));					
							$data['type'] = 'non_us_customer';					
							//$data['phone'] = $this->security->sanitize_filename($this->input->post('phone'));
							$data['serial_no'] = $this->user_model->getLastSerial();
																
							$ip_address		= $_SERVER['REMOTE_ADDR']; 
							//$device_id		= $this->security->sanitize_filename($this->input->post('deviceFingerPrint'));
							//$device_type	= $this->security->sanitize_filename($this->input->post('deviceFingerprintTechnology'));
							
							
							
							//$this->user_model->save_track($user_id,$device_id,$device_type,$ip_address);
							
							$submit_kyc = $this->Dashboard_model->submit_kyc($user_id,$data,$refered_id);
							
							if($submit_kyc){
								$this->session->unset_userdata('image_kyc');
								
								$user_data = $this->check_model->check_id($session_data['user_id']);
								$msg1 = "Thank you for your applying to join the whitelist. If your application is successful, a member of our team will contact you and provide access to our token sale portal.";
								$msg = "There is new KYC submitted";
								$subject = 'Thanks for Submitting Your Information!';				
								$template_id = 'a900171f-987d-44c3-96c5-248aad508466';
								$user_data['refrence_link'] = base_url().'registration/?refid='.$session_data['reference_id'];
								
								//$this->send_email($user_data['email'],$user_data,$template_name,$subject);
								$this->send_email_user($user_data['email'],$user_data,$subject,$template_id);
								
								$kyc_data = array('kyc_detail'=>'kyc_fill');
								$this->session->set_userdata('get_thank_page',$kyc_data);
																
								redirect('user/thankyou');
							} else {
								
								$return_data['kyc_not_submit'] = 'KYC not submit yet';	
								$this->load->view('kyc_nonus',$return_data);
							}
						/* }else{
							$return_data['Refrence_error'] = 'Put Valid Refrence Code.';	
							$this->load->view('kyc_nonus',$return_data);
						} */
					}
				}
			}
		}else{
			redirect('/');
		}			
	}

/******   FUNCTION IS USE TO edit KYC FOR US USER   **********/	
	public function edit_kyc_us(){
		$return_data['contry'] = $this->Dashboard_model->get_country();
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$return_data['active_class'] = 'us';
			
			if(empty($this->input->post())){
				
				redirect('dashboard');
			}else{				
				$this->form_validation->set_rules('name', '', 'required');
				$this->form_validation->set_rules('Date-Of-Birth', '', 'required');
				$this->form_validation->set_rules('occupation', '', 'required');
				$this->form_validation->set_rules('sources_of_income', '', 'required');
				$this->form_validation->set_rules('social_number', '', 'required');
				$this->form_validation->set_rules('street', '', 'required');
				$this->form_validation->set_rules('city', '', 'required');
				$this->form_validation->set_rules('state', '', 'required');
				$this->form_validation->set_rules('postcode', '', 'required');
				$this->form_validation->set_rules('country', '', 'required');
				$this->form_validation->set_rules('citizenship', '', 'required');
				$this->form_validation->set_rules('currency', '', 'required');
				$this->form_validation->set_rules('Purchase-amount', '', 'numeric');
				$this->form_validation->set_rules('wallet_address', '', 'trim|required|min_length[30]|max_length[50]');
				$this->form_validation->set_rules('issuence', '', 'required');
				$this->form_validation->set_rules('id_type', '', 'required');
				//$this->form_validation->set_rules('phone', '', 'required');
				$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				/* if(!empty($this->security->sanitize_filename($this->input->post('file')))){
					$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				} */
				
				if ($this->form_validation->run() == FALSE){
					$return_data['active_class'] = 'us';
					$this->load->view('kyc_us',$return_data);
				}else{	
					$eth_add = $this->input->post('wallet_address');
					$eth_adds = str_split($eth_add,'2');
					$final_eth = $eth_adds[0];
					if($final_eth != '0x'){	
						$return_data['validation_error'] = 'kyc_error_us';
						$return_data['eth_add_err'] = 'ETH address start from 0x and must be at least 30 characters in length.';
						$this->load->view('kyc_us',$return_data);
					}else{
						if(!empty($this->input->post('reference_id'))){
							$refered_id = $this->security->sanitize_filename($this->input->post('reference_id'));
						}else{
							$refered_id = '';
						}
						
						$check_own_ref = $this->check_model->check_ref_id($refered_id);
						if($check_own_ref['reference_id'] != $session_data['reference_id']){
							$user_id = $session_data['user_id'];
							
							$image_kyc = $this->security->xss_clean($this->session->userdata('image_kyc'));
							$data['image'] = $image_kyc;
							
							$data['name'] = $this->security->sanitize_filename($this->input->post('name'));
							$data['dob'] = $this->input->post('Date-Of-Birth');
							$data['occupation'] = $this->security->sanitize_filename($this->security->sanitize_filename($this->input->post('occupation')));
							$data['sources_of_income'] = $this->security->sanitize_filename($this->input->post('sources_of_income'));
							$data['ssn'] = $this->security->sanitize_filename($this->input->post('social_number'));
							$data['street'] = $this->security->sanitize_filename($this->input->post('street'));
							$data['city'] = $this->security->sanitize_filename($this->input->post('city'));
							$data['state'] = $this->security->sanitize_filename($this->input->post('state'));
							$data['postcode'] = $this->security->sanitize_filename($this->input->post('postcode'));
							$data['country'] = $this->security->sanitize_filename($this->input->post('country'));
							$data['citizenship'] = $this->security->sanitize_filename($this->input->post('citizenship'));
							$data['currency'] = $this->security->sanitize_filename($this->input->post('currency'));
							$data['purchase_amount'] =$this->security->sanitize_filename($this->input->post('Purchase-amount'));
							$data['eth_address'] = $this->security->sanitize_filename($this->input->post('wallet_address'));
							$data['issuance'] = $this->security->sanitize_filename($this->input->post('issuence'));
							$data['id_proof'] = $this->security->sanitize_filename($this->input->post('id_type'));					
							$data['type'] = 'us_customer';					
							//$data['phone'] = $this->security->sanitize_filename($this->input->post('phone'));
							$data['serial_no'] = $this->user_model->getLastSerial();
																
							$ip_address		= $_SERVER['REMOTE_ADDR']; 
							$device_id		= $this->security->sanitize_filename($this->input->post('deviceFingerPrint'));
							$device_type	= $this->security->sanitize_filename($this->input->post('deviceFingerprintTechnology'));
							
							$submit_kyc = $this->Dashboard_model->submit_kyc($user_id,$data,$refered_id);
						
							
							if($submit_kyc){
								$this->session->unset_userdata('image_kyc');
								
								$user_data = $this->check_model->check_id($session_data['user_id']);
								$msg1 = "Thank you for your applying to join the whitelist. If your application is successful, a member of our team will contact you and provide access to our token sale portal.";
								$msg = "There is new KYC submitted";
								$subject = 'Thanks for Submitting Your Information!';				
								$template_name = 'kyc_submit';
								$user_data['refrence_link'] = base_url().'?refid='.$session_data['reference_id'];								
								//$this->send_email($user_data['email'],$user_data,$template_name,$subject);
								
								$kyc_data = array('kyc_detail'=>'kyc_fill');
								$this->session->set_userdata('get_thank_page',$kyc_data);
																
								redirect('user/thankyou');
							} else {
								
								$return_data['kyc_not_submit'] = 'KYC not submit yet';	
								$this->load->view('kyc_us',$return_data);
							}
						}else{
							$return_data['Refrence_error'] = 'Put Valid Refrence Code.';	
							$this->load->view('kyc_us',$return_data);
						}
					}
				}
			}
		}else{
			redirect('/');
		}			
	}

/******   FUNCTION IS USE TO EDIT KYC FOR NON US USER   **********/	
	public function edit_kyc_nonus(){
		$return_data['contry'] = $this->Dashboard_model->get_country();
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$return_data['active_class'] = 'non_us';
			
			if(empty($this->input->post())){
				//echo'<pre>empty post ';print_r($this->session->userdata('user_data'));exit;	
				redirect('dashboard');
			}else{				
				$this->form_validation->set_rules('name', '', 'required');
				$this->form_validation->set_rules('Date-Of-Birth', '', 'required');
				$this->form_validation->set_rules('occupation', '', 'required');
				$this->form_validation->set_rules('sources_of_income', '', 'required');
				//$this->form_validation->set_rules('social_number', '', 'required');
				$this->form_validation->set_rules('street', '', 'required');
				$this->form_validation->set_rules('city', '', 'required');
				$this->form_validation->set_rules('state', '', 'required');
				$this->form_validation->set_rules('postcode', '', 'required');
				$this->form_validation->set_rules('country', '', 'required');
				$this->form_validation->set_rules('citizenship', '', 'required');
				$this->form_validation->set_rules('currency', '', 'required');
				$this->form_validation->set_rules('Purchase-amount', '', 'numeric');
				//$this->form_validation->set_rules('high_risk_country', '', 'required');
				$this->form_validation->set_rules('wallet_address', '', 'trim|required|min_length[30]|max_length[50]');
				$this->form_validation->set_rules('issuence', '', 'required');
				$this->form_validation->set_rules('id_type', '', 'required');
				//$this->form_validation->set_rules('phone', '', 'required');
				$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				/* if(!empty($this->input->post('file'))){
					$this->form_validation->set_rules('file', '', 'callback_image_kyc');
				} */
				
				if ($this->form_validation->run() == FALSE){
					$return_data['validation_error'] = 'kyc_error_us';
					$this->load->view('kyc_nonus',$return_data);
				}else{	
					$eth_add = $this->input->post('wallet_address');
					$eth_adds = str_split($eth_add,'2');
					$final_eth = $eth_adds[0];
					if($final_eth != '0x'){	
						$return_data['validation_error'] = 'kyc_error_us';
						$return_data['eth_add_err'] = 'ETH address start from 0x and must be at least 30 characters in length.';
						$this->load->view('kyc_nonus',$return_data);
					}else{
						if(!empty($this->input->post('reference_id'))){
							$refered_id = $this->security->sanitize_filename($this->input->post('reference_id'));				
						}else{
							$refered_id = '';
						}
						
						$check_own_ref = $this->check_model->check_ref_id($refered_id);
						if($check_own_ref['reference_id'] != $session_data['reference_id']){
							$user_id = $session_data['user_id'];
							
							$image_kyc = $this->security->xss_clean($this->session->userdata('image_kyc'));
							$data['image'] = $image_kyc;
							
							$data['name'] = $this->security->sanitize_filename($this->input->post('name'));
							$data['dob'] = $this->input->post('Date-Of-Birth');
							$data['occupation'] = $this->security->sanitize_filename($this->security->sanitize_filename($this->input->post('occupation')));
							$data['sources_of_income'] = $this->security->sanitize_filename($this->input->post('sources_of_income'));
							$data['ssn'] = $this->security->sanitize_filename($this->input->post('social_number'));
							$data['street'] = $this->security->sanitize_filename($this->input->post('street'));
							$data['city'] = $this->security->sanitize_filename($this->input->post('city'));
							$data['state'] = $this->security->sanitize_filename($this->input->post('state'));
							$data['postcode'] = $this->security->sanitize_filename($this->input->post('postcode'));
							$data['country'] = $this->security->sanitize_filename($this->input->post('country'));
							$data['citizenship'] = $this->security->sanitize_filename($this->input->post('citizenship'));
							$data['currency'] = $this->security->sanitize_filename($this->input->post('currency'));
							$data['purchase_amount'] =$this->security->sanitize_filename($this->input->post('Purchase-amount'));
							$data['eth_address'] = $this->security->sanitize_filename($this->input->post('wallet_address'));
							$data['issuance'] = $this->security->sanitize_filename($this->input->post('issuence'));
							$data['id_proof'] = $this->security->sanitize_filename($this->input->post('id_type'));					
							$data['type'] = 'non_us_customer';					
							//$data['phone'] = $this->security->sanitize_filename($this->input->post('phone'));
							$data['serial_no'] = $this->user_model->getLastSerial();
																
							$ip_address		= $_SERVER['REMOTE_ADDR']; 
							$device_id		= $this->security->sanitize_filename($this->input->post('deviceFingerPrint'));
							$device_type	= $this->security->sanitize_filename($this->input->post('deviceFingerprintTechnology'));
							
							
							
							//$this->user_model->save_track($user_id,$device_id,$device_type,$ip_address);
							
							$submit_kyc = $this->Dashboard_model->submit_kyc($user_id,$data,$refered_id);
							
							if($submit_kyc){
								$this->session->unset_userdata('image_kyc');
								
								$user_data = $this->check_model->check_id($session_data['user_id']);
								$msg1 = "Thank you for your applying to join the whitelist. If your application is successful, a member of our team will contact you and provide access to our token sale portal.";
								$msg = "There is new KYC submitted";
								$subject = 'Thanks for Submitting Your Information!';				
								$template_name = 'kyc_submit';
								$user_data['refrence_link'] = base_url().'?refid='.$session_data['reference_id'];
								
								//$this->send_email($user_data['email'],$user_data,$template_name,$subject);
								
								$kyc_data = array('kyc_detail'=>'kyc_fill');
								$this->session->set_userdata('get_thank_page',$kyc_data);
																
								redirect('user/thankyou');
							} else {
								
								$return_data['kyc_not_submit'] = 'KYC not submit yet';	
								$this->load->view('kyc_nonus',$return_data);
							}
						}else{
							$return_data['Refrence_error'] = 'Put Valid Refrence Code.';	
							$this->load->view('kyc_nonus',$return_data);
						}
					}
				}
			}
		}else{
			redirect('/');
		}			
	}	

//  FUNCTION IS USE UPLOAD KYC US CUSTOMR	
	function image_kyc(){	
		
		if(!empty($_FILES['file']['name'])){
			$file_name = $_FILES['file']['name'];
			$file_name = time().$_FILES["file"]['name'];
			$file_size = $_FILES['file']['size'];
			$file_tmp  = $_FILES['file']['tmp_name'];
			$file_type = $_FILES['file']['type'];
			$config['file_name'] = $file_name;

			$config['upload_path']          = './uploads/kyc/';
			//$config['max_size']             = '2048 KB';
			$config['max_size']             = 2048;
			$config['allowed_types']        = 'PNG|png|jpg|jpeg|gif|xlsx|doc|docx|ppt|pptx|txt|pdf'; 
			$this->load->library('upload', $config);                 	
			if(!$this->upload->do_upload('file')){
				$error = $this->upload->display_errors();				
				//$this->form_validation->set_message('image_kyc',$error);
				$this->form_validation->set_message('image_kyc','The File size has been exceeded by 2mb. Max Size should upto 2mb.');
				return false;
			} else { 
				$image = $this->upload->data('file_name');
				$this->session->set_userdata('image_kyc',$image);
				return true;
			}
		}else{
			 $this->form_validation->set_message('image_kyc', "No file selected");
			 return false;
		}
	}
	
/****************    FUNCTION IS USE TO SEND EMAIL   ****************/
	function send_email_user($email,$data,$subject,$template_id){
		
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		//$subject = "EXample to test template";
		$to = new SendGrid\Email($data['firstname'], $email);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		// $bcc = new SendGrid\Email('null', "admin@boon.vc");
		// $mail->personalization[0]->addCc($bcc);
		$mail->personalization[0]->addSubstitution("+domain+", DOMAIN_NAME);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		//$mail->personalization[0]->addSubstitution("+token+", $data['token']);
		$mail->personalization[0]->addSubstitution("+refferal+", $data['refrence_link']);
		$mail->setTemplateId($template_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		
	}	
	
/*****************    FUNCTION IS USE TO SEND EMAIL   *****************/
	 function send_email($email,$data,$template_name,$subject){
		 //echo'<pre>';print_r($data);exit;
		  $from = DOMAIN_EMAIL;
		  $message = ''; 
		  $message = $this->load->view("email_template/".$template_name,$data, TRUE);
		  $headers .= 'MIME-Version: 1.0' . "\r\n";
		  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		  
		  // Create email headers
		  $headers .= 'From: '.$from."\r\n".
		   'Reply-To: '.$from."\r\n" .
		   'X-Mailer: PHP/' . phpversion();   
		  
		  // If you are not using Composer
		  require APPPATH."libraries/sendgrid-php/sendgrid-php.php";

		  $from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		  $subject = $subject;
		  $to = new SendGrid\Email($data['firstname'], $email);
		  $content = new SendGrid\Content("text/html", $message);
		  $mail = new SendGrid\Mail($from, $subject, $to, $content);
		  //$bcc = new SendGrid\Email('Admin', "admin@boon.vc");
		  //$mail->personalization[0]->addCc($bcc);
		  $apiKey = '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';
		  $sg = new \SendGrid($apiKey);

		  $response = $sg->client->mail()->send()->post($mail);
	 }


	
}