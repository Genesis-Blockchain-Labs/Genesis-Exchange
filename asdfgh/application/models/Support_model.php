<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
      }
	
	/****************************************************
			function to get support count
   ****************************************************/
	function allposts_count()
    {   
		$this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
		functionto get the recorde of the support users
   ****************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
       $this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->limit($limit,$start);
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
	function to get the record for seacrch in the table
   ****************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
       $this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_users.email',$search);
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
	function to get the count during search
   ****************************************************/
	function posts_search_count($search)
    {
       $this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_users.email',$search);
		
		$query = $this->db->get();
		return $query->num_rows();
       
    } 
	
	/****************************************************
		function to get the support query detail
   ****************************************************/
	function get_ticket_detail($ticket_no){
		$this->db->select(DB_PREFIX.'support.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'support.user_id='.DB_PREFIX.'users.id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->where(DB_PREFIX.'support.id',$ticket_no);
		$query = $this->db->get();
		return $query->row();
	}

	/****************************************************
		function to save the reply
   ****************************************************/
	function save_reply($data){
		$this->db->insert(DB_PREFIX.'support_reply',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	/****************************************************
		function to get all replys
   ****************************************************/
	function get_ticket_reply($ticket_no){
		$this->db->select(DB_PREFIX.'support_reply.*,'.DB_PREFIX.'users.email,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'support_reply');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'support_reply.user_id','left');
		$this->db->where(DB_PREFIX.'support_reply.ticket_no',$ticket_no);
		$query = $this->db->get();
		return $query->result();
	}
	
	/****************************************************
		function to close the ticket
   ****************************************************/
	function close_ticket($ticket){
		$data['status'] = 0;
		$this->db->where('id',$ticket);
		$this->db->update(DB_PREFIX.'support',$data);
		return true;
	}
	
	/****************************************************
		function to delete the ticket
   ****************************************************/
	function delete_ticket($ticket){
		$this->db->where('id',$ticket);
		$this->db->delete(DB_PREFIX.'support');
		$this->db->where('ticket_no',$ticket);
		$this->db->delete(DB_PREFIX.'support_reply');
	}
}