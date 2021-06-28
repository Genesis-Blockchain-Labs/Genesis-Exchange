<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_log extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('adminlog_model');
		$this->load->model('kyc_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	
	/***********************************************************
				function used to show admin logs
	***********************************************************/
	public function adminlog(){
		$this->load->template('admin_log');
	}
	
	/***********************************************************
				function used to fetch admin logs
	***********************************************************/
	function posts()
	{
		$columns = array( 
                            0 =>'id', 
                            1 =>'username',
							2=>'login_date',
                            3=> 'ip_address',
							4=>'country',
							5=>'country_code',
							6=>'status',
                        );

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$totalData = $this->adminlog_model->allposts_count(); 
		$totalFiltered = $totalData; 

        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->adminlog_model->allposts($limit,$start,$order,$dir);
        }
        else 
		{
			$search = $this->input->post('search')['value']; 
			$posts =  $this->adminlog_model->posts_search($limit,$start,$search,$order,$dir);
			$totalFiltered = $this->adminlog_model->posts_search_count($search);
		}

        $data = array();
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['username'] = $post->username;
				$date  = str_replace(" "," / ",$post->login_date);
				$nestedData['login_date'] = $date;
                $nestedData['ip_address'] = $post->ip_address;
				$nestedData['country'] = $post->country;
				$nestedData['country_code'] = $post->country_code;
				if($post->status=="success"){
				$nestedData['status'] = '<span class="lbl-green">'.ucfirst($post->status).'</span>';  
				}
				else if($post->status=="failed"){
					$nestedData['status'] = '<span class="lbl-red">'.ucfirst($post->status).'</span>'; 
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
}