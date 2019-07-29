<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contribution_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
     }

	/****************************************************
		function to get  users detail  by reference_id 
	****************************************************/	
	public function refrence_id($id){
		$this->db->select('*');
		$this->db->where('reference_id',$id);
		$return = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $return;
	}
	 
	/****************************************************
		Function is use to save and update contribution 
	****************************************************/
	function update_contribution($user_id,$data,$refered_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'contribution')->row_array(); 
		
		if(!empty($query)){
			$this->db->where('user_id',$user_id);
			$return = $this->db->update(DB_PREFIX.'contribution',$data);	
			$return = $this->update_referel_amount($user_id,$data,$refered_id);
		}else{
			$data['user_id'] = $user_id;
			$return = $this->db->insert(DB_PREFIX.'contribution',$data);
			$return = $this->update_referel_amount($user_id,$data,$refered_id);
		}
		return $return;
    }
	
	/********************************************************
		function to use update investment status or verified  
	*********************************************************/
	public function update_investmnt_staus($user_id,$status){
		$data['status'] = $status;		
		$this->db->where('user_id',$user_id);
		$return = $this->db->update(DB_PREFIX.'accounts',$data);
		return $return;
	}	
	
	/************************************************************
	Function is use to update referel contribution for main user  
	************************************************************/
	function update_referel_amount($user_id,$data,$refered_id){
		$main_user = $this->refrence_id($refered_id);
		$main_user_id = $main_user['user_id'];
		$main_usr_refid = $main_user['reference_id'];
		$this->db->select('ico_users.*,ico_contribution.*');
		$this->db->join('ico_contribution','ico_users.id=ico_contribution.user_id','inner');
		$this->db->where('ico_contribution.contribution_in_dollar !=','');
		$this->db->where('ico_contribution.contribution_in_dollar !=','0');
		$this->db->where('ico_contribution.contribution_in_dollar !=','0.00');
		$this->db->where('ico_users.id=',$main_user_id);
		$query = $this->db->get(DB_PREFIX.'users')->row_array();
		if(!empty($query)){
			$percent = $query['referral_bonus_percentage'];			
			if(!empty($query['contribution_in_dollar'])){
				$dollar = $query['contribution_in_dollar'];
				$dollar = str_replace("($","",$dollar);
				$dollar = str_replace(")","",$dollar);
				$dollar = str_replace(",","",$dollar);
				$own_boon  = (($dollar)*2);
			}else{
				$own_boon = 0;
			}
			if(!empty($query['bonus'])){
				$own_bonus = (($own_boon*$query['bonus'])/100);
			}else{
				$own_bonus = 0;
			}
			$own_coin = ($own_boon+$own_bonus);
			$own_coin = number_format((float)$own_coin, 2, '.', '');
			
			$referel_user = $this->list_refrel_usr($main_usr_refid);
			
			$user_ids = '';
			foreach($referel_user as $val){
				$user_ids.=$val['id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get(DB_PREFIX.'contribution')->result_array();
			
			$final_dollar = 0;
			if(!empty($return)){
				foreach($return as $k=>$value){
					$dollar = $value['contribution_in_dollar'];
					$dollar = str_replace("($","",$dollar);
					$dollar = str_replace(")","",$dollar);
					$dollar = str_replace(",","",$dollar);
					$final_dollar = $final_dollar+$dollar;
					
				}
			}
			$sum = ($final_dollar*$percent);
			$sum = ($sum/100);	
			$retrn = $sum*2;		
			$referel_point = number_format((float)$retrn, 2, '.', '');
			$total_boon = ($own_coin+$referel_point);
			
			$main_data['referral_coins'] = $referel_point;
			$main_data['total_coins']     = $total_boon;
			$this->db->where('user_id',$main_user_id);
			$return = $this->db->update(DB_PREFIX.'contribution',$main_data);
			return true;		
		}else{
			return true;
		}
	}	

	/************************************************************
		Function is use get list of refered user 
	************************************************************/
	function list_refrel_usr($ref_id){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'user_config');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();
		return $return;
		
	}
	
	/************************************************************
		function is use to list of all register users
	************************************************************/
	function change_status($id,$status){		
		$data = array('status'=>$status);
		$this->db->where('user_id',$id);
		$this->db->update(DB_PREFIX.'accounts',$data);
		return true;
	}	
	
}