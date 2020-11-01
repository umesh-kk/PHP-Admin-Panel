<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() 
	{
	  	parent::__construct();
		
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
		if ($this->session->user_id > 0) {
			//print_r($this->session);
			$data['counts'] =  $this->user_model->getCounts();
			$this->load->view('common/header');			
			$this->load->view('admin/dashboard',$data);
			$this->load->view('common/footer');        
		}else{
			redirect(ADMIN_URL . 'login');
		}
	}

	
}
