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
	 
	/****************************************************
			FUNCTION IS USE TO GET REFERRAL USER
   ****************************************************/
	function get_contribution($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$return = $this->db->get(DB_PREFIX.'contribution')->row_array();
		return $return;
	}
	
	/****************************************************
			FUNCTION IS USE TO GET REFERRAL USER
   ****************************************************/
	function refrel_usr($percentage,$ref_id){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'user_config');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();
		echo'<pre>';print_r($return);exit;
		if(!empty($return)){
			foreach($return as $k=>$val){
				$this->db->select('*');
				$this->db->where_in('user_id',$user_ids);
				$returns = $this->db->get(DB_PREFIX.'contribution')->row_array();
				if(!empty($returns)){
					$dollar = $returns['contribution_in_dollar'];
					$dollar = str_replace("($","",$dollar);
					$dollar = str_replace(")","",$dollar);
					$dollar = str_replace(",","",$dollar);
					$sum = ($dollar*$percentage);	
					$sum = ($sum/100);
					$coin = $sum*2;
					$coins = number_format((float)$coin, 2, '.', '');
					$return[$k]['coins'] = $coins; 				
				}else{
					$return[$k]['coins'] = '';
				}
			}
		}
		return $return;
	}
	
	/****************************************************
			FUNCTION IS USE TO GET coins POINTS
   ****************************************************/
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
				$coin = $sum*2;
				$coins = number_format((float)$coin, 2, '.', '');
				$return[$k]['coins'] = $coins; 
			}
		}			
		}else{
			$return = ''; 
		}
		return $return;
	}	
}