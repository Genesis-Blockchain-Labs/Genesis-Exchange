<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hmac extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('CoinPaymentsAPI');
		$this->cps = new CoinPaymentsAPI();
		$this->cps->Setup(PRIVATE_KEY, PUBLIC_KEY);
	}
	
// 	public function sendgrid(){
// 		$ema= "ftttttDFt@gmail.com";
// 		$namd = "afsasf";
// 		$json = json_encode(array("email"=>$ema, "first_name"=>$namd));
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.sendgrid.com/v3/contactdb/recipients",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "[\r\n $json\r\n]",
//   CURLOPT_HTTPHEADER => array(
//     "authorization: Bearer ".SENDGRIDKEY,
//     "cache-control: no-cache"
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }
// 	}
	/************************************************
	Function to get the ipn detail from coinpayment
	************************************************/
	public function index(){
	   		 $cp_debug_email = CP_DEBUG_EMAIL;
		    function errorAndDie($error_msg) {
			        global $cp_debug_email;
			        if (!empty($cp_debug_email)) {
			            $report = 'Error: '.$error_msg."\n\n";
			            $report .= "POST Data\n\n";
			            foreach ($_POST as $k => $v) {
			                $report .= "|$k| = |$v|\n";
			            }
			            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
			        }
			        die('IPN Error: '.$error_msg);
			    }

// print_r($_SERVER['HTTP_HMAC']); die;
		    // if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
		    //     errorAndDie('IPN Mode is not HMAC');
		    // }

		    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
		      //  errorAndDie('No HMAC signature sent.');
		    	echo json_encode(array('status'=>0, 'message'=>'No HMAC signature sent.'));die;
		    }

		    $request = file_get_contents('php://input');
		    if ($request === FALSE || empty($request)) {
		      //  errorAndDie('Error reading POST data');
		    		echo json_encode(array('status'=>0, 'message'=>'Error reading POST data'));die;
		    }

		    // if (!isset($_POST['merchant']) || $_POST['merchant'] != trim(CP_MERCHANT_ID)) {
		    //     errorAndDie('No or incorrect Merchant ID passed');
		    // }

		   $hmac = hash_hmac("SHA512", $request, trim(CP_IPN_SECRET));
		       if ($hmac != $_SERVER['HTTP_HMAC']) { 
		          //  errorAndDie('HMAC signature does not match');//
		       	echo json_encode(array('status'=>0, 'message'=>'HMAC signature does not match'));die;
		        }
	     
	     mail("malkeet.boominfotech@gmail.com", "subject", "Hmac is ok");
	     echo json_encode(array('status'=>1, 'message'=>'HMAC is Ok'));die;
			// HMAC Signature verified at this point, load some variables.

	} 		
}