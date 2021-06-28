<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Ip extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Dashboard_model');
		$this->load->model('a_login');
		$this->load->model('Ip_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
		$this->load->library('encrypt');
		$this->load->library('GoogleAuthenticator');
	}
	
	/***********************************************************
		function is use to showing view for block ip
	************************************************************/
	function ip(){
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			$this->load->template('block_ip');				
		}else{
			redirect('/');
		}
	}
	
	/***********************************************************
		this function is use to submit ip for block
	************************************************************/
	function blockip(){
		if(isset($_SESSION['ip_error_msg'])) {
			unset($_SESSION['ip_error_msg']);
		}
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			$this->form_validation->set_rules('ip', '', 'required|valid_ip');
			$this->form_validation->set_message('required', 'This field is required');
			if ($this->form_validation->run() == FALSE){
				$this->load->template('block_ip');	
			}else{
				$data['ip'] = $this->security->sanitize_filename($this->input->post('ip'));
				$saveip = $this->Ip_model->saveip($data);
				
				if($saveip == 'allready'){
					$data = array('code'=>2,'mess'=>'This ip is allready exist.');
					$this->session->set_flashdata('ip_error_msg',$data);
				}else if($saveip == 'saved'){
					$data = array('code'=>1,'mess'=>'IP address has been blocked successfully.');
					$this->session->set_flashdata('ip_error_msg',$data);
				}else{
					$data = array('code'=>0,'mess'=>'IP address not saved.');
					$this->session->set_flashdata('ip_error_msg',$data);
				}					
				$this->load->template('block_ip');
			}			
		}else{
			redirect('/');
		}
	}	
	

	/***********************************************************
		this function is use to showing view change password 
	************************************************************/
	function changepassword(){
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			$this->load->template('change_password');				
		}else{
			redirect('/');
		}
	}
	
	/***********************************************************
				Function to recover password 
	************************************************************/
	function passwordrecover(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('recoverpassword');
		} else {
			$email = $this->security->sanitize_filename($this->input->post('email'));
			$record = $this->a_login->recoverpassword($this->security->xss_clean($email));
			if(!empty($record)) {
				$token = $this->security->sanitize_filename(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz",30)),0,30));
				
				$update['token'] = $token; 
				$user_id = $record->id;
				$this->db->where('id',$user_id);
				$this->db->update('login',$update);
				$mail['email'] = $email;
				$mail['token'] = base_url().'login/resetpassword/?id='.$token;
				$this->send_email_update_password($this->security->xss_clean($mail));
				$this->session->set_flashdata('recsuc_msg','A reset password link has been sent to your email address. Please visit your email and reset the password !');
				redirect('changepassword');
			} else {
				$this->session->set_flashdata('rec_msg','Email does not exist in database. Please enter a correct email !');
				redirect('changepassword');
			}
		}
	}
	/***********************************************************
				function used to fetch blocked ip addresses
	***********************************************************/
	function posts()
	{
		$columns = array( 
                            0 =>'id', 
                            1 =>'ip',
							2=>'date',  
                        );

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->Ip_model->allposts_count();
		
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->Ip_model->allposts($limit,$start,$order,$dir);
		
		}
        else 
		{
			$search = $this->input->post('search')['value']; 
			$posts =  $this->Ip_model->posts_search($limit,$start,$search,$order,$dir);
			$totalFiltered = $this->Ip_model->posts_search_count($search);
			
		}

        $data = array();
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
				$nestedData['id'] = $start + 1;
                $nestedData['ip'] = $post->ip;
				$date = str_replace(" "," / ",$post->date);
				$nestedData['date'] = $date;
				$nestedData['unblock'] = '<i class="fa fa-unlock" title="Unblock" aria-hidden="true" onclick="confirmunblock('.$post->id.')"></i>';
                
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
	/***************************************
	function to unblock Ip address
	**************************************/
	function unblock_ip($id){
		$this->Ip_model->unblock($id);
		redirect('ip');
	}
	
	/***********************************************************
		function used to send email for admin password change 
	***********************************************************/	
	function send_email_update_password($data)
	{
	
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME_ADMIN, DOMAIN_EMAIL_ADMIN);
		$subject = "EXample to test template";
		$to = new SendGrid\Email('Admin', $data['email']);
		$content = new SendGrid\Content("text/html", 'A');
	
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+token+", $data['token']);
		$temp_id = '2dd45982-0040-4f1d-993e-c69a7ae0906a';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		
	}	
	
}	