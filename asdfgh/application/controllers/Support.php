<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Support extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('support_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	/***********************************************************
	Function for support section to get teh request of the users
	************************************************************/
	public function support_request(){
		$this->load->template('support');
	}
	/***********************************************************
	Function to close the ticket
	************************************************************/
	public function close_ticket($ticket){
		$this->support_model->close_ticket($this->security->xss_clean($ticket));
		redirect('support');
	}
	/*******************************************************
	Function to delete the ticket
	****************************************************/
	public function delete_ticket($ticket){
		$this->support_model->delete_ticket($this->security->xss_clean($ticket));
		redirect('support');
	}
	/*********************************************************
	Function to get the list of the support users
	**********************************************************/
	public function posts(){
		
		$columns = array( 
                            0 =>'id',
                            1 =>'firstname',
							2=>'lastname',
                            3=> 'email',
                        );

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->support_model->allposts_count();
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->support_model->allposts($limit,$start,$order,$dir);
        }
        else 
		{
			$search = $this->input->post('search')['value']; 
			$posts =  $this->support_model->posts_search($limit,$start,$search,$order,$dir);
			$totalFiltered = $this->support_model->posts_search_count($search);
			
		}

        $data = array();
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
				$nestedData['ticket_no'] = $post->id;
                $nestedData['username'] = $post->firstname.' '.$post->lastname;
                $nestedData['email'] = $post->email;
				if($post->status==1){
					$nestedData['status'] = '<span class="lbl-green">Open</span>';
				}
				else if($post->status==0){
					$nestedData['status'] = '<span class="lbl-red">Closed</span>';
				}

                $nestedData['detail'] = '<a href="'.base_url().'supportdetail/'.$post->id.'" class="btn btn-primary" target="_blank">View Detail</a>';
				 $nestedData['close'] = '<i class="fa fa-times" aria-hidden="true" onclick="confirmclose('.$post->id.')" title="Close"></i>';
				 if($post->status==0){
					  $nestedData['close'] = '<i class="fa fa-trash" aria-hidden="true" title="Delete" onclick="confirmdelete('.$post->id.')"></i>';
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
	
	/*******************************************
		Function to get the support detail
	*****************************************/
	public function support_detail($ticket_id){
		$data['support'] = $this->support_model->get_ticket_detail($this->security->xss_clean($ticket_id));
		$data['support_reply'] = $this->support_model->get_ticket_reply($this->security->xss_clean($ticket_id));
		$this->load->template('support_detail',$data);
	}
	
	/*******************************************
		Function to get the support reply  
	*****************************************/
	function support_reply(){
		$ticket_id = $this->input->post('ticket_no');
		$this->form_validation->set_rules('message', 'message', 'required');
		if($this->form_validation->run() == FALSE){	
				$data['support'] = $this->support_model->get_ticket_detail($this->security->xss_clean($ticket_id));
				$data['support_reply'] = $this->support_model->get_ticket_reply($this->security->xss_clean($ticket_id));
				$this->load->template('support_detail',$data); 
		}else{
				
				$updatedata['message'] = $this->input->post('message');
				$updatedata['ticket_no'] = $ticket_no =  $this->security->sanitize_filename($this->input->post('ticket_no'));
				$updatedata['user_id'] =  $this->security->sanitize_filename($this->input->post('admin'));
				$support = $this->support_model->get_ticket_detail($this->security->xss_clean($ticket_id));
				$userdata = $this->user_model->get_detail($this->security->xss_clean($support->user_id));
				$subject = $support->subject;
				$this->send_email_support($userdata,$updatedata,$subject);
				$return  = $this->support_model->save_reply($this->security->xss_clean($updatedata));
				if(!empty($return)){
					redirect('supportdetail/'.$ticket_no);					
				}
			}
		
	}
	/***********************************************************
			function used to send support message email 
	***********************************************************/	
	function send_email_support($userdata,$updatedata,$subjects)
	{	
		require APPPATH."libraries/sendgrid-php/sendgrid-php.php";
		$from = new SendGrid\Email(DOMAIN_NAME_ADMIN, DOMAIN_EMAIL_ADMIN);
		$subject = "EXample to test template";
		$to = new SendGrid\Email($userdata->firstname, $userdata->email);
		$content = new SendGrid\Content("text/html", 'A');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$mail->personalization[0]->addSubstitution("+name+", $userdata->firstname);
		$mail->personalization[0]->addSubstitution("+reply+", $updatedata['message']);
		$mail->personalization[0]->addSubstitution("+subject+", $subjects);
		$mail->personalization[0]->addSubstitution("+ticket_no+", $updatedata['ticket_no']);
		$temp_id = 'db75fa39-3510-40b8-83e9-9a2fdc282806';
		$mail->setTemplateId($temp_id);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		
	}
}