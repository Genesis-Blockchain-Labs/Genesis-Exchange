<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ico_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
           
     }
	 
	 /*********************************************************
	        function used to get ico or pre ico data
	 **********************************************************/
	 public function check_ico($type){
		 $this->db->select('*');
		 $this->db->from(DB_PREFIX.'setup');
		 $this->db->where('ico_type',$type);
		 $data = $this->db->get()->row_array();
		 return $data;
	 }
	 
	 /*********************************************************
	        function used to get ico list
	 **********************************************************/
	  public function check_ico_list($type){
		 
		 $this->db->select('*');
		 $this->db->from(DB_PREFIX.'setup');
		 $this->db->where('ico_type',$type);
		 $data = $this->db->get()->result_array();
		 return $data;
	 }
	 
	 /*********************************************************
	        function used for insert ico
	 **********************************************************/
	 public function insert_ico($data){
		 $this->db->insert(DB_PREFIX.'setup',$data);
		 $insert_id = $this->db->insert_id();
		 return $insert_id;
	 }
	 
	 /*********************************************************
	        function used for update ico
	 **********************************************************/
	  public function update_ico($id,$data){
		  $this->db->where('id',$id);
		  $update = $this->db->update(DB_PREFIX.'setup',$data);
		if($update)
      {
        return true;
      }
      else
      {
        return false;
      }
	 }
	 
	/*********************************************************
	        function used to get ico stage last entry
	 **********************************************************/
	 function last_stage($type)
	 {
		 $this->db->select('*');
		 $this->db->from(DB_PREFIX.'setup');
		 $this->db->where('ico_type',$type);
		 $this->db->order_by('id','desc');
		 $data = $this->db->get()->row_array();
		return $data;
	 }
	 
	 /*********************************************************
	        function used to get admin settings
	 **********************************************************/
	 function admin_setup()
	 {
		 $this->db->select('*');
		 $this->db->from(DB_PREFIX.'system_settings');
		 $data = $this->db->get()->row_array();
		 return $data;
	 }
	 
	 /*********************************************************
	        function used to update admin website status
	 **********************************************************/
	 function website_status($data)
	 {
		$update = $this->db->update(DB_PREFIX.'system_settings',$data);
		return true;
	 }
	
}