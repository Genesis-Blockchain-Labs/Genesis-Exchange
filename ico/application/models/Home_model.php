<?php
include_once(APPPATH.'libraries/security.php');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model{
     var $gauth = '';
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		 $this->gauth = new GoogleAuthenticator();
			
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
	/*********************************************
	FUNCTION IS USE TO GET REFERRAL USER
	**********************************************/
	function refrel_usr(){	
		$this->db->select(DB_PREFIX.'transaction.*,'.DB_PREFIX.'transaction.dollar_amount as dollar,'.DB_PREFIX.'user_config.*');
		$this->db->join('ico_user_config','ico_transaction.user_id=ico_user_config.user_id','left');
		$this->db->where(DB_PREFIX.'user_config.refered_status','1');
		$this->db->where(DB_PREFIX.'user_config.refered_id !=','');
		$this->db->where(DB_PREFIX.'transaction.status','100');
		$this->db->order_by(DB_PREFIX.'transaction.id','desc');
		$this->db->limit(3);
		$transactions = $this->db->get(DB_PREFIX.'transaction')->result_array();
		if(!empty($transactions)){
							foreach($transactions as $transaction)
							{
								
									$t_date_arr = explode(" ",$transaction['ipn_date']);
									$t_date = $t_date_arr[0];
								
									$get_reffred_user = $this->getRefferedUser($transaction['refered_id']);
									$transaction['reffred_username'] = $get_reffred_user['firstname'].' '.$get_reffred_user['lastname'];
									$get_register_date = $this->get_register_date($transaction['user_id']);
									$transaction['username'] = $get_register_date['firstname'].' '.$get_register_date['lastname'];
									$dollarAmount = $transaction['dollar_amount'];					
									$bonusData = $this->getCurrentBonus($get_register_date['date']);
									if(!empty($bonusData)){						
										$bonus = $bonusData['bonus'];
										$refereldollr=(($dollarAmount*$bonus)/100);
									}else{
										$refereldollr='';
									}
									
									$setUpData = $this->setupico($t_date);									
									if(!empty($setUpData)){						
										$price = $setUpData['token_price'];
										$tokens= round(($refereldollr/$price),2);
									}
									 $transaction['coins'] = $tokens;
									 $ret[] =$transaction;
							}
							return $ret;
						}
	}
	/***********************************************
		function used for get register date of user
	**************************************************/	
	function get_register_date($user_id)
	{
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$query = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $query;
		
    }
	/********************************************************************
		Function used to get current bonus from the referral mangement
	*********************************************************************/	
	function getCurrentBonus($date){
		$timestamp = strtotime($date);
		$this->db->select('*');
		$this->db->where('system_management','1');
		$this->db->where('timestamp <=', $timestamp);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get(DB_PREFIX.'referral_management')->row_array();
		return $query;
	}
	
	/***************************************************************
			function is use to get ico setup detail   
	***************************************************************/
	function setupico($date){
		$select=$this->db->query("SELECT * FROM `ico_setup` WHERE  '$date' between start_date and end_date");
		$result = $select->row_array();
		return $result;
		
    }
	
	/***************************************************************
			function is use to get reffral user list   
	***************************************************************/
	function getRefferedUser($refered_id)
	{
		$this->db->select('ico_user_config.*,ico_users.firstname,ico_users.lastname');
		$this->db->join('ico_users','ico_user_config.user_id=ico_users.id','left');
		$this->db->where('ico_user_config.reference_id',$refered_id);
		$query = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $query;
	}
	
	/***************************************************************
			function is use to get website status   
	***************************************************************/
	function get_website_status()
	{
		$this->db->select('*');
		$return = $this->db->get(DB_PREFIX.'system_settings')->row(); 
		return $return;
	}
	
	/*********************************************************
		FUNCTION IS USE TO get events list
	*********************************************************/
	function events()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$return = $this->db->get(DB_PREFIX.'events')->result_array(); 
		return $return;
	}
	 
	/*********************************************************
		FUNCTION IS USE TO get partners list
	*********************************************************/
	function partners()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$return = $this->db->get(DB_PREFIX.'partners')->result_array(); 
		return $return;
	}
	
	/***************************************************************
			function is use to get ip bloack  
	***************************************************************/
	function get_ipbloack($ip)
	{
		$this->db->select('*');
		$this->db->where('ip',$ip);
		$return = $this->db->get(DB_PREFIX.'user_ip')->row(); 
		return $return;
	}

	/***************************************************************
			function is use to SAVE THE NEWSLETTERS OF USERS
	***************************************************************/
	function saveNewsLetter($data)
	{
		 $this->db->insert(DB_PREFIX.'newsletter_users',$data);
		 $insertid = $this->db->insert_id();
  		 return  $insertid;
	}
    
    /***************************************************************
			function is use to SAVE THE NEWSLETTERS OF USERS
	***************************************************************/
	function checkifemailalreadythere($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$user_data = $this->db->get(DB_PREFIX.'newsletter_users')->row_array();
		if ($user_data) {
			return 0;
		} else {
			return 1;
		}		
	}
}