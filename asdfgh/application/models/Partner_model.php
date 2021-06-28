<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner_model extends CI_Model{ 
    
	public function __construct() {
           parent::__construct(); 
    }
	
	/****************************************************
		function is use to list of all register users
	****************************************************/
	function get_partners(){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'partners');
		$result = $this->db->get()->result();
		return $result;
	}
	
	/*********************************************************
		function to get partner count
   ***********************************************************/
	function allpartner_count()
    {   
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'partners');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/*********************************************************
		function to get partner list
   ***********************************************************/
	function allpartners($limit,$start,$col,$dir)
    {   
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'partners');
		$this->db->limit($limit,$start);
		$this->db->order_by($col,$dir);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
        {
			$result = $query->result();
			
			foreach($result as $res){
		
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
    function to get partner search list  
   ***********************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
	{
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'partners');
		$this->db->like('ico_partners.partner_name',$search);
		$this->db->or_like('ico_partners.partner_link',$search);
		$this->db->or_like('ico_partners.logo',$search);
		$this->db->limit($limit,$start);
		$this->db->order_by($col,$dir);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$result = $query->result();
			foreach($result as $res){
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
		function to get partner search count  
	 ***********************************************************/
	function posts_search_count($search)
	{
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'partners');
		$this->db->like('ico_partners.partner_name',$search);
		$this->db->or_like('ico_partners.partner_link',$search);
		
		$query = $this->db->get();
		return $query->num_rows();
		   
	}
	
	/***********************************************************
	Function for save partner details in table
	************************************************************/
	public function get_data($partner_name, $partner_link, $logoname) 
	{
		$data = array(
				'partner_name'    =>  $partner_name,
				'partner_link'    =>  $partner_link,
				'logo'     =>  $logoname				
			 );
			$this->db->insert(DB_PREFIX.'partners',$data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		
	}
	
	/*********************************************************
	function to delete the partner parmanently from the database
	***********************************************************/
	function delete_partner_complete($id){
		$this->db->where('id',$id);
		$this->db->delete('ico_partners');
	}
	
	/*************************************************************************
		function to get the particular detail of the user for the view detail page
	***************************************************************************/
	function get_detail($id){
		
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'partners');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
        {
		
			$res = $query->row();
			
			return $res;
        }
        else
        {
			
            return null;
        }
	}
	
	
	/*************************************************************************
		function to update partner information
	***************************************************************************/
	
	function update_user($id,$data){
		
		$this->db->where('id',$id);
		$update = $this->db->update(DB_PREFIX.'partners',$data);
		return true;
	}
	
	/***********************************************************
		function used to get image from database
	***********************************************************/
	
	function get_logo($id) {
		
		$this->db->select('logo');		
		$this->db->from(DB_PREFIX.'partners');
		$this->db->where('id',$id);		
		$query = $this->db->get();		
		$result = $query->result_array(); 
		$logo_path = $result[0]['logo'];		
		return $logo_path; 
		
	}
	
	
}
	