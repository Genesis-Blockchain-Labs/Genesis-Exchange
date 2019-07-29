<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Paypal extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $this->load->library('paypal/paypal_lib');
        $this->load->model("User_model");
    }
    
	function pay(){
        //Set variables for paypal form
        $returnURL = base_url().'paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/ipn'; //ipn url
        //get particular product data
		$amount = $this->input->post("amount");
		$fee = $amount * 3 / 100; 
		$amount = $amount + $fee +  0.30; 
		$session_data = $this->session->userdata('user_data');
        $logo = base_url().'assets/images/codexworld-logo.png';
        $this->paypal_lib->add_field('business', 'admin@boon.vc');
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
		//$this->paypal_lib->add_field('cents', 0.30);
        $this->paypal_lib->add_field('item_name', "Contribution");
        $this->paypal_lib->add_field('custom', $session_data['id']);
        $this->paypal_lib->add_field('item_number',  $session_data['id']);
        $this->paypal_lib->add_field('amount', $amount);        
        $this->paypal_lib->image($logo); 
        
        $this->paypal_lib->paypal_auto_form();
    }
	 function success(){
        //get the transaction data
       $paypalInfo    = $this->input->post();
		$data['user_id'] = $paypalInfo['custom'];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['amount'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
       // $data['payment_status']    = $paypalInfo["payment_status"];
        $data['payer_id']    = $paypalInfo["payer_id"];
        $data['receiver_id']   = $paypalInfo["receiver_id"];
        $data['payment_date']   = $paypalInfo["payment_date"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            $this->User_model->insertTransaction($data);
        }  
        
        //pass the transaction data to view
        $this->load->view('success');
     }
     
     function cancel(){
        $this->load->view('cancel');
     }
     
     function ipn(){
		// die('here rukja');
        //paypal return transaction details array
      /*   $paypalInfo    = $this->input->post();
		mail("vijay.immanentsolutions@gmail.com","My subject","$paypalInfo");
		$data['user_id'] = $paypalInfo['custom'];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['amount'] = $paypalInfo["mc_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']    = $paypalInfo["payment_status"];
        $data['payer_id']    = $paypalInfo["payer_id"];
        $data['receiver_id']   = $paypalInfo["receiver_id"];
        $data['payment_date']   = $paypalInfo["payment_date"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->user_model->insertTransaction($data);
        }  */
    }
}