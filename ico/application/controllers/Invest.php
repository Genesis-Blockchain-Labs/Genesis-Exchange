<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Invest extends CI_Controller{
    function  __construct() {
        parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('session');
		$this->load->model("check_model");
		$this->load->model("Dashboard_model");
		$this->load->model("user_model");
		$this->load->model("invest_model");
		$this->load->library('CoinPaymentsAPI');
		$this->cps = new CoinPaymentsAPI();
		$this->cps->Setup(PRIVATE_KEY, PUBLIC_KEY);
    }
	/***************************************
		Funtion to get the invest view Page
	***************************************/
	public function index(){
		$session_data = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session_data)){
			$user_id = $session_data['user_id'];
			$data['active_class'] = 'invest';
			$current_date = date('Y-m-d');
			$data['price_bonus'] = $this->invest_model->get_price_bonus($current_date);
			$data['ico_setup'] = $this->invest_model->ico_setup_data('pre_ico');
			$data['account_btc'] = $this->invest_model->get_account($this->security->xss_clean($user_id),1);
			$data['account_eth'] = $this->invest_model->get_account($this->security->xss_clean($user_id),2);
			$data['account_ltc'] = $this->invest_model->get_account($this->security->xss_clean($user_id),4);
			$data['account_dash'] = $this->invest_model->get_account($this->security->xss_clean($user_id),3);
			$data['btc_address'] = $this->GetDepositAddress('BTC');
			$data['eth_address'] = $this->GetDepositAddress('ETH');
			$data['doge_address'] = $this->GetDepositAddress('DOGE');
			$data['bnb_address'] = $this->GetDepositAddress('BNB');
			$this->load->view('invest',$data);
		}else{
			redirect('login');
		}
	}
	/******************************************
		Function To get  Get deposit address 
	*******************************************/
	
	public function GetDepositAddress($currency)
	{
		$result = $this->cps->GetDepositAddress($currency);
		if ($result['error'] == 'ok') {
		return $result['result']['address'];
	      } else {
		    return $result['error'];
	     }	
	}
	/********************************************
		Function to create transaction for coin payment
	***********************************************/
	public function createTransaction()
	{
		$amount = $this->security->sanitize_filename($this->input->post('amount'));
		$currency1 = $this->security->sanitize_filename($this->input->post('currency'));
		$currency2 = $this->security->sanitize_filename($this->input->post('currency'));
		$token = $this->security->sanitize_filename($this->input->post('epr_token'));
		$dollar_amount = $this->security->sanitize_filename($this->input->post('dollar_amount'));
		$session = $this->session->userdata('user_data');
		$user_id = $session['user_id'];
		$users= $this->user_model->get_usr_data($this->security->xss_clean($user_id));
		$buyer_email = $users['email'];
		$update_data['coin_type'] = $this->security->sanitize_filename($this->input->post('coin_type'));
		$ipn_url =  base_url().'index.php/wallet/getipndetailfromcoinpayment';
		$result['response'] = $this->cps->CreateTransactionSimple($amount, $currency1, $currency2, $ipn_url, $user_id, $token, $dollar_amount, $buyer_email);
		//$result['response'] = $this->cps->CreateTransactionSimple('0.0001', $currency1, $currency2, $ipn_url, $buyer_email, $user_id, $token, $dollar_amount);
		$update_data['date'] = date('Y-m-d h:i:s');
		$update_data['address'] = $result['response']['result']['address'];
		$update_data['transaction_id'] = $result['response']['result']['txn_id'];
		$update_data['amount'] = $amount;
		$am = $result['response']['result']['amount'];
		$result['response']['result']['amount'] = round($am,3);
		$result['response']['result']['epr_token'] = $token;
		if($update_data['coin_type']==1){
			$return = $this->invest_model->save_btc($this->security->xss_clean($user_id),$this->security->xss_clean($update_data));
		}else if($update_data['coin_type']==2){
			$return = $this->invest_model->save_eth($this->security->xss_clean($user_id),$this->security->xss_clean($update_data));
		}
		else if($update_data['coin_type']==3){
			$return = $this->invest_model->save_dash($this->security->xss_clean($user_id),$this->security->xss_clean($update_data));
		}
		else if($update_data['coin_type']==4){
			$return = $this->invest_model->save_investment($this->security->xss_clean($user_id),$this->security->xss_clean($update_data)); 
		}
		if($return){
			echo json_encode($result['response']);
		}
	}
}
?>