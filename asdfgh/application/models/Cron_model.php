<?php
class Cron_model extends CI_Model
{
	/****************************************************
			function to get all users details
	****************************************************/
	function userDetail()
	{ 
		$this->db->select('*');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('users'); 
		return $query->num_rows() > 0 ? $query->result() : false;        
	}

	/****************************************************
			 function to get  users detail
	****************************************************/ 	
	public function check_id($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$return = $this->db->get('dev_user')->row();
		return $return;
	}

	/****************************************************
			 function to check their reffered
	****************************************************/ 
	public function check_ref_user_with_id($id){		
		$query = $this->db->query('select SUM(contribution.contribution_in_dollar) as sum FROM `dev_user` left join `contribution` on contribution.user_id = dev_user.id WHERE `dev_user`.`refered_id` = "12201713081338"'); 
		$sum = $query->row();
		if (!empty($sum)){
				print_r($sum);die;
			}
	}
	
	/****************************************************
			function for to get single user details
	****************************************************/
	function singleUserData($id)
	{ 
		$where = array('id' => $id);
		$query = $this->db->get_where('registration', $where);
		return $query->num_rows() > 0 ? $query->row() : false;      
	}
	
	/********************************************************
		Activate user account with update his account status
	********************************************************/
	function accountActivate($id)
	{ 
		$data = array('status'=>1);  
		$this->db->where('id', $id);   
		$this->db->update('registration', $data);   
		return true;     
	}

	/********************************************************
		Delete user account with his unique id
	********************************************************/	 
	 function accountDeactivate($id)
	   { 
		 $this->db->where('id', $id);   
		 $this->db->delete('registration');   
		 return true;     
	   }
	
	/*********************************************
		function used for Delete Event
    *********************************************/
	function del_event($did,$table)
    {
        $this->db->where('id',$did);
		$this->db->update($table, array('sdelete' => '1'));
        return true;
    }
	
	/*********************************************
			function used get reward
    *********************************************/
	function work($id)
	{ 
		$query = $this->db->query('select id, type,link ,file,reward,date from rewards inner join reward_point on rewards.type_id = reward_point.reward_id where user_id='.$id.' order by rewards.id desc '); 
		return $query->num_rows() > 0 ? $query->result() : false;        
	}
	
	/*********************************************
			function used get reward count
    *********************************************/
	function user_work()
	{
		$query = $this->db->query('select * , (select count(id) from rewards where user_id = dev_user.id) as total from dev_user where sdelete = 0 order by dev_user.id desc'); 
		return $query->num_rows() > 0 ? $query->result() : false;  
	}
	
