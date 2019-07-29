<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaction_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 
     }
	/**********************************************************
		 function to get the transaction history of the user
	************************************************************/
		 function transaction_detail($limit,$offset,$user_id){	 
			$this->db->select('*');
			$this->db->limit($limit,$offset);
			$this->db->where('user_id',$user_id);
			$this->db->order_by('id','DESC');
			$result = $this->db->get(DB_PREFIX.'transaction')->result_array();
			foreach($result as $record){
			$date = $record['ipn_date'];
			$date_array = explode(" ",$date);
			$record['date'] = $date_array[0];
				$data[] = $record;
			}
			return $data;
			 
		 }
	/**************************************************
		 Function to get the count of record
	***************************************************/
		function get_count($user_id) {
		$this->db->select('count(*) as total');
		$this->db->where('user_id',$user_id);
		$datas = $this->db->get(DB_PREFIX.'transaction')->row_array();
		return $datas;
	}
 
}