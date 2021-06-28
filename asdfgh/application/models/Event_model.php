<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model{ 
    
	public function __construct() {
           parent::__construct(); 
    }
	
	/****************************************************
		function is use to list of all register users
	****************************************************/
	function get_events(){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'events');
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	/*********************************************************
				function to get event count
   ***********************************************************/
	function allevent_count()
    {   
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'events');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/*********************************************************
				function to get event list
   ***********************************************************/
	function allevents($limit,$start,$col,$dir)
    {   
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'events');
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
    function to get event search list  
   ***********************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
	{
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'events');
		$this->db->like('ico_events.event_name',$search);
		$this->db->or_like('ico_events.event_link',$search);
		$this->db->or_like('ico_events.logo',$search);
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
		function to get event search count  
	 ***********************************************************/
	function posts_search_count($search)
	{
		$this->db->select('*');		
		$this->db->from(DB_PREFIX.'events');
		$this->db->like('ico_events.event_name',$search);
		$this->db->or_like('ico_events.event_link',$search);
		
		$query = $this->db->get();
		return $query->num_rows();
		   
	}
	
	/***********************************************************
	Function for save event details in table
	************************************************************/
	public function get_data($event_name, $event_link, $logoname) 
	{
		
		$data = array(
				'event_name'    =>  $event_name,
				'event_link'    =>  $event_link,
				'logo'     =>  $logoname				
			 );
			$this->db->insert(DB_PREFIX.'events',$data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		
	}
	
	/*********************************************************
	function to delete the Event parmanently from the adtabase
	***********************************************************/
	function delete_event_complete($id){
		$this->db->where('id',$id);
		$this->db->delete('ico_events');
	}
	
	/*************************************************************************
		function to get the particular detail of the user for the view detail page
	***************************************************************************/
	function get_detail($id){
		
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'events');
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
		function to update Event information
	***************************************************************************/	
	function update_user($id,$data){
		
		$this->db->where('id',$id);
		$update = $this->db->update(DB_PREFIX.'events',$data);
		return true;
	}
	
	function get_logo($id) {
	
		$this->db->select('logo');		
		$this->db->from(DB_PREFIX.'events');
		$this->db->where('id',$id);
		
		$query = $this->db->get();		
		$result = $query->result_array(); 
		$logo_path = $result[0]['logo'];		
		return $logo_path; 
		
	}
	
	
}
	