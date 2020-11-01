<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {

	public function __construct() 
	{
	  	parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('user_model');
		if (!$this->session->user_id > 0) {
			redirect(ADMIN_URL.'login');
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
		$config["total_rows"] = $this->user_model->getAgentListsCount($data['key']);	
		$data['users'] = $this->user_model->getAgentLists($_REQUEST['per_page'],$data['limit'],$data['key']);
		//$data['userlist']=$this->user_model->getUserLists($data['status'], $config['per_page'],$_REQUEST['per_page'],$data['key']);

		//$data['userlist']=$this->user_model->get_all();

		$params = '?t=1';
		if($data['limit']!='') $params .= '&limit='.$data['limit'];
		if($data['key']!='') $params .= '&key='.$data['key'];
		if($data['status']!='') $params .= '&status='.$data['status'];
		//if($data['order_by_field']!='') $params .= '&order_by_field='.$data['order_by_field'];
		//if($data['order_by_value']!='') $params .= '&order_by_value='.$data['order_by_value'];
		
		$config['base_url'] = site_url("admin/agents/index")."/".$params;
		
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




		
		$this->load->view('common/header');
		$this->load->view('admin/agents/index',$data);
		$this->load->view('common/footer');
	}
	public function deleteUser(){
		$this->user_model->delete_records('agent_master',array('agent_id'=>$_POST['agent_id']));
		return true;
	}
	public function changeStatus(){

		$insertid = $this->user_model->update("agent_master",array('status'=>$_POST['status']),array('agent_id'=>$_POST['agent_id']));
		return true;
	}
	public function add($agent_id='')
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){	
			
			$userData = array("name"=>$_POST['name'],
					"email"=>$_POST['email'],
					"address"=>$_POST['address'],
					"created_date"=>date('Y-m-d H:i:s')
				);
			if($_POST['password'] != ''){
				$userData['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
			}
			///echo '<pre>';print_r($_POST);exit;
			if($_POST['agent_id'] !=''){
				$this->user_model->update("agent_master",$userData,array('agent_id'=>$_POST['agent_id']));
			}else{
				$insertid = $this->user_model->insert("agent_master",$userData);
			}

			redirect('admin/agents');
	
		}else{

			if($agent_id!=''){
				$data['details'] = $this->user_model->getAgentDetailsByID($agent_id);
				$this->load->view('common/header');
				$this->load->view('admin/agents/add',$data);
				$this->load->view('common/footer');
				
			}else{
				$data['details'] = [];
				$this->load->view('common/header');
				$this->load->view('admin/agents/add',$data);
				$this->load->view('common/footer');
				//redirect('admin/agents');
			}
			
		
		}
	}
	
}
