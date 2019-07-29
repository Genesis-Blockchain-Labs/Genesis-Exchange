<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Referalmanage extends CI_Controller {

	function __construct(){
		
	  parent::__construct();
      $this->load->model('user_model');
	  $this->load->model('referal_model');
      $this->load->library('form_validation');
      $this->load->library('pagination'); 
	  $this->load->helper('security');
	  $this->load->library('GoogleAuthenticator');
    }
	
	/***********************************************************
				function used to show referal users
	***********************************************************/
	public function index(){
	
		$data['referral'] = $this->referal_model->get_referral();
		$this->load->template('referalmanage',$data);
	}
	
	/***********************************************************
				function used to save reffral
	***********************************************************/
	public function save_referral(){
	
			$datas['referral'] = $this->referal_model->get_referral();
			$this->form_validation->set_rules('bonus', '', 'required');
			if($this->form_validation->run() == FALSE){		
				$this->load->template('referalmanage',$datas); 
			}else{

				$data['system_management'] = $this->security->sanitize_filename($this->input->post('system_management'));	
				$data['bonus'] = $start_date = $this->security->sanitize_filename($this->input->post('bonus'));	
				 $data['date'] = date('Y-m-d h:i:s');
				 $data['timestamp'] = strtotime($data['date']); 
				$check_refer = $this->referal_model->get_referral_by_date($this->security->xss_clean($data['timestamp']));
				$time_stamp = $check_refer['timestamp'];
				if(!empty($check_refer)){
						$response = $this->referal_model->update_referal($this->security->xss_clean($time_stamp),$this->security->xss_clean($data));
				}else{
					$response = $this->referal_model->insert_referal($this->security->xss_clean($data));
				}
				if(!empty($response)){
				$this->session->set_flashdata('error_msg', 'Referral settings saved.');
				}
				$datas['referral'] = $this->referal_model->get_referral();
				redirect('referral');
			}
	}
}