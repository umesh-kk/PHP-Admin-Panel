<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->load->model('Login_model');
        if ($this->session->admin_id > 0) {
            redirect('dashboard');
        }
    }
	public function index()
	{
		$this->load->view('login');
	}
}
