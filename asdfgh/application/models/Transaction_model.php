<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaction_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
     }
	 
	 /****************************************************
			function to get transaction list
   ****************************************************/
	 function get_users(){
		$this->db->select(DB_PREFIX.'transaction.*');
		$this->db->from(DB_PREFIX.'transaction');
		$result = $this->db->get()->result();
		return $result;
	 }

	/****************************************************
			function to get transaction list
   ****************************************************/	 
	 function allposts($limit,$start,$col,$dir,$user_id = '')
	 {
		$this->db->select(DB_PREFIX.'transaction.*,'.DB_PREFIX.'users.email as useremail');
		$this->db->from(DB_PREFIX.'transaction');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'transaction.user_id='.DB_PREFIX.'users.id','left');
		$this->db->limit($limit,$start);
		if($col == 'email')
		{
			$this->db->order_by(DB_PREFIX.'users.'.$col,'DESC');
		}
		else
		{
			$this->db->order_by(DB_PREFIX.'transaction.'.$col,'DESC');
		}
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		
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
			function to get transaction search
   ****************************************************/
	function posts_search($limit,$start,$search,$col,$dir,$user_id = '')
    {
		$this->db->select(DB_PREFIX.'transaction.*,'.DB_PREFIX.'users.email as useremail');
		$this->db->from(DB_PREFIX.'transaction');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'transaction.user_id='.DB_PREFIX.'users.id','left');
		
		$this->db->like('ico_transaction.amount',$search);
		if(!empty($user_id))
		{
			$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.currency',$search);
		if(!empty($user_id))
		{
			$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.email',$search);
		if(!empty($user_id))
		{
			$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.ipn_date',$search);
		if(!empty($user_id))
		{
			$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.status',$search);
		if(!empty($user_id))
		{
			$this->db->where(DB_PREFIX.'transaction.user_id',$user_id);
		}
		
		$this->db->limit($limit,$start);
		if($col == 'email')
		{
			$this->db->order_by(DB_PREFIX.'users.'.$col,'DESC');
		}
		else
		{
			$this->db->order_by(DB_PREFIX.'transaction.'.$col,'DESC');
		}
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
			function to get transaction search count
   ****************************************************/
	function posts_search_count($search,$user_id = "")
    {
        $this->db->select(DB_PREFIX.'transaction.*');
		$this->db->from(DB_PREFIX.'transaction');
		
		$this->db->like('ico_transaction.amount',$search);
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.currency',$search);
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.email',$search);
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.ipn_date',$search);
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		
		$this->db->or_like('ico_transaction.status',$search);
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		$query = $this->db->get();
		return $query->num_rows();
       
    }

	/****************************************************
			function to get transaction count
   ****************************************************/	
	function allposts_count($user_id = ""){
		 $this->db->select(DB_PREFIX.'transaction.*');
		$this->db->from(DB_PREFIX.'transaction');
		if(!empty($user_id))
		{
			$this->db->where('user_id',$user_id);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function is use to delete the users
   ****************************************************/
	function delete_transaction($id){	
		$this->db->where('id',$id);
		$this->db->delete(DB_PREFIX.'transaction');
	}
	
	/****************************************************
			function is use to get invest users
   ****************************************************/
	function get_investuser($user_id){
		$this->db->select(DB_PREFIX.'transaction.*');
		$this->db->from(DB_PREFIX.'transaction');
		$this->db->where('user_id',$user_id);
		$result = $this->db->get()->row();
		return $result;
	}
}