<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blockip_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
           
     }
	 /****************************************************
			function used to get ip address list
	****************************************************/
	 function ipaddress_list(){
		$this->db->select('*');
		$return = $this->db->get(DB_PREFIX.'user_ip')->result_array();		
		return $return; 
	 }
	 
	 /****************************************************
			function used to check ip address 
	****************************************************/
	 function check_ip($ipAddress){
		$this->db->select('*');
		$this->db->where('ip',$ipAddress);
		$check = $this->db->get(DB_PREFIX.'user_ip')->row_array();		
		return $check; 
	}
	
	/****************************************************
			function used to save ip address 
	****************************************************/
	function saveip($data){
		$this->db->select('*');
		$this->db->where('ip',$data['ip']);
		$check = $this->db->get(DB_PREFIX.'user_ip')->row_array();
		if(!empty($check)){
			$return = 'allready';
			return $return;
		}else{			
			$rtrn = $this->db->insert(DB_PREFIX.'user_ip',$data);
			if($rtrn){
				$return = 'saved';
			}else{
				$return = 'notsaved';
			}
			return $return;
		}
	}
	
	/****************************************************
			function used to get user ip count 
	****************************************************/
	function allposts_count()
    {   
		$this->db->select(DB_PREFIX.'user_ip.*');
		$this->db->from(DB_PREFIX.'user_ip');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function used to get user ip list
	****************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
		$this->db->select(DB_PREFIX.'user_ip.*');
		$this->db->from(DB_PREFIX.'user_ip');
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
			function used to search user ip
	****************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
       $this->db->select(DB_PREFIX.'user_ip.*');
		$this->db->from(DB_PREFIX.'user_ip');
		$this->db->like('ico_user_ip.ip',$search);
		$this->db->or_like('ico_user_ip.date',$search);
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
			function used to search user ip count 
	****************************************************/
	function posts_search_count($search)
    {
        $this->db->select(DB_PREFIX.'user_ip.*');
		$this->db->from(DB_PREFIX.'user_ip');
		$this->db->like('ico_user_ip.ip',$search);
		$this->db->or_like('ico_user_ip.date',$search);
		$query = $this->db->get();
		return $query->num_rows();
       
    }

	/****************************************************
			function used to unbloak user ip 
	****************************************************/
	function unblock($id){
	$this->db->where('id',$id);
	$this->db->delete(DB_PREFIX.'user_ip');
	}	
	 
}