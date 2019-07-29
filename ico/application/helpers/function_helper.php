<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*******************function used for success message div**********************/
if ( ! function_exists('success_message'))
{
	function success_message($msg = NULL)
	{
		$message = '<div class="col-sm-12"><div class="alert alert-success fade in" role="alert">';
		$message .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$message .= $msg;
		$message .= '</div></div>';
		return $message;
	}
}

/*******************function used for error message div**********************/
if ( ! function_exists('error_message'))
{
	function error_message($msg = NULL)
	{
		$message = '<div class="col-sm-12"><div class="alert alert-danger fade in" role="alert">';
		$message .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$message .= $msg;
		$message .= '</div></div>';
		return $message;
	}
}

/*******************function used for get all countries**********************/
if ( ! function_exists('getCountries'))
{
	function getCountries() 
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$result = $ci->db->get('ico_country')->result();
		return $result;
	}
}







    

	