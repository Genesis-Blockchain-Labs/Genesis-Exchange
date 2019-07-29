<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_controller
{
	
    function __construct()
    {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
	$this->load->library('paypal_lib');
    $this->load->model('User_model');
    $this->load->model('Web_album_model');
    }	
	
    
    /************************************************
    Function for create album 
	************************************************/
	public function createalbum()
	{
		$login = $this->session->userdata('login');
		$id = $login->id;
		$create_date = date('Y-m-d');
		$shared = $this->input->post('shared');
			if($shared != '')
			{
				$shared = 1;
			}else{
			    $shared = 0;
			}
			$data = array('album_name'=>$this->input->post('album_name'), 
						'shared' => $shared,
						'user_id' => $id,
						'date' => $create_date);
			$album_id = $this->Web_album_model->create_album($data);
			if(($album_id !='') AND ($shared ==1 )){
				echo $album_id;
				}		
				else{
				    echo '';  
				}		
	}
		
		
		
	/***********************************************
	Function for get album images for album preview
    ***********************************************/
	public function album_images()
	{
		$album_id = $this->input->post('albm_id');
		$this->session->set_userdata('open_album', $album_id);
		$data['albumpic'] = $this->Web_album_model->albumimages($album_id);
		echo $resp = $this->load->view('album_preview', $data, True);
	}
	
	
	
	/**************************************
	Function for album map view
    **************************************/
	public function mapalbum_view()
	{
		$album_id = $this->input->post('album_id');
		$this->session->set_userdata('open_album', $album_id);
		$data['albumpic'] = $this->Web_album_model->albumimages($album_id);
		$data['imgslider'] = $this->load->view('mapslider', $data, True);
		echo json_encode($data);
		die;
	}
	
	
	/**************************************
	Function for upload albums images
    **************************************/
	public function imagesupload()
	{
		$data['pic_desc'] = $this->input->post('description');
		$data['album_id'] = $this->input->post('album_id');
		$data['date'] = date('Y-m-d');
		
		// Get lat and long by address         
	    $address = $this->input->post('location'); // Google HQ
	    $prepAddr = str_replace(' ','+',$address);
	    $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	    $output= json_decode($geocode);
	    if(!empty($output->results))
	        {
		        $data['latitude'] = $output->results[0]->geometry->location->lat;
		        $data['longitude'] = $output->results[0]->geometry->location->lng;
		    }
		    else{
		        $data['latitude'] = '';
		       	$data['longitude'] = '';
		    }  
		$fileName = $_FILES['image']['name'];
        $data['pic'] = $fileName;	
		
		$temp = explode(".", $_FILES["image"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		$data['download_pic'] = $newfilename;
		
		if(!empty($fileName))
		{
		$targetDir = "uploads/";
		$targetFile = $targetDir.$newfilename;
			if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFile))
			{
			    $upimg = $this->Web_album_model->imgupload($data);
                echo "success";				
			}
		}
	}
	
	
	
	/**************************************
	Function for partcular pic comment
    **************************************/
	public function pic_comment()
	{
		$pic_id = $this->input->post('pic_id');
		$data['comments'] = $this->Web_album_model->pic_comments($pic_id);
        echo $response = $this->load->view('pic_comment', $data, True);
	}
	
	
	
	/**************************************
	Function for post pic comment
    **************************************/
	public function postcomment()
	{
		$login = $this->session->userdata('login');
		$data['user_id'] = $login->id;
		$data['comment'] = $this->input->post('comment');
		$data['pic_id'] = $this->input->post('pic_id');
		$data['id'] = $this->input->post('comm_id');
		
		//send notification of comment
		    $picdetail = $this->Web_album_model->pic_detail($data['pic_id']);
		
		    $nata['res_user'] = $picdetail->user_id;
			$nata['notification'] = $login->fullname . " has commented on your ".$picdetail->album_name." albums's image ".$picdetail->pic .".";
			$nata['user_id'] = $login->id;
			$nata['album_id'] = $picdetail->album_id;
			$nata['pic_id'] = $data['pic_id'];
			
			$notifi = $this->User_model->SendNotification($nata);
		
		
		if($data['id']=='')
		{
			$inscomment = $this->Web_album_model->postcomment($data);
			echo '<div class="comm_list ll" id="'.$inscomment->id.'"> 
				    <p><img src="'. base_url() .'uploads/';
						if($inscomment->profile_pic !='')
						{
							echo $inscomment->profile_pic;
						}else{
							echo 'profile-pic.jpg';
						}
			echo '" width="30" /><div class="scum_cat"><h5>'. $inscomment->fullname .'<small> '. $inscomment->timestamp .'</small>';
			$login = $this->session->userdata('login');
				if($inscomment->user_id == $login->id)
				{
					echo '<button class="btn btn-link" onclick="edit_comment('.$inscomment->id .')">Edit</button><button class="btn btn-link" onclick="delete_comment('.$inscomment->id.')">Delete</buton>';
				}
			echo '</h5><span id="comm'.$inscomment->id.'">' . $inscomment->comment .'</span></div></div>';
		}
		else{
			$editcomment = $this->Web_album_model->editcomment($data);
			echo '<p><img src="'. base_url() .'uploads/';
						if($editcomment->profile_pic !='')
						{
							echo $editcomment->profile_pic;
						}else{
							echo 'profile-pic.jpg';
						}
			echo '" width="30" /><div class="scum_cat"><h5>'. $editcomment->fullname .'<small> '. $editcomment->timestamp .'</small>';
			$login = $this->session->userdata('login');
				if($editcomment->user_id == $login->id)
				{
					echo '<button class="btn btn-link" onclick="edit_comment('.$editcomment->id .')">Edit</button><button class="btn btn-link" onclick="delete_comment('.$editcomment->id.')">Delete</buton>';
				}
			echo '</h5><span id="comm'.$editcomment->id.'">' . $editcomment->comment .'</span></div>';
		}
	}
	


	/***************************************
	send invitation
	***************************************/
	public function send_invite()
	{
		$user_emails = $this->input->post('email1');
		$array_emails = explode(',',$user_emails);
		foreach($array_emails as $invites)
		{
			//for generate random string
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 20; $i++) {
				$randomstring .= $characters[rand(0, $charactersLength - 1)];
			    }
			$promocode = $randomstring.'/'.$this->input->post('user1');
			$login = $this->session->userdata('login'); 
			$sender_name = $login->fullname;
			$data['mata']=(object) array('invites'=> $invites,
								'sender_id' => $this->input->post('user1'),
								'promocode' => $promocode,
								'sender_name' =>$sender_name
								);
		    $this->send_invitation($data);
		}
	}	



	/*******************************************
	for email to send invitation to outer person
	********************************************/
	public function send_invitation($data)
	{		
		$this->load->library('email');  //Load the email library
        $this->email->initialize(array("mailtype" => "html"));  //Initialise the email helper and set the "from"
        $this->email->from('info@justdemo.org');
        //Set the recipient, subject and message based on the page
        $this->email->to($data['mata']->invites);
        $this->email->subject('Invitation From Scumper');	
		$this->email->message($this->load->view('invitationmessagebody', $data, True)); 
        $this->email->send();
        $this->Web_album_model->insert_invitation($data);	
	}



    /*******************************************
	function for add followers to create album
	********************************************/
	public function addcrtalbumfollowers()
	{
		$login = $this->session->userdata('login');
		$followers = $this->input->post('followers');
		$album_id = $this->input->post('album_id');
		foreach($followers as $followers_id)
		{
			$nata['res_user'] = $followers_id;
			$nata['notification'] = $login->fullname . " has shared his album with you.";
			$nata['user_id'] = $login->id;
			$nata['album_id'] = $album_id;
			$notifi = $this->User_model->SendNotification($nata);
		}
        $albumfollo = $this->Web_album_model->insertalbmfollo($followers, $album_id);
        echo "Successfuly added followers!";		
	}
	
	
	
	/*******************************************
	Paypal pay ment form and detail
	********************************************/
    function pay($album_id, $album_name){
		$this->db->select('album_name');
		$this->db->where('id', $album_id);
		$query = $this->db->get('sc_album_category');
		$album = $query->row();
		
        //Set variables for paypal form 
        $returnURL = base_url().'index.php/Album/addpayfollower'; //payment success url
        $cancelURL = base_url().'index.php/paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'index.php/paypal/ipn'; //ipn url
        //get particular product data
		$login = $this->session->userdata('login');
        $userID = $login->id; //current user id
        $logo = base_url().'images/logo.png';
        
        $this->paypal_lib->add_field('business', 'gsconsultantservices@gmail.com');
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'To increase followers limit as +5');
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number', $album_id);
        $this->paypal_lib->add_field('amount',  .99);        
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
    }
	
	
	//to delete album
	function deletealbum()
	{
		$album_id = $this->input->post('album_id');
		$res = $this->Web_album_model->deletealbum($album_id);
		echo $res;
	}
	
	
	
	/******************************************************    
	Function for add to follower after payment successfull	
	******************************************************/	
	function addpayfollower()	
	{	
    $paypalInfo   = $this->input->post();	
	$succalbum_id = $paypalInfo['item_number'];		
	$data['limit'] = $this->Web_album_model->getlimit($succalbum_id);	
	$data['followers'] = $this->Web_album_model->get_followers(); 		
	$this->load->view('header');		
	$this->load->view('addfollowers', $data);	
	$this->load->view('footer');
	}
	
	
	
	/*******************************************   
	Function for load previous comment	
	*******************************************/
	function loadpre_comment()
	{
		$slaut =  $this->input->post('slaut');
		$picid =  $this->input->post('picid');
		$offset = 5*$slaut;
		$allcomments = $this->Web_album_model->loadpre_comment($picid, $offset);
		if($allcomments !='')
			{
				$allcomments = array_reverse($allcomments);
				foreach($allcomments as $comment)
				{
					echo '<div id="'.$comment->id.'"><p><img src="'. base_url() .'uploads/';
					if($comment->profile_pic !='')
					{
						echo $comment->profile_pic; 
					}else{
						echo 'profile-pic.jpg';
					}
					echo '" width="30" /></p><div class="scum_cat"><h5>'. $comment->fullname .'<small> '. $comment->timestamp .'</small>';
					$login = $this->session->userdata('login');
					if($comment->user_id == $login->id)
					{
					    echo '<button class="btn btn-link">Edit</button><button class="btn btn-link" onclick="delete_comment('.$comment->id.')">Delete</buton>';
					}
					echo '</h5><p>' . $comment->comment .'</p></div></div>';
				}
			}
	}
	
	
	
	
	/*******************************************   
	Function for delete comment	
	*******************************************/
	function delete_comment()
	{
		$cid = $this->input->post('cid');
		$res = $this->Web_album_model->delete_comment($cid);
		echo "";
	}
	
}