<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Broadcast_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
     }
	 /************************************
	 Function to save the message
	 ***************************************/
	function savemessage($data){
		$data['date'] = date('Y-m-d h:i:s');
		$this->db->insert(DB_PREFIX.'broadcast',$data);
		$insert_id = $this->db->insert_id();
		
	
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'users');
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$notification = $row->notification; 
			
			$bedge['notification'] = $notification+1;
			$this->db->where('id',$row->id);
			$this->db->update(DB_PREFIX.'users',$bedge);
			
		}
		
		return $insert_id;
	}
	 /******************************************
	 Function to update the message
	 ******************************************/
	function updatemessage($data,$id){
		$data['date'] = date('Y-m-d h:i:s');
		$this->db->where('id',$id);
		$this->db->update(DB_PREFIX.'broadcast',$data);
			return true;
	}
	 /****************************************************
			function used to message  count 
	****************************************************/
	function allmessage_count()
    {   
		$this->db->select(DB_PREFIX.'broadcast.*');
		$this->db->from(DB_PREFIX.'broadcast');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function used to get message list
	****************************************************/
	function allmessage($limit,$start,$col,$dir)
    {   
		$this->db->select(DB_PREFIX.'broadcast.*');
		$this->db->from(DB_PREFIX.'broadcast');
		$this->db->limit($limit,$start);
		//$this->db->order_by($col,$dir);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
    }
	
	/****************************************************
			function used to search broadcast messages
	****************************************************/
	function message_search($limit,$start,$search,$col,$dir)
    {
       $this->db->select(DB_PREFIX.'broadcast.*');
		$this->db->from(DB_PREFIX.'broadcast');
		$this->db->like('ico_broadcast.message',$search);
		$this->db->or_like('ico_broadcast.date',$search);
		$this->db->limit($limit,$start);
		$this->db->order_by($col,$dir);
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
            return $query->result(); 
		}
        else
        {
            return null;
        }
    }
	
	/****************************************************
			function used to search messages count 
	****************************************************/
	function message_search_count($search)
    {
        $this->db->select(DB_PREFIX.'broadcast.*');
		$this->db->from(DB_PREFIX.'broadcast');
		$this->db->like('ico_broadcast.message',$search);
		$this->db->or_like('ico_broadcast.date',$search);
		$query = $this->db->get();
		return $query->num_rows();
       
    }
	/*****************************************************
	Function to delete the message
	*****************************************************/
	function delete_msg($id){
		$this->db->where(DB_PREFIX.'broadcast.id',$id);
		$this->db->delete(DB_PREFIX.'broadcast');
	}
}