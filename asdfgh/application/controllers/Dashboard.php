<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Dashboard extends CI_Controller {
	function __construct(){
	  parent::__construct();
      $this->load->model('user_model');
	  $this->load->model('Dashboard_model');
      $this->load->library('form_validation');
      $this->load->library('pagination'); 
	  $this->load->helper('security');
	  $this->load->library('encrypt');
	  $this->load->library('GoogleAuthenticator');
    }
	
	/*******************************************
	-------------load admin dashboard -------
	*******************************************/   
    function index(){ 
		
		require APPPATH."libraries/coinpayments.inc.php";
		$data['pie'] = $this->Dashboard_model->kyc_piechart();
		$line = $this->Dashboard_model->kyc_linechart();
		$date = array();
		
		for($i = 30; $i >= 0; $i--){
			$dat[]['day']  = date('Y-m-d', strtotime('-'.$i.' days'));			
		}
		foreach($dat as $key => $dt){
			$k=1;
			foreach($line as $ln){
				if($ln->day == $dt['day']){
					$k=0;
					$date[$key]['day'] = date("D d-m", strtotime($ln->day));
					$date[$key]['total'] = $ln->total;
				}
			}
			if($k == 1){
				$date[$key]['day'] =  date("D d-m", strtotime($dt['day']));
				$date[$key]['total'] = 0;
			}
			
		}
		$data['line'] = $date;
		//////////////////////////for coin balance//////////////////////
		$cps = new CoinPaymentsAPI();
		$cps->Setup(COINPAYMENT_PRIVATE_KEY, COINPAYMENT_PUBLIC_KEY);
		$result = $cps->GetBalances();
		if ($result['error'] == 'ok') {
				$data['balance'] = $result['result'];
		}
		$data['sold_coin'] = $this->Dashboard_model->sold_coin();
		$data['ico_date'] = $this->Dashboard_model->ico_date();
		//////////////////////////////////////
       	$this->load->template('index',$this->security->xss_clean($data));
    }

	/*********************************************
	------------- Delete Event ----------
	*********************************************/
    function del_event($did,$table){
        $resp = $this->Dashboard_model->del_event($did,$table);
        redirect('admin/user/user_work');
    }
	 /*********************************************
		FUNCTION IS USE TO  PROGRESS BAR VIEW
	*********************************************/  
	function progress_bar(){
		$data['progress'] = $this->Dashboard_model->progress_bar();
		$this->load->template('progress_bar',$data);
	}

	/********************************************************
	FUNCTION IS USE TO SAVE AND UPDATE THE PROGRESS BAR DATA
	********************************************************/
	function save_progress_bar(){
		if(!empty($this->input->post('Raised')) || !empty($this->input->post('progress_bar'))){
			$raised = $this->security->sanitize_filename($this->input->post('Raised'));
			$progress_bar = $this->security->sanitize_filename($this->input->post('progress_bar'));
			$progress = $this->Dashboard_model->save_progress_bar($this->security->xss_clean($raised),$this->security->xss_clean($progress_bar));
			if($progress){
				$this->session->set_flashdata('msg',success_message('Save successfully.'));
				$data['progress'] = $this->Dashboard_model->progress_bar();
				$this->load->template('progress_bar',$this->security->xss_clean($data));
			}else{
				$this->session->set_flashdata('msg',error_message('Not Save'));
				$data['progress'] = $this->Dashboard_model->progress_bar();
				$this->load->template('progress_bar',$this->security->xss_clean($data));
			}
		}else{
			$data['progress'] = $this->Dashboard_model->progress_bar();
			$this->load->template('progress_bar',$this->security->xss_clean($data));
		}
		
	}


	/********************************************************
			FUNCTION IS USE TO ico VIEW
	********************************************************/
	function ico(){
		$data['ico'] = $this->Dashboard_model->ico();
		$this->load->template('ico',$data);
	}	
	
	/********************************************************
	FUNCTION IS USE TO SAVE AND UPDATE THE PROGRESS BAR DATA
	********************************************************/
	function save_ico(){
		if(!empty($this->input->post('ico'))){
			$ico = $this->security->sanitize_filename($this->input->post('ico'));
			$progress = $this->Dashboard_model->save_ico($this->security->xss_clean($ico));
			if($progress){
			$this->session->set_flashdata('msg',success_message('Save successfully.'));
				$data['ico'] = $this->Dashboard_model->progress_bar();
				$this->load->template('ico',$this->security->xss_clean($data));
			}else{
				$this->session->set_flashdata('msg',error_message('Not save.'));
				$data['ico'] = $this->Dashboard_model->progress_bar();
				$this->load->template('ico',$this->security->xss_clean($data));
			}
		}else{
			$data['ico'] = $this->Dashboard_model->progress_bar();
			$this->load->template('ico',$this->security->xss_clean($data));
		}
		
	}	
	
	/********************************************************
			FUNCTION IS USE TO GOOGLE AUTH
	********************************************************/
	function google_auth(){
		$session = $this->session->userdata('user_data');
		if(!empty($session)){
			$user_id = $session['id'];
			$data['userdata'] = $this->Dashboard_model->get_user($user_id);
			$gauth = new GoogleAuthenticator();
			$secret = $gauth->createSecret();
			$qrCodeUrl = $gauth->getQRCodeGoogleUrl($session['username'], $secret,DOMAIN_NAME);
			$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);
			$this->load->template('authentication',$this->security->xss_clean($data));
		}else{
			redirect('/');
		}
		
	}

	/********************************************************
			enable google auth code
	********************************************************/	
	function enable_google_auth(){	
		$data['active_class'] = 'authentication';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session)){
			$user_id = $session['id'];
			$datas['authentication'] = '1';			
			$this->Dashboard_model->update_auth($this->security->xss_clean($user_id),$this->security->xss_clean($datas));
			$this->session->set_flashdata('msg',success_message('Google authentication is enable successfully.'));
			redirect('authentication');
		}else{
			redirect('/'); 
		}
	}
	

	/********************************************************
			disable google auth code
	********************************************************/
	function disable_google_auth(){
		$data['active_class'] = 'authentication';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		
		if(!empty($session)){
			$user_id = $session['id'];
			$datas['authentication'] = '0';
			$auth_code = $this->security->sanitize_filename($this->input->post('auth_code'));
			$admindata = $this->Dashboard_model->get_user($this->security->xss_clean($user_id));
			
			$gauth = new GoogleAuthenticator();
			$secret = $gauth->createSecret();
			
			$checkResult = $gauth->verifyCode($admindata['google_auth_code'], $auth_code, 2);    // 2 = 2*30sec 
			if($checkResult){ 
				$this->session->set_userdata('user_data',$result);		
				$this->Dashboard_model->update_auth($this->security->xss_clean($user_id),$this->security->xss_clean($datas));
				
				$this->session->set_flashdata('msg',success_message('Google authentication is disabled successfully.'));
				
				redirect('authentication');
			}else{
			
			$this->session->set_flashdata('msg',error_message('Invalid Authenticate Code!'));
				redirect('authentication');
			}	
		}else{
			redirect('/');
		}
	}

	/********************************************************
			enableauthpass 
	********************************************************/
	function enableauthpass(){
		$data['active_class'] = 'authentication';	
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			$user_id = $session['id'];
			$datas['authentication'] = '0';
			$password = $this->security->sanitize_filename($this->input->post('password'));
			$admindata = $this->Dashboard_model->get_user($this->security->xss_clean($user_id));
			$decrypted = $this->encrypt->decode($admindata['password']); 
		
			if($password != $decrypted){
				$this->session->set_flashdata('msg',error_message('Invalid Password!'));
				redirect('authentication');
			}else{
				
				$gauth = new GoogleAuthenticator();
				$secret = $admindata['google_auth_code'];
				$qrCodeUrl = $gauth->getQRCodeGoogleUrl($admindata['username'], $secret,DOMAIN_NAME);
				$data['google_auth'] = array('auth_url'=>$qrCodeUrl, 'auth_code'=>$secret);			
			
				$this->load->template('re_enable_google',$this->security->xss_clean($data));
			}				
		}else{
			redirect('/');
		}
	}
}
?>