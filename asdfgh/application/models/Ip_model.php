<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ip_model extends CI_Model{ 
     public function __construct(){
         parent::__construct(); 
     }
	 
	/****************************************************
			function to check ip address
	****************************************************/
	function check_ip($ipAddress){
		$this->db->select('*');
		$this->db->where('ip',$ipAddress);
		$check = $this->db->get(DB_PREFIX.'admin_ip')->row_array();		
		return $check; 
	}
	
	/****************************************************
			function to save ip address
	****************************************************/
	 function saveip($data){
		$this->db->select('*');
		$this->db->where('ip',$data['ip']);
		$check = $this->db->get(DB_PREFIX.'admin_ip')->row_array();
		if(!empty($check)){
			$return = 'allready';
			return $return;
		}else{			
			$rtrn = $this->db->insert(DB_PREFIX.'admin_ip',$data);
			if($rtrn){
				$return = 'saved';
			}else{
				$return = 'notsaved';
			}
			return $return;
		}
	}
	/*******************************************************
		save ip logs when user fail or success login
	*******************************************************/
	function saveIpLog($data)
	{
		$this->db->insert(DB_PREFIX.'admin_log',$data);
		return true;
	}
	
	/****************************************************
			function to get admin ip count
	****************************************************/
	function allposts_count()
    { 
		$this->db->select(DB_PREFIX.'admin_ip.*');
		$this->db->from(DB_PREFIX.'admin_ip');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function to get admin ip list
	****************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
		$this->db->select(DB_PREFIX.'admin_ip.*');
		$this->db->from(DB_PREFIX.'admin_ip');
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
			function to get admin ip search list
	****************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
       $this->db->select(DB_PREFIX.'admin_ip.*');
		$this->db->from(DB_PREFIX.'admin_ip');
		$this->db->like('ico_admin_ip.ip',$search);
		$this->db->or_like('ico_admin_ip.date',$search);
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
			function to get admin ip search count
	****************************************************/
	function posts_search_count($search)
    {
        $this->db->select(DB_PREFIX.'admin_ip.*');
		$this->db->from(DB_PREFIX.'admin_ip');
		$this->db->like('ico_admin_ip.ip',$search);
		$this->db->or_like('ico_admin_ip.date',$search);
		$query = $this->db->get();
		return $query->num_rows();
    }

	/****************************************************
			function to unblock admin ip 
	****************************************************/
	function unblock($id){
	$this->db->where('id',$id);
	$this->db->delete(DB_PREFIX.'admin_ip');
	}	
}