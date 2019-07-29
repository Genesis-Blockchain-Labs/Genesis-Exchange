<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Home_model");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
	}
	
	/****************************************************************
	 function is use to get bonus/end date ico/reffral users	
	****************************************************************/ 
	
	function icoBonusDate()
	{
		$data['sold_coin'] = $this->Home_model->sold_coin();
		$data['ico_date'] = $this->Home_model->ico_date();
		$reffuser = $this->Home_model->refrel_usr();
		
		$reffral = '<table class="table">';
		foreach($reffuser as $val)
		{
			$reffral .= '<tr>
				<td>'.substr($val['username'],0,3).'xxxx</td>
				<td>'.substr($val['reffred_username'],0,3).'xxxx</td>
				<td class="font-bold"><span class="number1">'.$val['coins'].'</span> EPR Token</td>
				<td>'.$val['ipn_date'].'</td>
			</tr>';
		}
			
		$reffral .= '</table>';
		$data['reffral'] = $reffral;
		
		$eventslist = $this->Home_model->events();
		if(!empty($eventslist))
		{
			$evnts = '<div class="carousel-item active"><ul class="ref flexRow">';
			foreach($eventslist as $evt)
			{
				$evnts .= '<li><a href="'.$evt['event_link'].'" target="_blank"><img src="'.PARTNER_URL.'img/'.$evt['logo'].'" class="img-fluid sr-contact hvr-pop"></a></li>';
			}
			$evnts .= '</ul></div>';
			
			$evnts .= '<div class="carousel-item"><ul class="ref flexRow">';
			foreach($eventslist as $evt)
			{
				$evnts .= '<li><a href="'.$evt['event_link'].'" target="_blank"><img src="'.PARTNER_URL.'img/'.$evt['logo'].'" class="img-fluid sr-contact hvr-pop"></a></li>';
			}
			$evnts .= '</ul></div>';
		}
		$data['evevts'] = $evnts;
		
		$partnerslist = $this->Home_model->partners(); 
		if(!empty($partnerslist))
		{
			$partners = '<div class="carousel-item active"><ul class="ref flexRow">';
			foreach($partnerslist as $prt)
			{
				$partners .= '<li><a href="'.$prt['event_link'].'" target="_blank"><img src="'.PARTNER_URL.'img/'.$prt['logo'].'" class="img-fluid sr-contact hvr-pop"></a></li>';
			}
			$partners .= '</ul></div>';
			
			$partners .= '<div class="carousel-item"><ul class="ref flexRow">';
			foreach($partnerslist as $prt)
			{
				$partners .= '<li><a href="'.$prt['event_link'].'" target="_blank"><img src="'.PARTNER_URL.'img/'.$prt['logo'].'" class="img-fluid sr-contact hvr-pop"></a></li>';
			}
			$partners .= '</ul></div>';
		}
		$data['partners'] = $partners;
		
		echo json_encode(array('data'=>$data));
		
	}
	
	/***************************************************************************
			function used to check website status
	***************************************************************************/
	function get_website_status($ip){
	//echo "hello";die;
	$data = $this->Home_model->get_website_status();
	$result = $this->Home_model->get_ipbloack($ip);
	echo json_encode(array('web_status'=>$data, 'ip'=>$result));
	}

	/***************************************************************************
			function used to save news letters
	***************************************************************************/
	function newsletter(){
		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('email', '', 'trim|required|valid_email');
		if($this->form_validation->run() == FALSE){   
			echo json_encode(array('data'=>"All fields are mandatory and email format should be correct."));
		  }else{
		$data['name'] = $this->security->sanitize_filename($this->input->post('name'));		
		$data['email'] 	= $this->security->sanitize_filename($this->input->post('email'));	
		$checkemail = $this->Home_model->checkifemailalreadythere($this->security->xss_clean($data['email']));	
		if($checkemail>0){
		$returndata = $this->Home_model->saveNewsLetter($this->security->xss_clean($data));
		if($returndata >0)
		{	
			$name = $this->security->xss_clean($data['name']);
			$email = $this->security->xss_clean($data['email']);
			$json = json_encode(array("email"=>$email, "first_name"=>$name));
					$curl = curl_init();
					curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.sendgrid.com/v3/contactdb/recipients",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "[\r\n $json\r\n]",
				    CURLOPT_HTTPHEADER => array(
					    "authorization: Bearer ".SENDGRIDKEY,
					    "cache-control: no-cache"
					  ),
					));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					echo json_encode(array('data'=>"You have successfully subscribed to the newsletter."));
		}else{
			echo json_encode(array('data'=>"Something went wrong!"));
		}		
		}else{
			echo json_encode(array('data'=>"You are already subscribed to the newsletter."));
		}
	}//end validation check
  }//end function
}