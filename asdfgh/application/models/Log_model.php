<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
     }
	 
	/****************************************************
			function to get login history count
	****************************************************/
	function allposts_count()
    {  
		$this->db->select(DB_PREFIX.'login_history.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'login_history');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'login_history.user_id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************************************
			function to get login history list
	****************************************************/
	function allposts($limit,$start,$col,$dir)
    {   
		$this->db->select(DB_PREFIX.'login_history.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'login_history');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'login_history.user_id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
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
			function to search login history list
	****************************************************/
	function posts_search($limit,$start,$search,$col,$dir)
    {
		$this->db->select(DB_PREFIX.'login_history.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'login_history');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'login_history.user_id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_login_history.login_date',$search);
		$this->db->or_like('ico_login_history.ip_address',$search);
		$this->db->or_like('ico_login_history.system',$search);
		$this->db->or_like('ico_login_history.browser',$search);
		$this->db->or_like('ico_login_history.country',$search);
		$this->db->or_like('ico_login_history.country_code',$search);
		$this->db->or_like('ico_login_history.status',$search);
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
			function to search login history count
	****************************************************/
	function posts_search_count($search)
    {
		$this->db->select(DB_PREFIX.'login_history.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname');
		$this->db->from(DB_PREFIX.'login_history');
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'login_history.user_id','full');
		$this->db->where(DB_PREFIX.'users.status','1');
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_login_history.login_date',$search);
		$this->db->or_like('ico_login_history.ip_address',$search);
		$this->db->or_like('ico_login_history.system',$search);
		$this->db->or_like('ico_login_history.browser',$search);
		$this->db->or_like('ico_login_history.country',$search);
		$this->db->or_like('ico_login_history.country_code',$search);
		$this->db->or_like('ico_login_history.status',$search);
		$query = $this->db->get();
		return $query->num_rows();
    } 
}