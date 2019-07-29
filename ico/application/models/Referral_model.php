<?php
include_once(APPPATH.'libraries/security.php');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Referral_model extends CI_Model{
     var $gauth = '';
     public function __construct(){
         parent::__construct(); 
		 $this->load->library('googlelib/GoogleAuthenticator');
         $this->key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
		 $this->gauth = new GoogleAuthenticator();
			
     }
	 	
	/*********************************************
	FUNCTION IS USE TO GET REFERRAL USER
	**********************************************/
	function refrel_usr($ref_id){	
		$this->db->select('ico_users.*,ico_user_config.*');
		$this->db->join('ico_user_config','ico_users.id=ico_user_config.user_id','inner');
		$this->db->where('ico_user_config.refered_id',$ref_id);
		$this->db->where('ico_user_config.refered_id !=','');
		//$this->db->limit($limit,$offset);
		$return = $this->db->get(DB_PREFIX.'users')->result_array();
		if(!empty($return)){
			foreach($return as $k=>$val){
				$user_id = $val['user_id'];
				$refered_status = $this->get_user_data($user_id );
				 if($refered_status['refered_status'] == 1){
						$this->db->select('*,'.DB_PREFIX.'transaction.dollar_amount as dollar');
						$this->db->where('status','100');
						$this->db->where('user_id',$user_id);
						$transactions = $this->db->get(DB_PREFIX.'transaction')->result_array();
						if(!empty($transactions)){
							foreach($transactions as $transaction)
							{
								
									$t_date_arr = explode(" ",$transaction['ipn_date']);
									$t_date = $t_date_arr[0];
								
									$get_register_date = $this->get_register_date($user_id);
									$dollarAmount = $transaction['dollar'];					
									
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
									 $val['coins'] = $tokens;
									 $ret[] =$val;
							}
							
						}
				}
			}
		}
		return $ret;
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
	/***********************************************
		function used for get register date of user
	**************************************************/	
	function get_register_date($user_id){
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$query = $this->db->get(DB_PREFIX.'users')->row_array();		
		return $query;
		
    }
	/**********************************************
	FUNCTION IS USE TO count REFERRAL USER
	*************************************************/
	function count_refrel_usr($ref_id){				
		$this->db->select('ico_users.*,ico_user_config.*');
		$this->db->join('ico_user_config','ico_users.id=ico_user_config.user_id','inner');
		$this->db->where('ico_user_config.refered_id',$ref_id);
		$this->db->where('ico_user_config.refered_id !=','');
		$return = $this->db->get(DB_PREFIX.'users')->result_array();		
		return $return;
	}	
	/***************************************************************
	Function used to get current bonus from the referral mangement
	*****************************************************************/	
	function getCurrentBonus($date){
		$timestamp = strtotime($date);
		$this->db->select('*');
		$this->db->where('system_management','1');
		$this->db->where('timestamp >=', $timestamp);
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

	/******************************************************************
	FUNCTION IS USE TO GET coins POINTS
	****************************************************************/
	function reward_points($percentage,$data){
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['user_id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get(DB_PREFIX.'contribution')->result_array();
				
			if(!empty($return)){
				foreach($return as $k=>$value){
					$dollar = $value['contribution_in_dollar'];
					$dollar = str_replace("($","",$dollar);
					$dollar = str_replace(")","",$dollar);
					$dollar = str_replace(",","",$dollar);
					$sum = ($dollar*$percentage);	
					$sum = ($sum/100);
					$coin = $sum*DOMAIN_CUURENCY;
					$coins = number_format((float)$coin, 2, '.', '');
					$return[$k]['coins'] = $coins; 
				}
			}			
		}else{
			$return = ''; 
		}
		return $return;
	}	


	
	/******************************************************************
	FUNCTION IS USE TO GET total refereell investment
	******************************************************************/
	function referel_total_invst($refernce_id){		
		$referralTotalToken = '0';
		$this->db->select('*');
		$this->db->where('refered_id',$refernce_id);
		$this->db->where('refered_id !=','');
		$query = $this->db->get(DB_PREFIX.'user_config')->result_array();
		
		if(!empty($query)){
			$user_ids = '';
			foreach($query as $val){
				if($val['refered_status']==1){
				$user_ids.=$val['user_id'].',';
				}
			}
			
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(",", $user_ids);
			$this->db->select('*');
			$this->db->where('status','100');
			$this->db->where_in('user_id',$user_ids);
			$transaction = $this->db->get(DB_PREFIX.'transaction')->result_array();				
			if(!empty($transaction)){
				foreach($transaction as $v){
					$referralTotalToken = $referralTotalToken+$v['dollar_amount'];					
				}
			}
						
		}
		return round($referralTotalToken,2);
	}	
}