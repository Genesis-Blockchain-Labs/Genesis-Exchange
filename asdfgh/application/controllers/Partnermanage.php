<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Partnermanage extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('partner_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	/***********************************************************
	Function for partner section to get teh request of the users
	************************************************************/
	public function partner_request(){
		
		$data['partner_list'] = $this->partner_model->get_partners();
		$this->load->template('partner', $this->security->xss_clean($data));
		
	} 
	
	/***********************************************************
				function used to fetch partner list
	***********************************************************/
	function partner_posts()
	{
		
		$columns = array( 
                            0	=> 'id', 
                            1 	=> 'partner_name',
							2	=> 'partner_link',
                            3	=> 'logo',
							4	=> 'status',
                        );
		 
		$limit = $this->security->sanitize_filename($this->input->post('length'));
		$start = $this->security->sanitize_filename($this->input->post('start'));
		
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->security->sanitize_filename($this->input->post('order')[0]['dir']);
		$totalData = $this->partner_model->allpartner_count();
		
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->partner_model->allpartners($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($order),$this->security->xss_clean($dir));
        }
        else 
		{
			$search = $this->security->sanitize_filename($this->input->post('search')['value']); 
			$posts =  $this->partner_model->posts_search($this->security->xss_clean($limit),$this->security->xss_clean($start),$this->security->xss_clean($search),$this->security->xss_clean($order),$this->security->xss_clean($dir));
			$totalFiltered = $this->partner_model->posts_search_count($this->security->xss_clean($search));
		}

        $data = array();
		
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['partnername'] = $post->partner_name;
				$nestedData['partnerlink'] = $post->partner_link;
                $nestedData['logo'] = $post->logo;
				
				if($post->status==1){
					$nestedData['status'] = '<span class="lbl-green">Active</span>';
				}
				else if($post->status==0){
					$nestedData['status'] = '<span class="lbl-red">Inactive</span>';
				}
				$nestedData['delete'] = '<a href="'.base_url().'partnerdetail/'.$post->id.'" target="_blank"><i class="fa fa-edit fa-fw action_but" aria-hidden="true" title="Edit" ></i></a><i class="fa fa-trash fa-fw action_but" aria-hidden="true" title="Delete" onclick="confirmfullDeletion('.$post->id.')"></i>';
               
                
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
	Function for add new partner view page 
	************************************************************/
	function add_partner(){
		
		$this->load->template('add_partner');
	}
	/***********************************************************
	Function for add new partner into database
	************************************************************/
	function save_partner() {
		$this->form_validation->set_rules('partnername', 'partner name', 'required');
		$this->form_validation->set_rules('partnerlink', 'link', 'required');
		if (empty($_FILES['logo']['name']))
		{
			$this->form_validation->set_rules('logo', 'logo', 'required');
		}
		if($this->form_validation->run() == FALSE){ 
			$this->load->template('add_partner');
		}
		else{
		
		
			$partner_name = $this->security->sanitize_filename($this->input->post('partnername'));
			$partner_link =$this->input->post('partnerlink');		
			$logoname= $this->security->sanitize_filename($_FILES['logo']['name']);	       
			//Get the content of the image and then add slashes to it 
				$updatedatalogo  = $_FILES['logo']['tmp_name'];
				    $target_path = S_PA.$logoname;
					move_uploaded_file($updatedatalogo, $target_path);	
		  
			//Insert the partnername and path and partner's link in ico_partners table
			$insert_id = $this->partner_model->get_data($this->security->xss_clean($partner_name), $this->security->xss_clean($partner_link), $this->security->xss_clean($logoname));
			if($insert_id >= 1){
				$data['partner_list'] = $this->partner_model->get_partners();
				$this->session->set_flashdata('success_msg',success_message('Partner Added successfully.'));
				redirect('partner');
			}else{
				$this->session->set_flashdata('error_msg',Error_message('Something went wrong.'));
				redirect('partner');
			}
		}
	}
	
	/***********************************************************
	   function to delete partner parmanently from the database
	 ***********************************************************/
	function fulldelete_partner($id){
		$this->partner_model->delete_partner_complete($this->security->xss_clean($id));
		redirect('partner');
	}
	
	/***********************************************************
			function used to fetch single partner detail
	***********************************************************/
	public function partner_detail($id)
	{
	
		$data['user'] = $this->partner_model->get_detail($id);
		$this->load->template('partner_detail',$data);
	} 
	
	
	/***********************************************************
			function used to update partner detail
	***********************************************************/
	public function update_partner()
	{ 
		
		$id = $this->security->sanitize_filename($this->input->post('id'));
		$data['user'] = $this->partner_model->get_detail($this->security->xss_clean($id));
		$this->form_validation->set_rules('partnername', 'partner name', 'required');
		$this->form_validation->set_rules('partnerlink', 'link', 'required');
		if($this->form_validation->run() == FALSE){	
			$this->load->template('partner_detail', $data);
		
		}else{
					 	
				if(!empty($_FILES['logochange']['name'])) {
					$updatedata['logo']  = $this->security->sanitize_filename($_FILES['logochange']['name']);	
					$updatedatalogo  = $_FILES['logochange']['tmp_name'];
				    $target_path = S_PA.$updatedata['logo'];
					move_uploaded_file($updatedatalogo, $target_path);					
				}								
				$updatedata['partner_name'] = $this->security->sanitize_filename($this->input->post('partnername'));
				$updatedata['partner_link'] = $this->input->post('partnerlink');
				$updatedata['status'] = $this->security->sanitize_filename($this->input->post('status'));
				$result  = $this->partner_model->update_user($this->security->xss_clean($id),$this->security->xss_clean($updatedata));
				if($result == true){
					$data['user'] = $this->partner_model->get_detail($this->security->xss_clean($id));
					$this->session->set_flashdata('success_msg',success_message('Partner details updated successfully.'));
				
					redirect('partner');
				}else{
					$this->session->set_flashdata('error_msg',error_message('Partner details does not updated.'));
				
					redirect('partner');
				}
			}
	}
	
	/***********************************************************
			function used to get image(logo) from database
	***********************************************************/
	public function get_image(){
			$id = $this->input->post('id');
			$data = $this->partner_model->get_logo($this->security->xss_clean($id));
			print($data); 
	}
	
}
