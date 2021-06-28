<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kyc_model extends CI_Model{ 
     public function __construct() {
           parent::__construct(); 
           
     }
	
//function is use to get of  users	
	function get_config($id){
		$this->db->where('user_id',$id);
		$result = $this->db->get(DB_PREFIX.'user_config')->row_array();
		return $result;
	}
	
	/********************************
	Kyc single user detail
	********************************/
	function singleuserDetail($id)
    {
        $this->db->select('*');
		$this->db->where('user_id',$id);
		$query = $this->db->get(DB_PREFIX.'user_config'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    } 
	
//function is use to list of all register users kyc
	function get_all_kyc(){
		$this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.status as kyc_status');		
		$this->db->join(DB_PREFIX.'kyc_detail',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'kyc_detail.type !=','');
		$result = $this->db->get(DB_PREFIX.'users')->result_array(); 
		
		if(!empty($result)){
			foreach($result as $k=>$val){
				$user_id = $val['user_id'];
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$query = $this->db->get(DB_PREFIX.'contribution')->row_array(); 
				
				$result[$k]['contribution_in_dollar'] = $query['contribution_in_dollar'];
			}
			
		}
		return $result;
	}

//function is use to list of all register users	
	function change_status($id,$status){		
		$data = array('status'=>$status);
		$this->db->where('user_id',$id);
		$this->db->update(DB_PREFIX.'kyc_detail',$data);
		return true;
	}

/*******  get contribution********/
	function get_contribution($user_id){
        $this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'contribution'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    }

/*******  get contribution********/
	function get_tracking($user_id){
        $this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'user_track')->row_array(); 
		return $query; 
    }	

//  FUNCTION IS USE TO GET OWN POINTS	
	function get_own_coin($percentage,$user_id){
		$contribution = $this->get_contribution($user_id);
		//echo'<pre> ';print_r($contribution);exit;
		if(!empty($contribution)){
			$dollar = $contribution->contribution_in_dollar;
			$bonus = $contribution->bonus;
			
			$dollar = str_replace("($","",$dollar);
			$dollar = str_replace(")","",$dollar);
			$dollar = str_replace(",","",$dollar);
			
			$dollar = $dollar*2;
			$bonus = ($dollar*$bonus)/100;
			$final = $dollar+$bonus;
			$returns = number_format((float)$final, 2, '.', ''); 
			return $returns;
		}else{
			$returns = '0';
			return $returns;
		}
	}
//  FUNCTION IS USE TO GET REFERRAL POINTS
	function reward_points($percentage,$data){
		//echo'<pre> ';print_r($percentage);exit;
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['user_id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get(DB_PREFIX.'contribution')->result_array();
				
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
		
			$return = $sum*2;	
			
			$return = number_format((float)$return, 2, '.', ''); 
			
		}else{
			$return = '';
		}
		return $return;
	}
	

/***********    function is use to get the user which use current user refrel id  *********/
	function refrel_usr($ref_id){
		$this->db->select('*');
		$this->db->from(DB_PREFIX.'user_config');
		$this->db->where('refered_id',$ref_id);
		$this->db->where('refered_id !=','');
		$return = $this->db->get()->result_array();	
				
		return $return;
	}

//  FUNCTION IS USE TO GET BOON POINTS from percentage
	function get_refrel_bonus($percent,$data){
		
		if(!empty($data)){
			$user_ids = '';
			foreach($data as $val){
				$user_ids.=$val['user_id'].',';
			}
			$user_ids = rtrim($user_ids,",");
			$user_ids = explode(',',$user_ids);
			
			$this->db->select('*');
			$this->db->where_in('user_id',$user_ids);
			$return = $this->db->get(DB_PREFIX.'contribution')->result_array();
			
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
		
			$return = $sum*2;		
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
				$user_ids.=$val['user_id'].',';
			}
			$user = rtrim($user_ids,",");
			$user = explode(",",$user);
			$this->db->select('*');
			$this->db->where('total_coins !=','');
			$this->db->where('total_coins !=','0.00');
			$this->db->where_in('user_id',$user);
			$return = $this->db->get(DB_PREFIX.'contribution')->result_array();
			foreach($return as $k=>$val){
				$user_id = $val['user_id'];
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$kyc = $this->db->get(DB_PREFIX.'kyc_detail')->row_array();
				if(!empty($kyc)){
					//$return[$k]['serial_no'] = $kyc['serial_no'];					
				}else{
					//$return[$k]['serial_no'] = '';
				}
			}
			
			return $return;
		}else{
			$return = '';
		}
		return $return;
	}
	
