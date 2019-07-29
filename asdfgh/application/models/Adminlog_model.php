<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminlog_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
     }
	 
	 /****************************************************
			function to get admin log count
	****************************************************/
	 function allposts_count()
    {  
		$this->db->select(DB_PREFIX.'admin_log.*,login.username');
		$this->db->from(DB_PREFIX.'admin_log');
		$this->db->join('login',DB_PREFIX.'admin_log.admin_id=login.id','full');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function to get admin log 
	****************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
       $this->db->select(DB_PREFIX.'admin_log.*,login.username');
		$this->db->from(DB_PREFIX.'admin_log');
		$this->db->join('login',DB_PREFIX.'admin_log.admin_id=login.id','full');
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
			function to search admin log
	****************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
		$this->db->select(DB_PREFIX.'admin_log.*,login.username');
		$this->db->from(DB_PREFIX.'admin_log');
		$this->db->join('login',DB_PREFIX.'admin_log.admin_id=login.id','full');
		$this->db->like('login.username',$search);
		$this->db->or_like('ico_admin_log.login_date',$search);
		$this->db->or_like('ico_admin_log.ip_address',$search);
		$this->db->or_like('ico_admin_log.country',$search);
		$this->db->or_like('ico_admin_log.country_code',$search);
		$this->db->or_like('ico_admin_log.status',$search);
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
			function to search admin log count
	****************************************************/
	function posts_search_count($search)
    {
		$this->db->select(DB_PREFIX.'admin_log.*,login.username');
		$this->db->from(DB_PREFIX.'admin_log');
		$this->db->join('login',DB_PREFIX.'admin_log.admin_id=login.id','full');
		$this->db->like('login.username',$search);
		$this->db->or_like('ico_admin_log.login_date',$search);
		$this->db->or_like('ico_admin_log.ip_address',$search);
		$this->db->or_like('ico_admin_log.country',$search);
		$this->db->or_like('ico_admin_log.country_code',$search);
		$this->db->or_like('ico_admin_log.status',$search);
		$query = $this->db->get();
		return $query->num_rows();
    } 
}