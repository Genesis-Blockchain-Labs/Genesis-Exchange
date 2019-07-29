<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Broadcast extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('broadcast_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	/*****************************************
	Function used to load the broadcast view
	*****************************************/
	public function index(){
		$this->load->template('broadcast');
	}
	/******************************************
	Function used to save the message for the broadcast
	**************************************************/
	public function save_message(){
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			
			$this->form_validation->set_rules('message', 'message', 'required');
			$this->form_validation->set_message('required', 'This field is required');
			if ($this->form_validation->run() == FALSE){
				$this->load->template('broadcast');
			}else{
				$data['message'] = $this->security->sanitize_filename($this->input->post('message'));
				$savemessage = $this->broadcast_model->savemessage($data);
				if(!empty($savemessage)){
					$data = array('code'=>1,'mess'=>'Notification has been sent successfully.');
					$this->session->set_flashdata('broad_error_msg',$data);
				}else{
					$data = array('code'=>0,'mess'=>'Notification not sent.');
					$this->session->set_flashdata('broad_error_msg',$data);
				}
				redirect('broadcast');				
			}			
		}else{
			redirect('/');
		}
	}
	/***********************************************************
	function used to get all the broadcast messages
	************************************************************/
	public function get_all_messages(){
		$columns = array( 
                            0 =>'id', 
                            1 =>'message',
							2=>'date',  
                        );

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->broadcast_model->allmessage_count();
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $message = $this->broadcast_model->allmessage($limit,$start,$order,$dir);
        }
        else 
		{
			$search = $this->input->post('search')['value']; 
			$message =  $this->broadcast_model->message_search($limit,$start,$search,$order,$dir);
			$totalFiltered = $this->broadcast_model->message_search_count($search);
			
		}

        $data = array();
        if(!empty($message))
        {
			foreach ($message as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['message'] = $post->message;
				$date = str_replace(" "," / ",$post->date);
				$nestedData['date'] = $date;
					 $nestedData['edit'] = "<i class=\"fa fa-edit fa-fw action_but\" aria-hidden=\"true\" onclick=\"edit_message($post->id,'".$post->message."')\" title=\"Edit\"></i><i class=\"fa fa-trash fa-fw action_but\" aria-hidden=\"true\" onclick=\"confirmdelete($post->id)\" title=\"Delete\"></i>";
                
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
	Function to edit the broadcast message
	*******************************************/
	public function update_message(){
		$updata['message'] = $this->security->sanitize_filename($this->input->post('emessage'));
				$mes_id = $this->security->sanitize_filename($this->input->post('mes_id'));
				$savemessage = $this->broadcast_model->updatemessage($this->security->xss_clean($updata),$this->security->xss_clean($mes_id));
				if($savemessage==true){
					$data = array('code'=>1,'mess'=>'Notification updated  successfully.');
					$this->session->set_flashdata('broad_error_msg',$data);
				}else{
					$data = array('code'=>0,'mess'=>'Notification not updated.');
					$this->session->set_flashdata('broad_error_msg',$data);
				}
				redirect('broadcast');
	}
	/***********************************************
	Function to delet the message
	*************************************************/
	public function delete_message($id){
		
		$this->broadcast_model->delete_msg($id);
		redirect('broadcast');
	}
}