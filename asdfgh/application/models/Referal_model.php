 <?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Referal_model extends CI_Model{
	
	/****************************************************
			function to get referral list
   ****************************************************/
	function get_referral(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->order_by('id','desc');
		$return = $this->db->get(DB_PREFIX.'referral_management')->row_array();
		return $return;
	 }
	 
	 /****************************************************
			function to update referral list
   ****************************************************/
	 function update_referal($time_stamp,$data){
		 $this->db->where('time_stamp',$time_stamp);
		 $update = $this->db->update(DB_PREFIX.'referral_management',$data);
		 if($update){
			 return 1;
		 }
		 else{
				return 0;
		 }
	 }
	 
	 /****************************************************
			function to insert referral list
   ****************************************************/
	function insert_referal($data){
		 $this->db->insert(DB_PREFIX.'referral_management',$data);
		 $return = $this->db->insert_id();
		 return $return;
	 }
	 
	 /****************************************************
			function to get referral list by date
   ****************************************************/
	 function get_referral_by_date($timestamp){
		 $this->db->select('*');
		 $this->db->where('timestamp',$timestamp);
			$return = $this->db->get(DB_PREFIX.'referral_management')->row_array();
			return $return;
	 }
}