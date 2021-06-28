<?php
include_once(APPPATH.'libraries/security.php');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model{
     var $gauth = '';
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		 $this->gauth = new GoogleAuthenticator();
			
     }

	/**********************************************
	   FUNTION IS USE REGISTER NEW USER   
	 *********************************************/	 
	function register_ajax($user_data,$config_data){	
		$user_data['status'] = '0';	
		$return = $this->db->insert(DB_PREFIX.'users',$user_data);
		$last_insert = $this->db->insert_id();
		if(!empty($last_insert)){ 
			$kyc_data['user_id'] 	= $last_insert;
			$config_data['user_id'] = $last_insert; 
			$this->db->insert(DB_PREFIX.'user_config',$config_data);
			$this->db->insert(DB_PREFIX.'kyc_detail',$kyc_data);
			
			$this->db->select('*');
			$this->db->where('id',$last_insert);
			$user_datas = $this->db->get(DB_PREFIX.'users')->row_array();
		}else{
			$user_datas = '';
		}
		return $user_datas;		
	}
	
	/*********************************************
	   FUNTION IS USE TO login   
	********************************************/	 
	function do_login($email){	 	
		$this->db->select('ico_users.*,ico_user_config.*,ico_user_config.user_id as id');
		$this->db->join('ico_user_config','ico_users.id=ico_user_config.user_id','inner');
		$this->db->where('ico_users.email',$email);
		$check = $this->db->get('ico_users')->row_array();	
		return $check; 
	}
	
  /***********************************************
   FUNTION IS USE GET USER DATA WITH ID  
   **********************************************/	 
	function get_user_info($user_id){	 	
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$check = $this->db->get('ico_user_config')->row_array();
		return $check; 		
	}	

	/*******************************************************
		FUNTION IS USE TO CHECK USER IS SOFT DELETED OR NOT  
	********************************************************/	 
	function soft_delete($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('sdelete','0');
		$check = $this->db->get(DB_PREFIX.'user_config')->row_array();		
		return $check; 
	}	
	 
	/************************************************
		FUNTION IS USE TO GET COUNTRY   
	************************************************/	 
	function get_country(){
		$this->db->select('*');
		$this->db->order_by('country_name','ASC');
		$country = $this->db->get(DB_PREFIX.'country')->result_array(); 
		return $country;
	}

	/*********************************************
		FUNTION IS USE TO GET KYC DATA   
	*********************************************/	 
	function get_kyc($user_id){
		$this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.*');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','inner');
		$this->db->join(DB_PREFIX.'kyc_detail',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','inner');
		$this->db->where(DB_PREFIX.'users.id',$user_id);
		$query = $this->db->get(DB_PREFIX.'users')->row_array(); 
		return $query;
	}	
	

	/************************************************
		FUNCTION IS USE TO SUBMIT KYC    
	***********************************************/	 
	function submit_kyc($user_id,$data,$refered_id){
		$this->db->where('user_id',$user_id);
		$kyc = $this->db->update(DB_PREFIX.'kyc_detail',$data);
		if($kyc){
			$update_data['refered_id'] = $refered_id;
			$this->db->where('user_id',$user_id);
			$kyc = $this->db->update(DB_PREFIX.'user_config',$update_data);
		}
		return $kyc;
	}
	
	
	/**********************************************
	Function used to save ipn transaction
	*********************************************/
	function saveIpnTransaction($data){
		$user_id = $data['user_id'];
		//$email = $data['email'];
		$txn_id = $data['txn_id'];
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		//$this->db->where('email',$email);
		$this->db->where('txn_id',$txn_id);
		$check = $this->db->get(DB_PREFIX.'transaction')->row_array();
		if(!empty($check)){
			$this->db->where('user_id',$user_id);
			//$this->db->where('email',$email);
			$this->db->where('txn_id',$txn_id);
			$return = $this->db->update(DB_PREFIX.'transaction',$data);
			return $check['id'];
		}else{				
			$return = $this->db->insert(DB_PREFIX.'transaction',$data);
			return $this->db->insert_id(); 
		}
		
	}
	


	/*********************************************
	  function used to get contribution  new flow    
	 ********************************************/
	function get_contribution_new($user_id,$refernce_id){
		$this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.*');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','inner');
		$this->db->join(DB_PREFIX.'kyc_detail',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','inner');
		$this->db->where(DB_PREFIX.'users.id',$user_id);
		
		$query = $this->db->get(DB_PREFIX.'users')->row_array(); 
		
		return $query;
		
    }
	
	/******************************************************
	 function used to get contribution  count investers  
	*****************************************************/
	function total_referral($ref_id){
		$this->db->select(DB_PREFIX.'accounts.*,'.DB_PREFIX.'user_config.*');
		$this->db->join(DB_PREFIX.'accounts',DB_PREFIX.'accounts.user_id='.DB_PREFIX.'user_config.user_id','left');

		$this->db->where(DB_PREFIX.'user_config.refered_id',$ref_id);
		$this->db->where(DB_PREFIX.'user_config.refered_id !=','');
		$query = $this->db->get(DB_PREFIX.'user_config')->result_array();
		return count($query);
		
    }
	


	/***********************************************************
		function is use to get total referral token   
	**********************************************************/
	function total_ref_coins(){
		$totalToken = '';
		$this->db->select('*');
		$user_config = $this->db->get(DB_PREFIX.'user_config')->result_array();				
		if(!empty($user_config)){
			foreach($user_config as $v){
				$totalToken = $totalToken+$v['total_coins'];
			}
		}
		return $totalToken;
    }

	/**********************************************************
		function used to get total invest   
	***********************************************************/
	function total_invest(){
		$TotalToken = '0';
		$this->db->select('*');
		$this->db->where('status','100');
		$transaction = $this->db->get(DB_PREFIX.'transaction')->result_array();				
		if(!empty($transaction)){
			foreach($transaction as $v){
				$totalamount = $totalamount+$v['dollar_amount'];	
				$TotalToken = $TotalToken+$v['token'];	
			}
		}
		$return['totaltoken'] = $TotalToken;
		$return['totalamount'] = $totalamount;
		return $return;
		
    }
	
	/*************************************************************
	function to  get total invest user  
	*************************************************************/
	function total_invested_user(){
		$this->db->distinct();
		$this->db->select('*');
		$this->db->where('status','100');
		$this->db->group_by('user_id');
		$transaction = $this->db->get(DB_PREFIX.'transaction')->result_array();
		if(!empty($transaction)){
			$return = count($transaction);
		}else{
			$return = '0';
		}
		
		return $return;
		
    }	
	
	
	/*********************************************************************    
		function is use to get bonus from ico from current date    
	*********************************************************************/
	function ico(){
		$current_date = date('Y-m-d');
		$query = $this->db->query("SELECT * FROM `ico_setup` WHERE  '$current_date' between start_date and end_date")->row_array();		
		return $query;
		
    }	

	/*******************************************************
		function to get eth and btc account detail  
	******************************************************/
	function account($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'accounts')->row_array();
		return $query;
		
    }	


	/************************************************************
		Function to get user from config table with user_id   
	************************************************************/
	function get_user_data($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $query;
		
    } 
	
	/****************************************************************
		Function to get main user from config table with referrance id   
	******************************************************************/
	function get_referral_user_data($reference_id){
		$this->db->select('*');
		$this->db->where('reference_id',$reference_id);
		$query = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $query;
		
    } 

	/*************************************************************
		Function to get bonus from referral management   
	*************************************************************/
	function get_referral_management($date){
		$timestamp = strtotime($date);
		$this->db->select('*');
		$this->db->where('system_management','1');
		$this->db->where('timestamp <=', $timestamp);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get(DB_PREFIX.'referral_management')->row_array();
		return $query;
		
    }
	/***********************************************
		function used for get register date of user
	**************************************************/	
	function get_register_date($user_id){
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$query = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $query;
		
    }
		
	/**************************************************************
		Function to data from  ico setup   
	****************************************************************/
	function get_setup(){
		$current_date = date('Y-m-d');
		$query = $this->db->query("SELECT * FROM `ico_setup` WHERE  '$current_date' between start_date and end_date")->row_array();		
		return $query;
		
    }	

	/********************************************************************
		Function to UPDATE USER TOKEN ON THE BASIS OF USER ID   
	*********************************************************************/
	function update_token($user_id,$data){
		$this->db->where('user_id',$user_id);
		$query = $this->db->update(DB_PREFIX.'user_config',$data);
		return $query;
		
    }	
	
	
	/**********************************************************
		FUNCTION IS USE TO count REFERRAL USER 
	**********************************************************/
	function count_refrel_usr($ref_id){				
		$this->db->select('*');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get(DB_PREFIX.'user_config')->result_array();	
		$transaction = array();
		if(!empty($return)){
			foreach($return as $key=>$vlaue){
				if($vlaue['refered_status']==1){
					$user_id = $vlaue['user_id'];
					$this->db->select('*');
					$this->db->where('user_id',$user_id);
					$this->db->where('status','100');
					$tc = $this->db->get(DB_PREFIX.'transaction')->row_array();
					if(!empty($tc)){
						$transaction[$key] = $tc;
					}
				}
			} 
		}
		return $transaction;
	}
	function get_website_status(){
		$this->db->select('*');
		$return = $this->db->get(DB_PREFIX.'system_settings')->row();	
		return $return;
	}
	
	/************************************************************
		Function to check refferal status on or off
	*************************************************************/
	function refferal_status()
	{
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'referral_management');
		$this->db->order_by('id','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		$result = $query->row_array();
		return $query->num_rows() > 0 ? $query->row_array() : false ;
		
	}
	/**************************************************************
				function used for support add
	***************************************************************/
		function sendSupports($data,$user_id)
		{
			$this->db->insert(DB_PREFIX.'support',$data);
			return true;
		}
	/**************************************************************
		function used for support detail to get all the tickets
	***************************************************************/
		function supportList($limit,$offset,$user_id)
		{
			$this->db->select('*');
		$this->db->limit($limit,$offset);
		$this->db->where('user_id',$user_id);
		$this->db->order_by('id','DESC');
		$result = $this->db->get(DB_PREFIX.'support')->result_array();
		return $result;
		}
		
	/*********************************************************
		Function to get the count of record
	**********************************************************/
	function get_count($user_id) {
	$this->db->select('count(*) as total');
	$this->db->where('user_id',$user_id);
	$datas = $this->db->get(DB_PREFIX.'support')->row_array();
	return $datas;
	}
	/********************************************************
	Function to get the ticket replys for support section
	********************************************************/
	function supportReply($ticket_no)
	{
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'support_reply');
		$this->db->where('ticket_no',$ticket_no);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result;
		}
		else
		{
			return false;
		}
	}
	/********************************************************************************
	Function to get the particular support query detail according to the ticket number
	**********************************************************************************/
	function supportQuestion($ticket_no)
	{
		$this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','left');
		$this->db->where(DB_PREFIX.'support.id',$ticket_no);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}
	/******************************************************
		Function to save the repplys
	******************************************************/
	function sendReply($data)
	{
		$this->db->insert(DB_PREFIX.'support_reply',$data);
		return true;
	}
	/*********************************************************
		FUNCTION IS USE TO get total sold coins
	*********************************************************/	
	function sold_coin()
	{
		$this->db->select_sum('total_coins');
		$this->db->from(DB_PREFIX.'user_config');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}
	}
	
	/*********************************************************
		FUNCTION IS USE TO get ico stage
	*********************************************************/
	function ico_date()
	{
		$query = $this->db->query("SELECT * FROM `ico_setup` WHERE CURDATE() between start_date and end_date");
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}
	/**********************************************
	Function used to get the last 3 broadcast messages from admin 
	*******************************************************/
	Function get_broadcast(){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'broadcast');
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	/**********************************************
	Function used to get the single broadcast message from admin 
	*******************************************************/
	
	function get_broad_message($id) {
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'broadcast');
		$this->db->where('id',$id);		
		$query = $this->db->get();
		$result = $query->result();		
		return $result;
	}
	
	/**********************************************
	Function used to get the broadcast messages list from admin 
	*******************************************************/
	Function get_broadcast_list($limit,$offset,$user_id){
		
		$this->db->select('*');
		$this->db->limit($limit,$offset);
		$this->db->order_by('id','DESC');
		$result = $this->db->get(DB_PREFIX.'broadcast')->result_array();
	
		foreach($result as $record){
			$data[] = $record;
		}
			return $data;
	}
	
	/**************************************************
		 Function to get the count of  message
	***************************************************/
	function get_count_list() { 
	
		$this->db->select('count(*) as total');
		$this->db->from(DB_PREFIX.'broadcast');	
		$query = $this->db->get();
	
		$result = $query->result();
		
		return $result;
	} 
	
	/*******************************************************
		FUNTION IS USE TO get bedge  
	********************************************************/	 
	function bedge($user_id){
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$check = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $check; 
	}
	
	/*******************************************************
		FUNTION IS USE TO hide bedge  
	********************************************************/
	function hide_bedge($user_id)
	{
		$data = array('notification'=>0);
		$this->db->where('id',$user_id);
		$query = $this->db->update(DB_PREFIX.'users',$data);
		return 1;
	}
	

	 
}