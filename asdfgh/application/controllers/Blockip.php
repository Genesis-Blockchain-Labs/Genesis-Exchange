<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Blockip extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('blockip_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	/************************************
			block ip page view
	*************************************/
	public function index(){
		$session = $this->security->xss_clean($this->session->userdata('user_data'));
		if(!empty($session)){
			$this->load->template('block_ip_user');				
		}else{
			redirect('/');
		}
	}
	/***************************************
	Function to save the blocked ips
	****************************************/
	public function block_ip(){
		if(isset($_SESSION['ip_error_msg'])) {
			unset($_SESSION['ip_error_msg']);
		}
		$session = $this->security->xss_clean($this->session->userdata('user_data'));		
		if(!empty($session)){
			
			$this->form_validation->set_rules('ip', 'ip', 'required|valid_ip');
			$this->form_validation->set_message('required', 'This field is required');
			if ($this->form_validation->run() == FALSE){
				$this->load->template('block_ip_user');
			}else{
				$data['ip'] = $this->security->sanitize_filename($this->input->post('ip'));
				$saveip = $this->blockip_model->saveip($data);
				
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
				redirect('block_ip');				
			}			
		}else{
			redirect('/');
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
		$totalData = $this->blockip_model->allposts_count();
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->blockip_model->allposts($limit,$start,$order,$dir);
        }
        else 
		{
			$search = $this->input->post('search')['value']; 
			$posts =  $this->blockip_model->posts_search($limit,$start,$search,$order,$dir);
			$totalFiltered = $this->blockip_model->posts_search_count($search);
			
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
		$this->blockip_model->unblock($id);
		redirect('block_ip');
	}
}