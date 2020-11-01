<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$this->load->library('pagination');
		
		
		//$config["total_rows"] = $this->user_model->getUserListsCount();
		

		$data['page_limit']= $this->config->item('default_pagination');
		//echo '<pre>';print_r($data );exit;	
		// $data['order_by_field'] =  (!$this->input->post('order_by_field') ? ($this->input->get('order_by_field') ? $this->input->get('order_by_field') :''):$this->input->post('order_by_field'));
		// $data['order_by_value']      =  (!$this->input->post('order_by_value') ? ($this->input->get('order_by_value') ? $this->input->get('order_by_value') :''):$this->input->post('order_by_value'));
			
		$data['key']	=	(!$this->input->post('key') ? ($this->input->get('key') ? $this->input->get('key') :''):$this->input->post('key'));
		$data['status']	=	(!$this->input->post('status') ? ($this->input->get('status') ? $this->input->get('status') :''):$this->input->post('status'));
		$data['limit']	=	(!$this->input->post('limit') ? ($this->input->get('limit') ? $this->input->get('limit') :$data['page_limit']):$this->input->post('limit'));
		
		//$config['total_rows']=$this->user_model->getUserCount();
		$config['per_page'] = $data['limit'] == 'all' ? $config['total_rows'] : $data['limit'];
		$_REQUEST['per_page'] = isset($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 0;
		$data['status'] = $data['status']?$data['status']:'Y';
		//echo '<pre>';print_r($_REQUEST );exit;
		$config["total_rows"] = $this->user_model->getUserListsCount($data['key']);	
		$data['users'] = $this->user_model->getUserLists($_REQUEST['per_page'],$data['limit'],$data['key']);
		//$data['userlist']=$this->user_model->getUserLists($data['status'], $config['per_page'],$_REQUEST['per_page'],$data['key']);

		//$data['userlist']=$this->user_model->get_all();

		$params = '?t=1';
		if($data['limit']!='') $params .= '&limit='.$data['limit'];
		if($data['key']!='') $params .= '&key='.$data['key'];
		if($data['status']!='') $params .= '&status='.$data['status'];
		//if($data['order_by_field']!='') $params .= '&order_by_field='.$data['order_by_field'];
		//if($data['order_by_value']!='') $params .= '&order_by_value='.$data['order_by_value'];
		
		$config['base_url'] = site_url("admin/users/index")."/".$params;
		
	//--------------------------------------------------

	
	
	// load pagination class
		$config['page_query_string'] = TRUE;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";			
		$data['page'] = $_REQUEST['per_page'];
		$this->pagination->initialize($config);	
		$data["links"] = $this->pagination->create_links();


		//echo '<pre>';print_r($data["links"] );exit;
		///$this->getPagination();
	
		foreach ($data['users'] as &$user) {
			$data['logs'] = $this->user_model->get_log($user['user_id']);
			//echo "<pre>";print_r($data['logs']);
			if(!empty($data['logs']['total_time'])) {
				$user['total'] = $this->secondsToWords($data['logs']['total_time']);
			} else {
				$user['total'] = '0 seconds';
			}
		}
		//exit;
		// echo "<pre>";print_r($data['users']);
		// exit;

	


		
		$this->load->view('common/header');
		$this->load->view('admin/users/index',$data);
		$this->load->view('common/footer');
	}
	public function deleteUser(){
		$this->user_model->delete_records('user_master',array('user_id'=>$_POST['user_id']));
		return true;
	}
	public function changeStatus(){

		$insertid = $this->user_model->update("user_master",array('active'=>$_POST['status']),array('user_id'=>$_POST['user_id']));
		return true;
	}
	public function add($user_id='')
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){	
			//echo '<pre>';print_r($_POST);exit;
			$userData = array("first_name"=>$_POST['first_name'],
							"last_name"=>$_POST['last_name'],
							"updated_at"=>date('Y-m-d H:i:s')
							);
			$userProfile = array("country"=>$_POST['country'],
							"city"=>$_POST['city'],
							"zipcode"=>$_POST['zipcode'],
							"dob"=>$_POST['dob'],
							"gender"=>$_POST['gender'],
							"address"=>$_POST['address']
						);
			if(isset($_POST['user_id']) && $_POST['user_id']!=''){
				$this->user_model->update("user_master",$userData,array('user_id'=>$_POST['user_id']));
				$this->user_model->update("user_profile",$userProfile,array('user_id'=>$_POST['user_id']));
				$this->session->set_flashdata('message', 'Successfully updated', 'SUCCESS');
			}else{
				$userData['email']=$_POST['email'];
				$userData['password']=md5($_POST['email']);
				$userData['user_type']=3;
				$insertid = $this->user_model->insert("user_master",$userData);
				$userProfile['user_id']=$insertid;
				$this->user_model->insert("user_profile",$userProfile);
				$this->session->set_flashdata('message', 'User added.', 'SUCCESS');
			}

			redirect('admin/users');
	
		}else{

			if($user_id!=''){
				$data['details'] = $this->user_model->getDetailsByID($user_id);
				$this->load->view('common/header');
				$this->load->view('admin/users/add',$data);
				$this->load->view('common/footer');
				
			}else{
				$data['details'] = [];
				$this->load->view('common/header');
				$this->load->view('admin/users/add',$data);
				$this->load->view('common/footer');
			}
			
		
		}
	}

	public function logs ($user_id) {
		$data['logs'] = $this->user_model->get_log_details($user_id);
		foreach ($data['logs'] as &$log) {
			$total = strtotime($log['end_time']) - strtotime($log['start_time']);
			$log['total'] = $this->secondsToWords($total);
		}
		$this->load->view('common/header');
		$this->load->view('admin/users/log_details',$data);
		$this->load->view('common/footer');

	}

	public function secondsToWords($seconds) {
		$ret = "";

		/*** get the days ***/
		$days = intval(intval($seconds) / (3600*24));
		if($days> 0)
		{
			$ret .= "$days days ";
		}

		/*** get the hours ***/
		$hours = (intval($seconds) / 3600) % 24;
		if($hours > 0)
		{
			$ret .= "$hours hours ";
		}

		/*** get the minutes ***/
		$minutes = (intval($seconds) / 60) % 60;
		if($minutes > 0)
		{
			$ret .= "$minutes minutes ";
		}

		/*** get the seconds ***/
		$seconds = intval($seconds) % 60;
		if ($seconds > 0) {
			$ret .= "$seconds seconds";
		}

		return $ret;
	}
	
}
