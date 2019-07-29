<?php
class Dashboard_model extends CI_Model{
	
	/****************************************************
			function to KYC PIE Chart
   ****************************************************/
	function kyc_piechart(){
		$this->db->select('id');
		$query = $this->db->get(DB_PREFIX.'users');
		$all = $query->num_rows();
		$this->db->select('id');
		$que = $this->db->get(DB_PREFIX.'kyc_detail');
		$kyc = $que->num_rows();
		return array('all'=>$all, 'kyc'=>$kyc);
	}	
	
	/********************************
		function to KYC Line Chart
	********************************/
	function kyc_linechart(){
		$start_date = date("Y-m-d", strtotime('-30 days'));
		$end_date = date("Y-m-d",strtotime('-1 days'));
		$query = $this->db->query("select COUNT(id) as total, DATE(date) AS day from ico_users where DATE(date) BETWEEN '$start_date' AND '$end_date' GROUP BY DATE(date)");
		return ($query->num_rows()>0) ? $query->result() : false;		
	}

	/********************************************
		FUNCTION IS USE TO  PROGRESS BAR VIEW
	********************************************/
	function progress_bar(){
		$this->db->select('*');
		$query = $this->db->get(DB_PREFIX.'progress_bar')->row_array();
		return $query;
	}
	
	/********************************************
		FUNCTION IS USE TO  GET USER DATA BY ID
	********************************************/
	function get_user($user_id){
		$this->db->select('*');
		$this->db->where('id',$user_id);
		$query = $this->db->get('login')->row_array();
		return $query;
	}	
	
	/*********************************************************
	FUNCTION IS USE TO SAVE AND UPDATE THE PROGRESS BAR DATA
	*********************************************************/
	function save_progress_bar($raised,$progress){
		$this->db->select('*');
		$query = $this->db->get(DB_PREFIX.'progress_bar')->row_array(); 
		if(!empty($query)){
			$data = array('raised'=>$raised,'progress_bar'=>$progress);
			$return = $this->db->update(DB_PREFIX.'progress_bar',$data);
		}else{
			$data = array('raised'=>$raised,'progress_bar'=>$progress);
			$return = $this->db->insert(DB_PREFIX.'progress_bar',$data);
		}
		return $return;
	} 

	/*********************************************************
				FUNCTION IS USE TO  ico VIEW
	*********************************************************/
	function ico(){
		$this->db->select('*');
		$query = $this->db->get(DB_PREFIX.'ico_status')->row_array();
		return $query;
	}

	/*********************************************************
		FUNCTION IS USE TO SAVE AND UPDATE THE ico DATA
	*********************************************************/
	function save_ico($text){
		$this->db->select('*');
		$query = $this->db->get(DB_PREFIX.'ico_status')->row_array(); 
		if(!empty($query)){
			$data = array('message'=>$text);
			$return = $this->db->update(DB_PREFIX.'ico_status',$data);
		}else{
			$data = array('message'=>$text);
			$return = $this->db->insert(DB_PREFIX.'ico_status',$data);
		}
		return $return;
	}
	/*********************************************************
		FUNCTION IS USE TO UPDATE GOOGLE AUTH CODE
	*********************************************************/
	function update_auth($user_id,$data){
		$this->db->where('id',$user_id);
		$query = $this->db->update('login',$data);
		return $query;
	} 
	/*********************************************************
		FUNCTION IS USE TO get total sold coins
	*********************************************************/	
	function sold_coin()
	{
		$this->db->select_sum('total_coins');
		$this->db->from(DB_PREFIX.'user_config');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}
	}
	
	/*********************************************************
		FUNCTION IS USE TO get ico stage
	*********************************************************/
	function ico_date()
	{
		$query = $this->db->query("SELECT * FROM `ico_setup` WHERE CURDATE() between start_date and end_date");
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}
}
?>