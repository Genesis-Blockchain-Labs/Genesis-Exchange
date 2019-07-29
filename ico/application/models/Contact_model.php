<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact_model extends CI_Model{
 
     public function __construct(){
         parent::__construct(); 

     }
	 
/******************************************************
	function is use to get user auth if it allready have
*********************************************************/
	function save_contact($data){
		$auth = $this->db->insert(DB_PREFIX.'contact_us',$data);
		return $auth;
	}
}