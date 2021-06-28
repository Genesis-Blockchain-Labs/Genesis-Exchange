<?php
class A_login extends CI_Model{

   /****************************************************
			function used for login admin
   ****************************************************/
   public function login($data)
   {
        $query = $this->db->get_where('login', array('username'=> $data['username']));
		return ($query->num_rows()>0 ) ? $query->row() : false;
    }

	/****************************************************
			function used for check token
   ****************************************************/
	function check_token($token){
		$this->db->select('*');
		$this->db->where('token',$token);
		$check = $this->db->get('login')->row_array();		
		return $check; 
	}
	
	/****************************************************
			function used for get admin detail
   ****************************************************/
    public function get_admin($id)
    {
        $query = $this->db->get_where('login', array('id'=> $id));
        return ($query->num_rows()>0) ? $query->row() : false;  
    }
    
    /****************************************************
			function used for update otp
   ****************************************************/
	public function update_otp($id, $Otp)
    {    
    	$query = $this->db->update('login', array('twilio_otp'=> $Otp));
         $this->db->where('id', $id);
         return true;
   }
    
	/****************************************************
			function used for save change password
   ****************************************************/
	public function Save_ChangePassword($data)
	{
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('id', $this->session->userdata('id'));
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
		return $result->result(); 
        }
		else
		{
			return false;
		}
	}
	
	/****************************************************
			function to check record against email
   ****************************************************/
	function recoverpassword($email){
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('username',$email);
		$query = $this->db->get();
		return ($query->num_rows()>0) ? $query->row() : false;
	}
	
	
	/****************************************************
			function to reset password
   ****************************************************/
	function resetpassword($data){
		$this->db->where('id',$data['id']);
		$this->db->update('login',$data);
		return $this->db->affected_rows();
	}
	
	/****************************************************
			FUNTION IS USE TO INCREASE LOGIN ATTEMPT
   ****************************************************/
	function increase_attempt($table,$id){
		$this->db->set('login_attempt', 'login_attempt+1', FALSE);
		$this->db->where('id',$id);
		$this->db->update($table);
		return $this->db->affected_rows();
	}
	
	/****************************************************
			FUNTION IS USE TO delete ATTEMPT
   ****************************************************/
	function delete_attempt($table,$id){
		$this->db->set('login_attempt', '0', FALSE);
		$this->db->where('id',$id);
		$this->db->update($table);
		return $this->db->affected_rows();
	}
}