/*******  get accounts (BTC,ETH) detail ********/
	function get_account($user_id){
		$this->db->select(DB_PREFIX.'accounts.*,'.DB_PREFIX.'coins.*');		
		$this->db->join(DB_PREFIX.'coins',DB_PREFIX.'accounts.coin_type='.DB_PREFIX.'coins.coin_id','full');
		$this->db->where(DB_PREFIX.'accounts.user_id',$user_id);
		$query = $this->db->get(DB_PREFIX.'accounts')->result_array();
		
		return $query; 
    }

/*******          Kyc single user detail        *******/
	function kycDetail($id){
        $this->db->select('*');
		$this->db->where('user_id',$id);
		$query = $this->db->get(DB_PREFIX.'kyc_detail'); 
		return ($query->num_rows()>0) ? $query->row() : false; 
    } 
	////////////////////////////////////////////////ajax pagination//////////////////////////
	  function allkyc_count()
    {   
	
		$this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.status as kyc_status');
		$this->db->from(DB_PREFIX.'kyc_detail');		
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'kyc_detail.type !=','');
		$query = $this->db->get();
		
		return $query->num_rows(); 
		

    }
	
	function allkyc($limit,$start,$col,$dir)
    {   
      
		$this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.status as kyc_status');
		$this->db->from(DB_PREFIX.'kyc_detail');		
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'kyc_detail.type !=','');
		$query = $this->db->get();
		if($query->num_rows()>0)
        {
            $result = $query->result(); 
			if(!empty($result)){
			foreach($result as $k=>$val){
				$user_id = $val->user_id;
				$this->db->select('*');
				$this->db->where('user_id',$user_id);
				$query = $this->db->get(DB_PREFIX.'contribution')->row_array(); 
				
				$result[$k]->contribution_in_dollar = $query['contribution_in_dollar'];
			}
			
		}
		return $result;
        }
        else
        {
            return null;
        }
        
    }
	function kyc_search($limit,$start,$search,$col,$dir)
    {
        $this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.firstname,'.DB_PREFIX.'users.lastname,'.DB_PREFIX.'user_config.reference_id,'.DB_PREFIX.'user_config.refered_id,'.DB_PREFIX.'kyc_detail.status as kyc_status');
		$this->db->from(DB_PREFIX.'kyc_detail');		
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'kyc_detail.type !=','');
		
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_kyc_detail.country',$search);
		$this->db->or_like('ico_kyc_detail.purchase_amount',$search);
		$this->db->or_like('ico_kyc_detail.eth_address',$search);
		$this->db->or_like('ico_user_config.reference_id',$search);
		$this->db->or_like('ico_user_config.refered_id',$search);
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
	
	function kyc_search_count($search)
    {
         $this->db->select(DB_PREFIX.'kyc_detail.*,'.DB_PREFIX.'users.*,'.DB_PREFIX.'user_config.*,'.DB_PREFIX.'kyc_detail.status as kyc_status');
		$this->db->from(DB_PREFIX.'kyc_detail');		
		$this->db->join(DB_PREFIX.'users',DB_PREFIX.'users.id='.DB_PREFIX.'kyc_detail.user_id','full');
		$this->db->join(DB_PREFIX.'user_config',DB_PREFIX.'users.id='.DB_PREFIX.'user_config.user_id','full');
		$this->db->where(DB_PREFIX.'kyc_detail.type !=','');
		
		$this->db->like('ico_users.firstname',$search);
		$this->db->or_like('ico_users.lastname',$search);
		$this->db->or_like('ico_kyc_detail.country',$search);
		$this->db->or_like('ico_kyc_detail.purchase_amount',$search);
		$this->db->or_like('ico_kyc_detail.eth_address',$search);
		$this->db->or_like('ico_user_config.reference_id',$search);
		$this->db->or_like('ico_user_config.refered_id',$search);
		
		$query = $this->db->get();
		return $query->num_rows();
       
    } 
	
}

?>