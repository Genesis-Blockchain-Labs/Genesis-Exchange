<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('kyc_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
		$this->load->helper('form');
		
	}
	
	/***********************************************************
			function used to get all users list
	***********************************************************/
	function get_users(){
		$data['user_detail'] = $this->user_model->get_users();
		$this->load->template('user_list', $this->security->xss_clean($data));
	}
	
	/***********************************************************
			function used for delete user
	***********************************************************/
	function delete_user($user_id){
		$data['user'] = $this->user_model->delete_user($this->security->xss_clean($user_id));
		redirect('user_list');
	}	
	/***********************************************************
			function to delet user parmanently from the database
	***********************************************************/
	function fulldelete_user($user_id){
		$this->user_model->delete_user_complete($this->security->xss_clean($user_id));
		redirect('user_list');
	}
	/***********************************************************
	unsuspend user
	
	***********************************************************/
	function unsuspend($user_id){
		$data['user'] = $this->user_model->unsuspend($this->security->xss_clean($user_id));
		redirect('user_list');
	}
	/***********************************************************
		function is use to list of all register invest users
	***********************************************************/
	function get_invest_users(){
		$data['user_detail'] = $this->user_model->get_invest_users();
		$this->load->template('invest_user', $this->security->xss_clean($data));
	}

	/***********************************************************
				function used to fetch users
	***********************************************************/
	function posts()
	{
		$columns = array( 
                            0 =>'id', 
                            1 =>'firstname',
							2=>'lastname',
                            3=> 'email',
							//4=>'balance',
							//5=>'total_refer_user',
							//6=>'balance_refered',
							4=>'status',
                        );

		$limit = $this->security->sanitize_filename($this->input->post('length'));
		$start = $this->security->sanitize_filename($this->input->post('start'));
		
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->security->sanitize_filename($this->input->post('order')[0]['dir']);
		$totalData = $this->user_model->allposts_count();
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->user_model->allposts($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($order),$this->security->xss_clean($dir));
        }
        else 
		{
			$search = $this->security->sanitize_filename($this->input->post('search')['value']); 
			$posts =  $this->user_model->posts_search($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($search),$this->security->xss_clean($order),$this->security->xss_clean($dir));
			$totalFiltered = $this->user_model->posts_search_count($this->security->xss_clean($search));
		}

        $data = array();
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['firstname'] = $post->firstname;
				$nestedData['lastname'] = $post->lastname;
                $nestedData['email'] = $post->email;
				$nestedData['balance'] = $post->total_coins;
			
				$nestedData['total_refer_user'] = $post->total_refer_user;
				$nestedData['balance_refered'] = $post->balance;
				if($post->status==1){
					$nestedData['status'] = '<span class="lbl-green">Active</span>';
				}
				else if($post->status==0){
					$nestedData['status'] = '<span class="lbl-red">Inactive</span>';
				}
				else if($post->status==3){
					$nestedData['status'] = '<span class="lbl-orange">Suspended</span>';
				}   
               
                $nestedData['detail'] = '<a href="'.base_url().'userdetail/'.$post->id.'" class="btn btn-primary" target="_blank">Detail</a>';
				if($post->status==3){
					 $nestedData['delete'] = '<i class="fa fa-lock fa-fw action_but" aria-hidden="true" title="Unsuspend" onclick="unsuspend('.$post->id.')"></i><i class="fa fa-trash fa-fw action_but" aria-hidden="true" title="Delete" onclick="confirmfullDeletion('.$post->id.')"></i>';

					
				}
				else{
					 $nestedData['delete'] = '<i class="fa fa-unlock fa-fw action_but" aria-hidden="true" title="Suspend" onclick="confirmDeletion('.$post->id.')"></i><i class="fa fa-trash fa-fw action_but" aria-hidden="true" title="Delete" onclick="confirmfullDeletion('.$post->id.')"></i>';

				}
               
                
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
	
	/***********************************************************
			function used to fetch single user detail
	***********************************************************/
	public function user_detail($user_id)
	{
		$data['user'] = $this->user_model->get_detail($user_id);
		$this->load->template('user_detail',$data);
	}

	/***********************************************************
			function used to update user detail
	***********************************************************/	
	public function update_userdetail()
	{
				require APPPATH."libraries/security.php";
				$user_id = $this->security->sanitize_filename($this->input->post('user_id'));
				$data['user'] = $this->user_model->get_detail($this->security->xss_clean($user_id));
				$firstname = $this->security->sanitize_filename($this->input->post('firstname'));
				$lastname = $this->security->sanitize_filename($this->input->post('lastname'));
				$phone = $this->security->sanitize_filename($this->input->post('phone'));
				$password = $this->security->sanitize_filename($this->input->post('password1'));
				$cpassword = $this->security->sanitize_filename($this->input->post('cpassword1'));
				$status = $this->security->sanitize_filename($this->input->post('status'));
				
				if($firstname!=""){
					$updatedata['firstname']=$firstname;
				} if($lastname!=""){
					$updatedata['lastname']=$lastname;
				}
				 if(!empty($phone)){
					$updatedata['phone']=$phone;
				}
				 if(!empty($status)){
					 $updatedata['status']=$status;
					
				}
				 if($password!=""){
					$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
						$encrypted = UnsafeCrypto::encrypt($password, $key, true);
						$updatedata['password'] = $encrypted;
				}
				
				$return  = $this->user_model->update_user($this->security->xss_clean($user_id),$this->security->xss_clean($updatedata));
				if($return==true){
					$data['user'] = $this->user_model->get_detail($this->security->xss_clean($user_id));
					$this->session->set_flashdata('error_msg','User details updated successfully.');
					$this->load->template('user_detail',$data); 
				}
	}

	/***********************************************************
			function used to update token of user 
	***********************************************************/
	function update_token()
	{
		$user_id = $this->security->sanitize_filename($this->input->post('user_id'));
		$userdata = $this->user_model->get_detail($this->security->xss_clean($user_id));
		$udata['previous_coins'] = $this->security->sanitize_filename($this->input->post('prev_coins'));
		$udata['total_coins'] = $this->security->sanitize_filename($this->input->post('total_coins'));
		$udata['token_change_rs'] = $this->security->sanitize_filename($this->input->post('reason'));
		$this->send_email_update_token($userdata,$udata);
		$return = $this->user_model->update_token($this->security->xss_clean($user_id),$this->security->xss_clean($udata));
		$data['user'] = $this->user_model->get_detail($this->security->xss_clean($user_id));
		$this->session->set_flashdata('error_msg','Tokens updated successfully.');
		redirect('userdetail/'.$user_id);
	}
	
	/***********************************************************
			function used to send user token change email 
	***********************************************************/	
	function send_email_update_token($data,$udata)
	{
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME_ADMIN, DOMAIN_EMAIL_ADMIN);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($data->firstname, $data->email);
		$content = new SendGrid\Content("text/html", 'A');
	
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $data->firstname);
		$mail->personalization[0]->addSubstitution("+reason+", $udata['token_change_rs']);
		$mail->personalization[0]->addSubstitution("+previous_token+", $udata['previous_coins']);
		$mail->personalization[0]->addSubstitution("+updated_token+", $udata['total_coins']);
		$temp_id = '96847ee1-0edf-4486-a359-e0e54e2f8e20';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		
	}
	
}