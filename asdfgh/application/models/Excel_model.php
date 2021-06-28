<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Excel_model extends CI_Model{
 
     public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }
	 /****************************************************
			function to get contributed users
	****************************************************/
	 function contributed_users(){
		 $this->db->select("proof.user_id,dev_user.name,dev_user.email,proof.eth_address,proof.update_eth,contribution.boon_coins,contribution.bonus,contribution.contribution_in_dollar,contribution.referral_coins");
		 $this->db->from('proof');
		 $this->db->where('proof.update_eth',1);
		 $this->db->join('dev_user','dev_user.id=proof.user_id','left');
		 $this->db->join('contribution','contribution.user_id=proof.user_id','left');
		 $query = $this->db->get();
		 $result = $query->result();
		if(!empty($result)){
			return $result;
		}
		else{
			return false;
		}
	 }
	 
	 /****************************************************
			function to update contribute status
	****************************************************/
	 function update_status($id){
		 		$status['update_eth'] = 2;
				$this->db->where('update_eth',1);
				$this->db->where('user_id',$id);
				$this->db->update('proof',$status);
	 }
 }

?>