	/*****************************************************
	  user with contribution and with out contributions
    *****************************************************/
	function userWithContribution()
	{
		$this->db->select('dev_user.*,contribution.contribution_amount,contribution.bonus,contribution.boon_coins,contribution.contributed_currency,contribution.user_id');
		$this->db->from('dev_user');
		$this->db->join('contribution', 'dev_user.id = contribution.user_id', 'inner');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			$return = $result->result(); 
			foreach($return as $k=>$value)
			{
				$user_id = $value->user_id;
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$query = $this->db->get('accounts')->row_array(); 
				if(!empty($query)){
					$return[$k]->BTC = $query['BTC'];
					$return[$k]->LTC = $query['LTC'];
				}else{
					$return[$k]->BTC = '';
					$return[$k]->LTC = '';
				}					
			}
		return $return;
		}else{
			return false;
		}
	}

	/*****************************************************
		function used for sum of purchase
    *****************************************************/
	function total_purchase_amount()
	 {
		$query = $this->db->query('select SUM(purchase_amount) as total_purchase_amount from `proof` where user_id not in(select user_id from `contribution`)'); 
		return $query->num_rows() > 0 ? $query->row() : false;
	 }

	/*****************************************************
		function used for sum of purchase
    *****************************************************/

		function userWithoutContribution()
		 {
		 	$query = $this->db->query('select * from `dev_user` where id not in(select user_id from `contribution`)'); 
			return $query->num_rows() > 0 ? $query->result() : false;
		 }


	
	function edit_user($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('users'); 
		return $query->num_rows() > 0 ? $query->row() : false;      
	}
	
	function update_user($data,$id)
	{
		 $this->db->where('id', $id);   
		 $this->db->update('users', $data);   
		 return true;  
	}
	
	function kyc()
	{
		$this->db->select('proof.*,dev_user.email,dev_user.reference_id');
		$this->db->from('proof');
		$this->db->join('dev_user', 'dev_user.id = proof.user_id', 'inner');
		$this->db->where('proof.sdelete','0');
		$result = $this->db->get()->result_array();
		if(!empty($result)){
			foreach($result as $k=>$vaule){
				$user_id = $vaule['user_id'];
				$country_name = $vaule['country'];
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$accounts = $this->db->get('accounts')->row_array(); 
				if(!empty($accounts)){
					$result[$k]['BTC'] = $accounts['BTC'];
					$result[$k]['LTC'] = $accounts['LTC'];
				}else{
					$result[$k]['BTC'] = '';
					$result[$k]['LTC'] = '';
				}
				
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$contribution = $this->db->get('contribution')->row_array(); 
				if(!empty($contribution)){
					$result[$k]['contribution_amount'] = $contribution['contribution_amount'];
				}else{
					$result[$k]['contribution_amount'] = '';
				}
				
				$this->db->select('*');
				$this->db->where('country_name',$country_name);
				$country = $this->db->get('country')->row_array(); 
				if(!empty($country)){
					$result[$k]['country_code'] = $country['country_code'];
				}
			}
		}
		return $result;
	
	}
	
	function edit_work($id)
	{ 
		$this->db->select('*');
		$this->db->from('reward_point');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();  //row
		}else{
			return false;
		}

		
			
	}
	
	function edit_link(){ 
	
		$this->db->select('*');
		$this->db->from('rewards');
		$result = $this->db->get();
		if($result->num_rows() > 0){
			return $result->result();  //row
		}else{
			return false;
		}
	
	}
	
	function update_userDetail($data,$work_id){
		$this->db->where('id',$work_id);
		$this->db->update('rewards',$data);
		
		return true;
		
	}
	
	function edit_work1($id){
		$this->db->select('*');
		$this->db->from('rewards');
		$this->db->where('id',$id);
		$result = $this->db->get();
		if($result->num_rows() > 0){
			return $result->row();  //row
		}else{
			return false;
		}
	}
	
	function change_status($id,$status){
		
		$data=array('status'=>$status);
		$this->db->where('id',$id);
		$this->db->update('proof',$data);
		return true;
	}
	
	
	function udelete($id)
	{
		$this->db->where('id',$id);
		$this->db->update('proof',array('sdelete' => '1'));
		return true;
	}
	
	function get_whitelist_user($start,$end){
		$query = $this->db->query("select * from users where DATE(crt_date) BETWEEN '$start' AND '$end' order by crt_date");
		return $query->result();
	}
	
	function get_register_user($start,$end){
		$query = $this->db->query("select * from dev_user where DATE(date) BETWEEN '$start' AND '$end' order by date");
		return $query->result();
	}
	
	function get_kyc_user($start,$end){
		$query = $this->db->query("select * from proof where DATE(date) BETWEEN '$start' AND '$end' order by date");
		return $query->result();
	}
	
	/********************************
	function to KYC PIE Chart
	********************************/
	function kyc_piechart(){
		$this->db->select('id');
		$query = $this->db->get('dev_user');
		$all = $query->num_rows();
		
		$this->db->select('id');
		$que = $this->db->get('proof');
		$kyc = $que->num_rows();
		return array('all'=>$all, 'kyc'=>$kyc);
	}
	
	/********************************
	function to KYC Line Chart
	********************************/
	function kyc_linechart(){
		$start_date = date("Y-m-d", strtotime('-8 days'));
		$end_date = date("Y-m-d",strtotime('-1 days'));
		$query = $this->db->query("select COUNT(id) as total, DATE(date) AS day from dev_user where DATE(date) BETWEEN '$start_date' AND '$end_date' GROUP BY DATE(date)");
		return ($query->num_rows()>0) ? $query->result() : false; 
	}
	
	/********************************
	Kyc single user detail
	********************************/
	function kycDetail($id)
    {
        $this->db->select('*');
		$this->db->where('user_id',$id);
		$query = $this->db->get('proof'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    } 
	
	/********************************
	Kyc single user detail
	********************************/
	function singleuserDetail($id)
    {
        $this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('dev_user'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    } 
	
	function get_user_verified($id)
	{
		$query = $this->db->query("select * from dev_user where id = (select user_id from proof where id = '$id' )");
		return ($query->num_rows()>0) ? $query->row() : false; 
	}

/********************************
	Kyc single user tracking detail
	********************************/
	function tracking_detail($user_id)
    {
        $this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('user_track'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    } 

/*******  get contribution********/
	function get_contribution(){
        $this->db->select('*');
		$query = $this->db->get('contribution'); 
		return ($query->num_rows()>0) ? $query->result() : false; 
    } 
	


/****   get list of refered user  ********/
	function list_refrel_usr($ref_id){
		$this->db->select('*');
		$this->db->from('dev_user');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();
		return $return;
		
	}



	
/********************************
	Kyc single dev user detail
	********************************/
	function get_user($user_id)
    {
        $this->db->select('dev_user.*,proof.*,accounts.*,dev_user.reference_id as ref_id, dev_user.refered_id as refed_id ');
		$this->db->from('dev_user');
		$this->db->join('proof','dev_user.id=proof.user_id','left');
		$this->db->join('accounts','dev_user.id=accounts.user_id','left');
		$this->db->where('dev_user.id',$user_id);
		$query = $this->db->get(); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    }

/******   Function is use to save and update contribution ***********/
	function update_contribution($user_id,$data){
        $this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('contribution')->row_array(); 
		if(!empty($query)){
			$this->db->where('user_id',$user_id);
			$return = $this->db->update('contribution',$data);
		}else{
			$data['user_id'] = $user_id;
			$return = $this->db->insert('contribution',$data);
		}
		return $return;
    }  

	//function to dispaly imprinct and conversion
	function imprintConversion(){
		$this->db->select('*');
		$this->db->where('id',1);
		$query = $this->db->get('imprintConversion');
		return $query->row();
	}
	
/**********  Get all promo code *********/   
	function get_promo_code(){
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$query = $this->db->get('promotional_code')->result_array();
		return $query;
	}	
	
/**********  Check promo name *********/   
	function check_promo_name($name){
		$this->db->select('*');
		$this->db->where('reference_name',$name);
		$query = $this->db->get('promotional_code')->row_array();
		return $query;
	}	
	
/**********  Check promo code *********/   
	function check_promo_code($code){
		$this->db->select('*');
		$this->db->where('reference_code',$code);
		$query = $this->db->get('promotional_code')->row_array();
		return $query;
	}	
	
	
/**********  Save promo code *********/   
	function save_promo_code($data){
		$return = $this->db->insert('promotional_code',$data);
		return $return;
	} 
	
// Function is use to get references list
	function get_eferences($refered_id){ 
		$this->db->select('*');
		$this->db->where('refered_id',$refered_id);
		$this->db->order_by('id','desc');
		$query = $this->db->get('dev_user')->result_array();
		return $query;       
	}	

//  FUNCTION IS USE TO GET REGISTER USER ON SEARCH	
	function search_register_user($reference_id){
		$qry = "select * from dev_user where reference_id LIKE '".$reference_id."%'";
		
		$query = $this->db->query($qry);
		$return = $query->result();
		
		if(empty($return)){
			$query = $this->db->query("select * from dev_user where email LIKE '".$reference_id."%'");
			$returns = $query->result();
			return $returns;
		}else{
			return $return;
		}
		
	}

//  FUNCTION IS USE TO GET USER address ON SEARCH
	function search_address_user($address){
		$qry = '';
		$return = '';
		if($address=='etc'){
			$query = $this->db->query("select * from proof where eth_address !=''");
			$return = $query->result();
			return $return;
		}else{
			if($address=='btc'){
				$qry = "select * from accounts where BTC !=''";
				$query = $this->db->query($qry);
				$return = $query->result();
			}else if($address=='ltc'){
				$qry = "select * from accounts where LTC !=''";
				$query = $this->db->query($qry);
				$return = $query->result();
			}	
			
			return $return;
		}
	}

//  FUNCTION IS USE TO GET REGISTER USER ON SEARCH	
	function search_promo_code($code){
		$this->db->select('*');
		$this->db->where('refered_id',$code);
		$query = $this->db->get('dev_user')->result_array();
		return $query;
		
	}
//  FUNCTION IS USE TO GET REGISTER USER ON SEARCH	
	function edit_promo_code($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('promotional_code')->row_array();
		return $query;
		
	}

/**********  Save promo code *********/   
	function save_edit_promo_code($data){
		$this->db->where('id',$data['id']);
		$return = $this->db->update('promotional_code',$data);
		return $return;
	}

/*********  function to delete promo code *********/   
	public function delete_promo_code($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$return = $this->db->delete('promotional_code');
		return $return;
	} 	
	
//**************user with contribution when admin select it btc and ltc address ***************//
	function user_search_addresses($user_ids){
			$this->db->select('dev_user.*,contribution.contribution_amount,contribution.bonus,contribution.boon_coins,contribution.contributed_currency,contribution.user_id,accounts.BTC,accounts.LTC');
			$this->db->from('dev_user');
			$this->db->join('contribution', 'dev_user.id = contribution.user_id', 'inner');
			$this->db->join('accounts', 'dev_user.id = accounts.user_id', 'inner');
			$this->db->where_in('dev_user.id',$user_ids);
			$result = $this->db->get();
			
			if($result->num_rows() > 0){
				$return = $result->result(); 	
								
				return $return;
			}else{
				$return = '';
				return $return;
			}
	}	
	
//********* GET ADDRESSES OF ALL USER WHICH SUBMIT LTC,BTC,DASH ADDRESS***************//
	function contribute_addresses($user_ids){
			$this->db->select('dev_user.*,accounts.*');
			$this->db->from('dev_user');
			$this->db->join('accounts', 'dev_user.id = accounts.user_id', 'inner');
			$this->db->where_in('dev_user.id',$user_ids);
			$result = $this->db->get();
			if($result->num_rows() > 0){
				$return = $result->result();  
							
				return $return;
			}else{
				$return = '';
				return $return;
			}
	}

//*********     GET TOTAL NUMBER OF BOON COINS  ***************//
	function get_total_coin($user_ids){
		$this->db->select_sum('boon_coins');
		$this->db->from('contribution');
		$query = $this->db->get();
		return $query->row()->boon_coins;
			
	}	
	
//  FUNCTION IS USE TO  PROGRESS BAR VIEW
	function progress_bar(){
		$this->db->select('*');
		$this->db->where('id','1');
		$query = $this->db->get('progress_bar')->row_array();
		return $query;
	}

//  FUNCTION IS USE TO SAVE AND UPDATE THE PROGRESS BAR DATA
	function save_progress_bar($raised,$progress){
		$id = '1';
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get('progress_bar')->row_array(); 
		if(!empty($query)){
			$data = array('raised'=>$raised,'progress_bar'=>$progress);
			$this->db->where('id',$id);
			$return = $this->db->update('progress_bar',$data);
		}else{
			$data = array('raised'=>$raised,'progress_bar'=>$progress);
			$this->db->where('id',$id);
			$return = $this->db->insert('progress_bar',$data);
		}
		return $return;
	} 

/***********    function is use to get the user which use current user refrel id  *********/
	function refrel_usr($ref_id,$email){
		$this->db->select('*');
		$this->db->from('dev_user');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();
		$total_reward = '';
		foreach($return as $k=>$value){
			$user_id = $value['id'];
			$reward = $this->db->query("select SUM(boon_coins) from `contribution` where user_id =$user_id")->row_array();
			if(!empty($reward)){
				$total_reward = (($total_reward) + (round(($reward['SUM(boon_coins)']*2)/100)));
				$return[$k]['reward_points'] = round(($reward['SUM(boon_coins)']*2)/100);
			}
		}
		if(!empty($return)){
			$return['total_reward'] = $total_reward;
		}
		return $return;
	}

//  FUNCTION IS USE TO GET BOON OF SINGLE USER
	function get_boon_user($user_id){
		$return = '';
		$this->db->select('dev_user.*,contribution.*');
		$this->db->join('contribution','dev_user.id=contribution.user_id','inner');
		$this->db->where('contribution.contribution_in_dollar !=','');
		$this->db->where('contribution.contribution_in_dollar !=','0');
		$this->db->where('contribution.contribution_in_dollar !=','0.00');
		
		$this->db->where('dev_user.id',$user_id);
		$query = $this->db->get('dev_user')->row_array(); 	
		
		if(!empty($query)){
			$percent = $query['referral_bonus_percentage'];
			if(!empty($query['contribution_in_dollar'])){
				$own_boon  = (($query['contribution_in_dollar'])*25);
			}else{
				$own_boon = 0;
			}
			
			if(!empty($query['bonus'])){
				$own_bonus = (($own_boon*$query['bonus'])/100);
			}else{
				$own_bonus = 0;
			}
			
			$own_coin = ($own_boon+$own_bonus);
			$own_coin = number_format((float)$own_coin, 2, '.', '');
			$return = $own_coin;
		}
		return $return;
	}
	
//  FUNCTION IS USE TO GET BOON POINTS
	function reward_points($percentage,$data){
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get('contribution')->result_array();
			
			$final_dollar = 0;
			if(!empty($return)){
				foreach($return as $k=>$value){
					$dollar = $value['contribution_in_dollar'];
					$dollar = str_replace("($","",$dollar);
					$dollar = str_replace(")","",$dollar);
					$dollar = str_replace(",","",$dollar);
					$final_dollar = $final_dollar+$dollar;
					
				}
			}
			$sum = ($final_dollar*$percentage);
			$sum = ($sum/100);		
			$return = $sum*25;		
			$return = number_format((float)$return, 2, '.', '');
		}else{
			$return = '';
		}
		return $return;
	}

//  FUNCTION IS USE TO GET COUNTRY CODE
	function get_country_code($country){
		$this->db->select('*');
		$this->db->where('country_name',$country);
		$query = $this->db->get('country')->row_array();
		return $query;
	}

//  FUNCTION IS USE TO GET BOON POINTS from percentage
	function get_refrel_bonus($percent,$data){
		//echo'<pre> sadsads';print_r($data);exit;
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get('contribution')->result_array();
			
			$final_dollar = 0;
			if(!empty($return)){
				foreach($return as $k=>$value){
					$dollar = $value['contribution_in_dollar'];
					$dollar = str_replace("($","",$dollar);
					$dollar = str_replace(")","",$dollar);
					$dollar = str_replace(",","",$dollar);
					$final_dollar = $final_dollar+$dollar;
					
				}
			}
			$sum = ($final_dollar*$percent);
			$sum = ($sum/100);		
			$return = $sum*25;		
			$return = number_format((float)$return, 2, '.', '');
		}else{
			$return = '';
		}
		return $return;
	}	
	
//  FUNCTION IS USE TO GET BOON POINTS from percentage
	function get_referel_user_total_coin($data){
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['id'].',';
			}
			$user = rtrim($user_ids,",");
			$user = explode(",",$user);
			$this->db->select('*');
			$this->db->where('boon_coins !=','');
			$this->db->where('boon_coins !=','0.00');
			$this->db->where_in('user_id',$user);
			$return = $this->db->get('contribution')->result_array();
			foreach($return as $k=>$val){
				$user_id = $val['user_id'];
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$kyc = $this->db->get('proof')->row_array();
				if(!empty($kyc)){
					$return[$k]['serial_no'] = $kyc['serial_no'];					
				}else{
					$return[$k]['serial_no'] = '';
				}
			}
			return $return;
		}else{
			$return = '';
		}
		return $return;
	}

