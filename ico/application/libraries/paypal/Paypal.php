<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends CI_Controller 
{
     function  __construct(){
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('Web_album_model');
     }
     
     
     function cancel(){
        $this->load->template('cancel');
     }
     
     function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();
        $data['trans_id']   =  $paypalInfo["txn_id"];
		$data['user_id']    =  $paypalInfo['custom'];
        $data['album_id']   =  $paypalInfo["item_number"];
       // $data['payment_gross'] = $paypalInfo["payment_gross"];
       // $data['currency_code'] = $paypalInfo["mc_currency"];
       // $data['payer_email'] = $paypalInfo["payer_email"];
       // $data['payment_status']    = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
		//$token = $this->Web_album_model->check_token($data['album_id']);

        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            $this->Web_album_model->insertTransaction($data);
        }
    }
}