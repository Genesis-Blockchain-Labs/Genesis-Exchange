<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
      }
	 
	/****************************************************
		function is use to list of all register users
   ****************************************************/
	function get_users(){
		$this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	/******************************************************
		function is use to list of all get_invest_users
   *******************************************************/
	function get_invest_users(){
		$this->db->select(DB_PREFIX.'accounts.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'accounts.status as acc_status');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'accounts',DB_PREFIX.'users.id='.DB_PREFIX.'accounts.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->where(DB_PREFIX.'user_config.sdelete','0');
		$this->db->where(DB_PREFIX.'users.id',$user_id);
		$result = $this->db->get()->result_array();
		return $result;
	}	
	
	/******************************************************
		function is use to list of all register users
   *******************************************************/
	function get_user_kyc($user_id){
		$this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.phone as ph,'.DB_PREFIX.'kyc_detail.status as kyc_status,'.DB_PREFIX.'users.phone as phn');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'kyc_detail',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');		
		$this->db->where(DB_PREFIX.'users.id',$user_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	/******************************************************
		function to unsuspend the user
   *******************************************************/	
	function unsuspend($user_id){
		$update['sdelete'] = '0';		
		$this->db->where('user_id',$user_id);
		$result = $this->db->update(DB_PREFIX.'user_config',$update);
		$update_status['status'] = '1';	
		$this->db->where('id',$user_id);
		$result = $this->db->update(DB_PREFIX.'users',$update_status);
		return $result;
	}

	/******************************************************
		function is use to delete the users
   *******************************************************/	
	function delete_user($user_id){
		$update['sdelete'] = '1';		
		$this->db->where('user_id',$user_id);
		$result = $this->db->update(DB_PREFIX.'user_config',$update);
		$update_status['status'] = '3';	
		$this->db->where('id',$user_id);
		$result = $this->db->update(DB_PREFIX.'users',$update_status);
		return $result;
	}
	
	/*********************************************************
	function to delete the user parmanently from the adtabase
   ***********************************************************/
	function delete_user_complete($user_id){
		$this->db->where('id',$user_id);
		$this->db->delete('ico_users');
		/**config**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_user_config');
		/**account**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_accounts');
		/***contribution**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_contribution');
		/***kyc_detail**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_kyc_detail');
		/**login_history**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_login_history');
		/**transaction**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_transaction');
		/***user_track**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('ico_user_track');
		/**payment**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('payments');
		/**rewards**/
		$this->db->where('user_id',$user_id);
		$this->db->delete('rewards');
	}
	
	/*********************************************************
				function to get users count
   ***********************************************************/
	function allposts_count()
    {   
		$this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.reference_id,'.DB_PREFIX.'user_config.refered_id');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/*********************************************************
				function to get users list
   ***********************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
       $this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.reference_id,'.DB_PREFIX.'user_config.refered_id,'.DB_PREFIX.'user_config.total_coins');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->limit($limit,$start);
		$this->db->order_by($col,$dir);
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
			$result = $query->result();
			foreach($result as $res){
				$refer_id = $res->reference_id;
				$user_id = $res->id;
				$reference_user = $this->refer_users($refer_id);
				$log_history = $this->log_history($user_id);
				$res->login_date = $log_history->login_date;
				$res->ip_address = $log_history->ip_address;
				foreach($reference_user as $refer){
					$res->total_refer_user = $refer['total_user'];
					$res->balance = $refer['balance'];	
				} 
				$data[] = $res;
			}
			return $data;
        }
        else
        {
            return null;
        }
    }
	
	/*********************************************************
				function to get users search list  
   ***********************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
       $this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.reference_id,'.DB_PREFIX.'user_config.refered_id,'.DB_PREFIX.'user_config.total_coins');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_users.email',$search);
		$this->db->or_like('ico_users.date',$search);
		$this->db->or_like('ico_user_config.reference_id',$search);
		$this->db->or_like('ico_user_config.refered_id',$search);
		$this->db->limit($limit,$start);
		$this->db->order_by($col,$dir);
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
		   $result = $query->result();
			foreach($result as $res){
				$refer_id = $res->reference_id;
				$user_id = $res->id;
				$reference_user = $this->refer_users($refer_id);
				$log_history = $this->log_history($user_id);
				$res->login_date = $log_history->login_date;
				$res->ip_address = $log_history->ip_address;
				foreach($reference_user as $refer){
					$res->total_refer_user = $refer['total_user'];
					$res->balance = $refer['balance'];	
				} 
				$data[] = $res;
				
			}
			return $data;
        }
        else
        {
            return null;
        }
    }
	
	/*********************************************************
				function to get users search count  
   ***********************************************************/
	function posts_search_count($search)
    {
        $this->db->select(DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.reference_id,'.DB_PREFIX.'user_config.refered_id');
		$this->db->from(DB_PREFIX.'users');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_users.email',$search);
		$this->db->or_like('ico_users.date',$search);
		$this->db->or_like('ico_user_config.reference_id',$search);
		$this->db->or_like('ico_user_config.refered_id',$search);
		
		$query = $this->db->get();
		return $query->num_rows();
       
    } 

	/**************************************************************
		function to get the refered users total and balance total  
   *****************************************************************/
	function refer_users($refer_id){
		$sum = 0;
		$this->db->select(DB_PREFIX.'user_config.user_id');
		$this->db->from(DB_PREFIX.'user_config');
		$this->db->where(DB_PREFIX.'user_config.refered_id',$refer_id);
		$query = $this->db->get();
		$result = $query->result();
		$count_user = count($result);
		if(!empty($result)){
		foreach($result as $key=>$res)
		{
			$user_id = $res->user_id;
			$totals = $this->get_balance($user_id);//get total of doolar amount from the transaction table
			 $t = $totals->total;
				$sum = $sum+$t;//get the total
				$ref_data = $this->get_bonus();// get the bonus % from the amdin section
				if($ref_data!=false)
				{
					$bonus = $ref_data->bonus;
					$div = 100;
					if($bonus==0){
						$bonus==1;
						$div = 1;
					}	
					$balance = ($sum*$bonus)/$div;
					$final_data[] = array('total_user'=>$count_user,'balance'=>$balance);
				}
		}
		return $final_data;
		}
		else{
			$final_data[] = array('total_user'=>0,'balance'=>0);
			return $final_data;
		}
	}
	
	/**************************************************************
				function to get  user balance
   *****************************************************************/
	function get_balance($user_id){
		$this->db->select('SUM(dollar_amount) as total');
		$this->db->from(DB_PREFIX.'transaction');
		$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		$this->db->where(DB_PREFIX.'transaction.status',100);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	/**************************************************************
				function to get bunus % from admin
   *****************************************************************/
	function get_bonus(){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'referral_management');
		$this->db->where(DB_PREFIX.'referral_management.system_management',1);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
		return $result;
		}
		else{
			return false;
		}
	}
	
	/**************************************************************
				function to get log history
   *****************************************************************/
	function log_history($user_id){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'login_history');
		$this->db->order_by(DB_PREFIX.'login_history.login_history_id','DESC');
		$this->db->limit(1);
		$this->db->where(DB_PREFIX.'login_history.user_id',$user_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	/*************************************************************************
	function to get the particular detail of the user for the view detail page
   ***************************************************************************/
	function get_detail($user_id){
		$this->db->select('*,'.DB_PREFIX.'users.phone as phone_number');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->from(DB_PREFIX.'users');
		$this->db->where(DB_PREFIX.'users.id',$user_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
			$res = $query->row();
				$refer_id = $res->reference_id;
				$reference_user = $this->refer_users($refer_id);
				$log_history = $this->log_history($user_id);
				$res->login_date = $log_history->login_date;
				$res->ip_address = $log_history->ip_address;
				foreach($reference_user as $refer){
					$res->total_refer_user = $refer['total_user'];
					$res->balance = $refer['balance'];	
				} 
			return $res;
        }
        else
        {
            return null;
        }
	}
	/*************************************************************************
					function to check the email exist
   ***************************************************************************/
	function check_email($email){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'users');
		$this->db->where('email',$email);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	/*************************************************************************
					function to update user information
   ***************************************************************************/	
	function update_user($user_id,$data){
		$this->db->where('id',$user_id);
		$upadte = $this->db->update(DB_PREFIX.'users',$data);
		if($data['status']==3){
			$up['sdelete']=1;
			$this->db->where('user_id',$user_id);
			$upadte = $this->db->update(DB_PREFIX.'user_config',$up);
		}
		if($data['status']==1){
			$up['sdelete']=0;
			$this->db->where('user_id',$user_id);
			$upadte = $this->db->update(DB_PREFIX.'user_config',$up);
		}
		return true;
	}
	
	/*************************************************************************
				function to update users token price from config table
   ***************************************************************************/	
	function update_token($user_id,$data){
		$this->db->where('user_id',$user_id);
		$upadte = $this->db->update(DB_PREFIX.'user_config',$data);
		return true;
	}
}

?>