//  FUNCTION IS USE TO GET new wallet
	function get_lis_edit_wallet(){
		$this->db->select('proof.*,updated_eth_address.*');
		$this->db->join('updated_eth_address','proof.user_id=updated_eth_address.user_id','inner');
		$query = $this->db->get('proof')->result_array();
		return $query;
	}
	
//  FUNCTION IS USE TO change the status
	function change_new_wallet_status($user_id,$status,$new_eth){
		$new['status'] = $status;
		$this->db->where('user_id',$user_id);
		$query = $this->db->update('updated_eth_address',$new);		
		if($query){
			$old['eth_address'] = $new_eth;
			$this->db->where('user_id',$user_id);
			$query = $this->db->update('proof',$old);
		}
		return $query; 
	}

	function referel_boon_coin(){		
		$user_boon_coin = array();
		$this->db->select('dev_user.*,contribution.*');
		$this->db->join('contribution','dev_user.id=contribution.user_id','inner');
		$this->db->where('contribution.contribution_in_dollar !=','');
		$this->db->where('contribution.contribution_in_dollar !=','0');
		$this->db->where('contribution.contribution_in_dollar !=','0.00');
		$data = $this->db->get('dev_user')->result_array();
		if(!empty($data)){
			
			foreach($data as $key=>$val){				
				$own_boon  = 0;
				$own_bonus = 0;
				
				$reference_id=$val['reference_id'];
				
				if(!empty($val['contribution_in_dollar'])){
					$own_boon  = (($val['contribution_in_dollar'])*25);
				}else{
					$own_boon = 0;
				}
				
				if(!empty($val['bonus'])){
					$own_bonus = (($own_boon*25)*($val['bonus']/100));
				}else{
					$own_bonus = 0;
				}				
				$user_boon_coin[$key]['user_id'] = $val['user_id'];
				$user_boon_coin[$key]['own_coin'] = ($own_boon+$own_bonus);
				
				$refrel_users = $this->get_refrel_usr($reference_id);
				if(!empty($refrel_users)){
					$sum  = 0;
					$refrel_boon  = 0;
					$refrel_bonus = 0;
					
					foreach($refrel_users as $value){
						$ref_user_id = $value['id'];
						$this->db->select('dev_user.*,contribution.*');
						$this->db->join('contribution','dev_user.id=contribution.user_id','inner');
						$this->db->where('contribution.contribution_in_dollar !=','');
						$this->db->where('contribution.contribution_in_dollar !=','0');
						$this->db->where('contribution.contribution_in_dollar !=','0.00');
						$this->db->where('contribution.user_id=',$ref_user_id);
						$data = $this->db->get('dev_user')->row_array();
						
						if(!empty($data['contribution_in_dollar'])){
							$refrel_boon  = ($refrel_boon +(($data['contribution_in_dollar'])*25));
						}
						
						if(!empty($data['bonus'])){
							$refrel_bonus = ($refrel_bonus+((($data['contribution_in_dollar'])*25)*($data['bonus']/100)));
						}
					}
					$total_refrel_boon = ($refrel_boon+$refrel_bonus);
					$sum = ($total_refrel_boon*5);
					$sum = ($sum/100);
					$sum = number_format((float)$sum, 2, '.', '');
					
					$user_boon_coin[$key]['refrel_coin'] = $sum; 
				}else{
					$user_boon_coin[$key]['refrel_coin'] = '';
				}
			}
		}
	return $user_boon_coin; 
	}	
	
	function get_refrel_usr($ref_id){
		$this->db->select('*');
		$this->db->from('dev_user');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();
		
		return $return;
	}
	
}
?>