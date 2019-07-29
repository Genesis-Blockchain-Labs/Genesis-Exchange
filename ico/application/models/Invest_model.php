<?php
include_once(APPPATH.'libraries/security.php');
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invest_model extends CI_Model{ 
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
     }
	 
	/****************************************************************
	FUNCTION IS USE FOR GET THE ACCOUNT
	*************************************************************/
	public function get_account($user_id,$coin_type){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$this->db->where('coin_type',$coin_type);
		$check = $this->db->get(DB_PREFIX.'accounts')->row_array();
		return $check;
	}
	
	/*******************************************************
	FUNCTION IS USE FOR SAVE THE investment ADDRESS WITH AMOUNT
	**************************************************************/
	public function save_investment($user_id,$data){
			$data['user_id'] = $user_id;			
			$data['status'] = 0;			
			$return = $this->db->insert(DB_PREFIX.'accounts',$data);
			return $return;	
		
	}	
	/*****************************************************************
		FUNCTION IS USE FOR SAVE THE DASH investment AMOUNT
	**************************************************************/
	public function save_dash($user_id,$data){
			$data['user_id'] = $user_id;			
			$data['status'] = 0;			
			$return = $this->db->insert(DB_PREFIX.'accounts',$data);
			return $return;	
		
	}	
	

	/******************************************************************************
	FUNCTION IS USE FOR SAVE THE BTC ADDRESS WITH AMOUNT
	**********************************************************************/
	public function save_btc($user_id,$data){
	
			$data['user_id'] = $user_id;			
			$data['status'] = 0;			
			$return = $this->db->insert(DB_PREFIX.'accounts',$data);
			return $return;		
	}
	
	/********************************************************
	FUNCTION IS USE FOR SAVE THE ETH  AMOUNT
	*******************************************************/
	public function save_eth($user_id,$data){
		$check = $this->get_account($user_id,2);
			
			$data['user_id'] = $user_id;	
			$data['status'] = 0;				  
			$return = $this->db->insert(DB_PREFIX.'accounts',$data);  
			return $return;			  
	}

	/****************************************************************
	FUNCTION IS USE FOR SAVE THE RIPPLE ADDRESS WITH AMOUNT
	****************************************************************/
	public function save_ripple($user_id,$data){
		$check = $this->get_account($user_id);
		if(!empty($check)){
			$this->db->where('user_id',$user_id);
			$return = $this->db->update(DB_PREFIX.'accounts',$data);
			return $return;
		}else{
			$data['user_id'] = $user_id;	
			$data['status'] = 'under';				
			$return = $this->db->insert(DB_PREFIX.'accounts',$data);
			return $return;	
		}			
	}	
	/**********************************************************
	Function to get the price and bonus from admn
	*********************************************************/
	public function get_price_bonus($current_date){
	$select=$this->db->query("SELECT * FROM `ico_setup` WHERE  '$current_date' between start_date and end_date");
		$result = $select->row_array();
		return $result;
	
	}
}