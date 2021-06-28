<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Eventmanage extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('event_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	/***********************************************************
	Function for event section to get teh request of the users
	************************************************************/
	public function event_request(){
		
		$data['event_list'] = $this->event_model->get_events();
		$this->load->template('event', $this->security->xss_clean($data));
		
	} 
	
	/***********************************************************
				function used to fetch event list
	***********************************************************/
	function events_posts()
	{
		$columns = array( 
                            0	=> 'id', 
                            1 	=> 'event_name',
							2	=> 'event_link',
                            3	=> 'logo',
							4	=> 'status',
                        );
		 
		$limit = $this->security->sanitize_filename($this->input->post('length'));
		$start = $this->security->sanitize_filename($this->input->post('start'));
		
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->security->sanitize_filename($this->input->post('order')[0]['dir']);
		$totalData = $this->event_model->allevent_count();
		
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->event_model->allevents($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($order),$this->security->xss_clean($dir));
        }
        else 
		{
			$search = $this->security->sanitize_filename($this->input->post('search')['value']); 
			$posts =  $this->event_model->posts_search($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($search),$this->security->xss_clean($order),$this->security->xss_clean($dir));
			$totalFiltered = $this->event_model->posts_search_count($this->security->xss_clean($search));
		}

        $data = array();
		
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['eventname'] = $post->event_name;
				$nestedData['eventlink'] = $post->event_link;
                $nestedData['logo'] = $post->logo;
				
				if($post->status==1){
					$nestedData['status'] = '<span class="lbl-green">Active</span>';
				}
				else if($post->status==0){
					$nestedData['status'] = '<span class="lbl-red">Inactive</span>';
				}
   

				$nestedData['delete'] = '<a href="'.base_url().'eventdetail/'.$post->id.'" target="_blank"><i class="fa fa-edit fa-fw action_but" aria-hidden="true" title="Edit" ></i></a><i class="fa fa-trash fa-fw action_but" aria-hidden="true" title="Delete" onclick="confirmfullDeletion('.$post->id.')"></i>';
               
                
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
	Function for add new event view page 
	************************************************************/
	function add_event(){
		
		$this->load->template('add_event');
	}
	/***********************************************************
	Function for add new event into database
	************************************************************/
	function save_event() {
		$this->form_validation->set_rules('eventname', 'event name', 'required');
		$this->form_validation->set_rules('eventlink', 'event link', 'required');
		if (empty($_FILES['logo']['name']))
		{
			$this->form_validation->set_rules('logo', 'logo', 'required');
		}
		if($this->form_validation->run() == FALSE){ 
			$this->load->template('add_event');
		}
		else{
		
		
			$event_name = $this->security->sanitize_filename($this->input->post('eventname'));
			$event_link = $this->input->post('eventlink');		
			$logoname= $this->security->sanitize_filename($_FILES['logo']['name']);	       
			//Get the content of the image and then add slashes to it 
			$updatedatalogo  = $_FILES['logochange']['tmp_name'];
				    $target_path = S_PA.$logoname;
					move_uploaded_file($updatedatalogo, $target_path);	
		  
			//Insert the eventname and path and event link in ico_events table
			$insert_id = $this->event_model->get_data($this->security->xss_clean($event_name), $this->security->xss_clean($event_link), $this->security->xss_clean($logoname));
			if($insert_id >= 1){
				$data['event_list'] = $this->event_model->get_events();
				$this->session->set_flashdata('success_msg',success_message('Event Added successfully.'));
				redirect('event');
			}
			else{
				$this->session->set_flashdata('error_msg',Error_message('Something went wrong.'));
				redirect('event');
			}
		}
	}
	
	/***********************************************************
	   function to delete event parmanently from the database
	 ***********************************************************/
	function fulldelete_event($id){
		$this->event_model->delete_event_complete($this->security->xss_clean($id));
		redirect('event');
	}
	
	/***********************************************************
		function used to fetch single event detail
	***********************************************************/
	public function event_detail($id)
	{
		$data['user'] = $this->event_model->get_detail($id);
		$this->load->template('event_detail',$data);
	} 
	
	
	/***********************************************************
		function used to update event detail
	***********************************************************/
	public function update_event()
	{ 	
		$id = $this->security->sanitize_filename($this->input->post('id'));
		$data['user'] = $this->event_model->get_detail($this->security->xss_clean($id));
		$this->form_validation->set_rules('eventname', 'event name', 'required');
		$this->form_validation->set_rules('eventlink', 'event link', 'required');
		if($this->form_validation->run() == FALSE){	
			$this->load->template('event_detail', $data);		
		}else{					 	
				if(!empty($_FILES['logochange']['name'])) {
					$updatedata['logo']  = $this->security->sanitize_filename($_FILES['logochange']['name']);	
					$updatedatalogo  = $_FILES['logochange']['tmp_name'];
				    $target_path = S_PA.$updatedata['logo'];
					move_uploaded_file($updatedatalogo, $target_path);				
				}								
				$updatedata['event_name'] = $this->security->sanitize_filename($this->input->post('eventname'));
				$updatedata['event_link'] = $this->input->post('eventlink');
				$updatedata['status'] = $this->security->sanitize_filename($this->input->post('status'));
				$return  = $this->event_model->update_user($this->security->xss_clean($id),$this->security->xss_clean($updatedata));
				if($return==true){
					$data['user'] = $this->event_model->get_detail($this->security->xss_clean($id));
					$this->session->set_flashdata('success_msg',success_message('Event details updated successfully.'));
					
					redirect('event');
				}
			}
	}

	public function get_image(){				
			$id = $this->input->post('id');
			$data = $this->event_model->get_logo($this->security->xss_clean($id));
			print($data); 
				
	}
	
}
