<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Transaction extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('transaction_model');
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		$this->load->helper('security');
	}
	
	/***********************************************************
			function used to show transaction view
	***********************************************************/
	public function transaction_detail(){
		$data['user_detail'] = $this->transaction_model->get_users();
		$this->load->template('transaction_detail', $this->security->xss_clean($data));
	}
	
	/***********************************************************
			function used for get single user transaction
	***********************************************************/
	public function transaction_details($user_id){
		$data['user_id'] = $user_id;
		$this->load->template('transaction_detail', $this->security->xss_clean($data));
	}
	
	/***********************************************************
			function used for delete transaction
	***********************************************************/
	function delete_transaction($id){
		$data['user'] = $this->transaction_model->delete_transaction($this->security->xss_clean($id));
		redirect('transaction');
	}

	/***********************************************************
			function used for get transactions list
	***********************************************************/	
	public function posts(){
		$user_id = $this->input->post('user_id');
		$columns = array( 
                            0 =>'id', 
                            1 =>'email',
							2=>'amount',
							3=>'dollar_amount',
                            4=> 'currency',
							5=>'ipn_date',
							6=>'status',
							7 =>'id',
						);
			$limit = $this->input->post('length');
		
        $start = $this->input->post('start');
		
        $order = $columns[$this->input->post('order')[0]['column']];
		
		
        $dir = $this->input->post('order')[0]['dir'];
		if($user_id!=""){
			 $totalData = $this->transaction_model->allposts_count($user_id);
		}
		else{
        $totalData = $this->transaction_model->allposts_count();
		}
            
        $totalFiltered = $totalData; 
        if(empty($this->input->post('search')['value']))
        {            
            if($user_id!=""){
				$posts = $this->transaction_model->allposts($limit,$start,$order,$dir,$user_id);
			}
			else{
			$posts = $this->transaction_model->allposts($limit,$start,$order,$dir);
			}
        }
        else {
			
            $search = $this->input->post('search')['value']; 
			if($user_id!=""){
				$posts =  $this->transaction_model->posts_search($limit,$start,$search,$order,$dir,$user_id);
				$totalFiltered = $this->transaction_model->posts_search_count($search,$user_id);
			}
			else{
            $posts =  $this->transaction_model->posts_search($limit,$start,$search,$order,$dir);
			
            $totalFiltered = $this->transaction_model->posts_search_count($search);
			}
        }

        $data = array();
        if(!empty($posts))
        {
			foreach ($posts as $post)
            {
                $nestedData['id'] = $start + 1;
                $nestedData['email'] = $post->useremail;
				$nestedData['amount'] = $post->amount;
				$nestedData['dollar_amount'] = $post->dollar_amount;
                $nestedData['currency'] = $post->currency;
				$date  = str_replace(" "," / ",$post->ipn_date);
				
				$nestedData['date'] = $date;
				 if($post->status==-1){
					 $nestedData['status'] = "<span class='lbl-red'>Cancelled</span>";
				 }
				 else if($post->status==0){
					 $nestedData['status'] = "<span class='lbl-orange'>Pending</span>";
				 }
				 else if($post->status==1){
					 $nestedData['status'] = "<span class='lbl-orange'>Confirmed</span>";
				 }
				 else if($post->status==2){
					 $nestedData['status'] = "<span class='lbl-orange'>Queued</span>";
				 }
				 else if($post->status==100){
					 $nestedData['status'] = "<span class='lbl-green'>Completed</span>";
				 }
				 
                $nestedData['delete'] = '<i class="fa fa-trash" aria-hidden="true" title="Delete" onclick="confirmDeletion('.$post->id.')"></i>';
                
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