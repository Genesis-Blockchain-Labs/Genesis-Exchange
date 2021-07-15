<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wallet extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('CoinPaymentsAPI');
		$this->load->model('dashboard_model');
		$this->cps = new CoinPaymentsAPI();
		$this->cps->Setup(PRIVATE_KEY, PUBLIC_KEY);
	}
	
	/************************************************
	Function to get the ipn detail from coinpayment
	************************************************/
	public function getipndetailfromcoinpayment(){
		$cp_debug_email = CP_DEBUG_EMAIL;
		function errorAndDie($error_msg) {
			global $cp_debug_email;
			if (!empty($cp_debug_email)) {
				$report = 'Error: '.$error_msg."\n\n";
				$report .= "POST Data\n\n";
				foreach ($_POST as $k => $v) {
					$report .= "|$k| = |$v|\n";
				}
				$this->sendgridMail($cp_debug_email, 'CoinPayments IPN Error', $report);
			}
			die('IPN Error: '.$error_msg);
		}

		if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
			errorAndDie('IPN Mode is not HMAC');
		}

		if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
			errorAndDie('No HMAC signature sent.');
		}

		$request = file_get_contents('php://input');
		if ($request === FALSE || empty($request)) {
			errorAndDie('Error reading POST data');
		}

		if (!isset($_POST['merchant']) || $_POST['merchant'] != trim(CP_MERCHANT_ID)) {
			errorAndDie('No or incorrect Merchant ID passed');
		}

		$hmac = hash_hmac("sha512", $request, trim(CP_IPN_SECRET));
	    if ($hmac != $_SERVER['HTTP_HMAC']) { 
			errorAndDie('HMAC signature does not match');
		}
	 
		// HMAC Signature verified at this point, load some variables.

		$data['txn_id'] = $this->security->sanitize_filename($this->input->post('txn_id'));
		$data['ipn_id'] = $this->security->sanitize_filename($this->input->post('ipn_id'));
		$data['ipn_mode'] = $this->security->sanitize_filename($this->input->post('ipn_mode'));
		$data['merchant'] = $this->security->sanitize_filename($this->input->post('merchant'));
		$data['currency'] = $this->security->sanitize_filename($this->input->post('currency1'));
		$data['amount'] = $this->security->sanitize_filename($this->input->post('amount1'));
		$data['status'] = intval($this->security->sanitize_filename($this->input->post('status')));
		$data['status_text'] = $this->security->sanitize_filename($this->input->post('status_text'));
	    // $data['email'] = $this->security->sanitize_filename($this->input->post('email'));
		$data['fees'] = $this->security->sanitize_filename($this->input->post('fee'));
		$data['received_amount'] = $this->security->sanitize_filename($this->input->post('received_amount'));
		$data['received_confirms'] = $this->security->sanitize_filename($this->input->post('received_confirms'));
		$data['user_id'] = $this->security->sanitize_filename($this->input->post('item_number'));
		$data['dollar_amount'] = $this->security->sanitize_filename($this->input->post('item_name'));
		$data['token'] = $this->security->sanitize_filename($this->input->post('custom'));
		
		$report = "POST Data\n\n";
		foreach ($_POST as $k => $v) {
			$report .= "|$k| = |$v|\n";
		}
		$this->sendgridMail($cp_debug_email, 'CoinPayments IPN SafeCardano', $report);
		
		$this->dashboard_model->saveIpnTransaction($data);
		if ($data['status'] >= 100){
			
			// Get user data
			$user_data = $this->dashboard_model->get_user_data($this->security->xss_clean($data['user_id']));
			if($data['status'] == 100)
			{
				//$this->sendEmailPayment($user_data);
			}
			$usertotalcoins = $user_data['total_coins']; 
			$refered_id = $user_data['refered_id'];
			$user_id = $user_data['user_id'];
			$user_update['total_coins'] = round(($data['token']+$usertotalcoins),2);
			$this->dashboard_model->update_token($this->security->xss_clean($user_id),$this->security->xss_clean($user_update));
			// Get main user or referral by user data	
			$referralbyuserdata = $this->dashboard_model->get_referral_user_data($this->security->xss_clean($refered_id));
			$referralbyusertotalcoins = $referralbyuserdata['total_coins'];
			$referralbyuserReferralcoins = $referralbyuserdata['referral_coins'];
			$mainUserID = $referralbyuserdata['user_id'];
			if($user_data['refered_status'] == 1)
			{
				$get_register_date = $this->dashboard_model->get_register_date($this->security->xss_clean($user_id));
				
				// Get ico referral management 	
				$referral_management = $this->dashboard_model->get_referral_management($this->security->xss_clean($get_register_date['date']));
				if(!empty($referral_management)){
					$bonus = $referral_management['bonus'];	
					// get price token on the basis of current date					
					$setUpData = $this->dashboard_model->get_setup();
					if(!empty($setUpData)){
						$dollar = $data['dollar_amount'];						
						$tolbonus = ($dollar*$bonus/100);						
						$tokenPrice = $setUpData['token_price'];
						$totalReferralToken = ($tolbonus/$tokenPrice);					
					}
					else
					{
						$totalReferralToken = '0';
					}	
					$maiUserUpdate['total_coins'] = round(($totalReferralToken+$referralbyusertotalcoins),2);
					$maiUserUpdate['referral_coins'] = round(($totalReferralToken+$referralbyuserReferralcoins),2);
					//$this->dashboard_model->update_token($this->security->xss_clean($mainUserID),$this->security->xss_clean($maiUserUpdate));
				}
			}
		}
		
		if($data['status'] == -1)
		{
			$user_data = $this->dashboard_model->get_user_data($this->security->xss_clean($data['user_id']));
			$this->sendEmailPaymentFailed($user_data,$data);
		}
	}
	
	public function sendgridMail($toEmail, $subject, $content){
		include("/var/www/bulkmail.demodemodemo.info/public_html/vendor/autoload.php");
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom("mukesh.immanent@gmail.com", "Mukesh Kumar");
		$email->setSubject($subject);
		$email->addTo($toEmail);
		$email->addContent(
			"text/html", $content
		);
		$sendgrid = new \SendGrid('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');
		try {
			$response = $sendgrid->send($email);
			//print $response->statusCode() . "\n";
			return $response->headers();
			//print $response->body() . "\n";
		} catch (Exception $e) {
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
		
	/*********************************************
		Function to send eamil for payment
	*********************************************/
	function sendEmailPayment($data){
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($data['firstname'], $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		$temp_id = '1c39bdc8-62b7-46f7-a947-568cd702050e';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
	}

	/*********************************************
		Function to send eamil for payment cancel
	*********************************************/
	function sendEmailPaymentFailed($data,$transaction){
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($data['firstname'], $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $data['firstname']);
		$mail->personalization[0]->addSubstitution("+transaction_id+", $transaction['txn_id']);
		$mail->personalization[0]->addSubstitution("+transaction_amount+", $transaction['amount']);
		$mail->personalization[0]->addSubstitution("+currency_type+", $transaction['currency']);
		$temp_id = '5fbfee9c-b737-40ad-9aed-209d69660df7';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
	}
}