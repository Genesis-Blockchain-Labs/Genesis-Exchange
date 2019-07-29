<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_Not_Found extends CI_Controller {

	public function __construct() 
    {
     	 parent::__construct();
    }
    public function index(){		
           //$this->load->view('errors/html/error_404');
           //$this->load->view('user/index');
		   redirect('/');
    }
 }