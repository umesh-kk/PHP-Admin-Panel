<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct() 
	{
	  	parent::__construct();
		//   if (!$this->session->userdata('loggedIn')) {
		// 	redirect(ADMIN_URL . 'login');
		//   }
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('user_model');
		if (!$this->session->user_id > 0) {
			redirect(ADMIN_URL . 'login');
		}
	}
	public function index()
	{
		$this->session->sess_destroy();
        redirect('/admin');
	}
	
}
