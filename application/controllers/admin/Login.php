<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() 
	{
	  	parent::__construct();
		//   if (!$this->session->userdata('loggedIn')) {
		// 	redirect(ADMIN_URL . 'login');
		//   }
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('login_model');
		
	}
	public function index()
	{
		if ($this->session->user_id > 0) {
			
			// print_r($this->session);
			// echo "sss";exit;
			redirect('admin/dashboard');
			// $this->load->view('common/header');			
			// $this->load->view('admin/dashboard');
			// $this->load->view('common/footer');        
		}else{
			$this->load->view('common/login');
		}
	}
	function check_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->login_model->login($this->input->post('email'));
            
            if ($data['user_id'] > 0) {
                if (password_verify($this->input->post('password'), $data['password'])) {
                    $this->session->set_userdata($data);
                    $result = array("status" => TRUE, 'message' => 'Successfully logined.');
                    
                } else {
                    $result = array("status" => FALSE, 'message' => 'Invalid Email or Password.');
                }
            } else {
                $result = array("status" => FALSE, 'message' => 'Invalid Email or Password.');
            }
            echo json_encode($result);
        }
    }
	
}
