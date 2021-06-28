<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Kyc extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('kyc_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	
//function is use to list of all kyc users  
	function get_all_kyc(){
		$data['kyc_detail'] = $this->kyc_model->get_all_kyc();   
		
		$this->load->template('kyc_list', $this->security->xss_clean($data));
	}	
	
//function is use to list of all register users
	function get_kyc($user_id){
		$data['user_detail'] = $this->kyc_model->get_config($this->security->xss_clean($user_id));
		$data['user'] = $this->user_model->get_user_kyc($this->security->xss_clean($user_id));
		$data['contribution'] = $this->kyc_model->get_contribution($user_id);
		$data['tracking_detail'] = $this->kyc_model->get_tracking($user_id);
		
		$reference_id = $data['user_detail']['reference_id'];
		$data['refrel_usr'] = $this->kyc_model->refrel_usr($reference_id);
		
		if(!empty($data['contribution']->referral_bonus_percentage)){
			$percentage = $data['contribution']->referral_bonus_percentage;
		}else if($data['contribution']->referral_bonus_percentage == '0'){
			$percentage = 0;
		}else{
			$percentage = 10;
		}
		
		$data['own_coins'] = $this->kyc_model->get_own_coin($percentage,$user_id);	
		$data['reward_points'] = $this->kyc_model->reward_points($percentage,$data['refrel_usr']);	
		
		$data['account'] = $this->kyc_model->get_account($user_id);
		
		
		$this->load->template('kyc_detail', $data);
	}

//  FUNCTION IS USE TO GET BOON POINTS from percentage
	function get_refrel_bonus(){		
		$user_id = $this->security->sanitize_filename($this->input->post('user_id'));
		$percent = $this->security->sanitize_filename($this->input->post('percent'));
		$data['user_detail'] = $this->kyc_model->singleuserDetail($user_id);
		$email = $data['user_detail']->email;
		$refernce_id = $data['user_detail']->reference_id;
		
		$data['refrel_usr'] = $this->kyc_model->refrel_usr($refernce_id);
		
		if(!empty($data['refrel_usr'])){
			$points = $this->kyc_model->get_refrel_bonus($percent,$data['refrel_usr']);
			if(!empty($points)){
				echo json_encode(array('data'=>$points,'success'=>'1'));
			}else{
				echo json_encode(array('data'=>'0','success'=>'0'));
			}
		}
		
	}
	
	
//function is use to list of all register users
	function change_status(){
		$id = $this->security->sanitize_filename($this->input->post("user_id"));
		$status = $this->security->sanitize_filename($this->input->post("status"));
		if($status == "verified"){
			$data = $this->user_model->get_user_kyc($this->security->xss_clean($id));
			$this->send_email_user($data);
		}
		$this->kyc_model->change_status($id,$status);
		echo '1';
	}	
	
	
//  FUNCTION IS USE TO GET REFEREL USER LIST
	function get_referel_user($user_id){
		$data['user_detail'] = $this->user_model->get_user_kyc($this->security->xss_clean($user_id));
		
		$email = $data['user_detail']['email'];
		$refernce_id = $data['user_detail']['reference_id'];
		$data['refrel_usr'] = $this->kyc_model->refrel_usr($refernce_id);		
		if(!empty($data['refrel_usr'])){
			$data['user'] = $this->kyc_model->get_referel_user_total_coin($data['refrel_usr']);
			
			$this->load->template('refrel_detail',$data);
		}else{
			$this->load->template('refrel_detail',$data);
		}
		
	}

	

	function check_email(){
		$id = '1';
		$data = $this->user_model->get_user_kyc($this->security->xss_clean($id));
		$this->send_email_user($data);
	}
	
/****************    FUNCTION IS USE TO SEND EMAIL   ****************/
	function send_email_user($data){
		$email = $data['email'];
		
		$subject = 'Congratulations, Your kyc is approved.';
		$template_id = '9639886a-c3fb-4332-b6f0-6443e44e7a96';
		
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME, DOMAIN_EMAIL);
		
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
	
// FUNCTION IS USE TO DOWNLOAD THE KYC IMAGE	 
	public function download($id) {		 
	
		$user = $this->kyc_model->kycDetail($id);
		$this->load->helper('download'); 
		$fileName = $user->image; 
		$data['download_file'] = 'http://demodemodemo.info/blackDollar/uploads/kyc/'.$user->image;   
		$this->load->view("download_view",$data);
		redirect('kyc_detail/'. $id);                      
	}	 	
	
	///////////////function used to fetch kyc list/////////////////
function kyc_list()
{
	
	$columns = array( 
                            0 =>'id', 
                            1 =>'name',
                            2=> 'Country',
                            3=> 'Purchase_amount',
                            4=> 'contributton_amount',
                            5=> 'reference',
                            6=> 'referred',
                            8=> 'eth_address',
                            9=> 'status',
                            10=> 'detail',
                        );

		$limit = $this->input->post('length');
		
        $start = $this->input->post('start');
		
        $order = $columns[$this->input->post('order')[0]['column']];
		
        $dir = $this->input->post('order')[0]['dir'];
		
        $totalData = $this->kyc_model->allkyc_count();
		  
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            
			$posts = $this->kyc_model->allkyc($limit,$start,$order,$dir);
			
        }
        else {
			
            $search = $this->input->post('search')['value']; 
            
            $posts =  $this->kyc_model->kyc_search($limit,$start,$search,$order,$dir);
			

            $totalFiltered = $this->kyc_model->kyc_search_count($search);
			
        }

        $data = array();
        if(!empty($posts))
        {
          
			
			foreach ($posts as $post)
            {

                $nestedData['id'] = $start + 1;
				$nestedData['name'] = $post->firstname.' '.$post->lastname;
                $nestedData['Country'] = $post->country;
                $nestedData['Purchase_amount'] = $post->purchase_amount;
                $nestedData['contributton_amount'] = $post->contribution_in_dollar;
                $nestedData['reference'] = $post->reference_id;
                $nestedData['referred'] = $post->refered_id;
                $nestedData['eth_address'] = $post->eth_address;
				
				if($post->kyc_status == "under"){$under = "selected";}else{$under = "";}
				if($post->kyc_status == "verified"){$verified = "selected"; $disabled = "disabled";}else{$verified = ""; $disabled = "";}
				
				$nestedData['status'] = '<select name="status" onchange="status(value,'.$post->id.')" class="form-control stt"  '.$disabled.' id="'.$post->id.'">
				<option value="under" '.$under.'>Under Process</option>
				<option value="verified" '.$verified.'>Verified</option>
				</select>';
				$nestedData['detail'] = '<a href="'.base_url().'kyc_detail/'.$post->id.'" class="btn btn-primary" target="_blank">View Detail</a>';
                
                
                $data[] = $nestedData;
				$start++;
				

            }
        }
		
		
        
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data);
}
	
}