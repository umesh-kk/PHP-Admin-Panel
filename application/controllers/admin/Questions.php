<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {

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
		$data['page_limit']= $this->config->item('default_pagination');
		$data['key']	=	(!$this->input->post('key') ? ($this->input->get('key') ? $this->input->get('key') :''):$this->input->post('key'));
		$data['status']	=	(!$this->input->post('status') ? ($this->input->get('status') ? $this->input->get('status') :''):$this->input->post('status'));
		$data['limit']	=	(!$this->input->post('limit') ? ($this->input->get('limit') ? $this->input->get('limit') :$data['page_limit']):$this->input->post('limit'));
		$data['lessons']= $this->user_model->get_where('lesson_master',array(),'lesson_id ASC','results');

		if($_SERVER['REQUEST_METHOD']=='POST'){	
			//echo '<pre>';print_r($_POST);exit;
			if($_POST['lesson'] != ''){
				$data['questions']= $this->user_model->getQuestions($_POST['lesson']);
			}else{
				$data['questions']= [];
				
				//$data['questions']= $this->user_model->get_where('question_master',array(),'question_id ASC','results');
			}
			//echo '<pre>';print_r($data['questions']);exit;
			$this->load->view('common/header');
			$this->load->view('admin/questions/index',$data);
			$this->load->view('common/footer');
		}else{
			
			$data['questions']= [];
			$data['questions']= $this->user_model->getQuestions();
			//$data['questions']= $this->user_model->get_where('question_master',array(),'question_id ASC','results');
			$this->load->view('common/header');
			$this->load->view('admin/questions/index',$data);
			$this->load->view('common/footer');
		}
		
	}
	public function add($question_id='')
	{

		$data['lessons']= $this->user_model->get_where('lesson_master',array(),'lesson_id ASC','results');

		if($_SERVER['REQUEST_METHOD']=='POST'){	
			//echo '<pre>';print_r($_POST);
			$userData = array(
							"question_id"=>$_POST['question_id'],
							"lesson_id"=>$_POST['lesson_id'],
							"answer_type"=>$_POST['answer_type'],
							"question"=>$_POST['question']
						);
		
			if(isset($_POST['question_id']) && $_POST['question_id']!=''){
				
				$this->user_model->update("question_master",$userData,array('question_id'=>$_POST['question_id']) );
				//echo '<pre>';print_r($_POST);exit;
				$this->session->set_flashdata('message', 'Successfully updated', 'SUCCESS');
			}else{
				$insertid = $this->user_model->insert("question_master",$userData);
				$userProfile['question_id']=$insertid;
				$this->session->set_flashdata('message', 'Question added successfully.', 'SUCCESS');
			}

			redirect('admin/questions');
	
		}else{

			if($question_id!=''){
				$data['details'] = $this->user_model->get_where('question_master',array('question_id'=>$question_id),'question_id ASC','row');
				//echo '<pre>';print_r( $data['details'] );exit;
				$this->load->view('common/header');
				$this->load->view('admin/questions/add',$data);
				$this->load->view('common/footer');
				
			}else{
				$data['details'] = [];
				$this->load->view('common/header');
				$this->load->view('admin/questions/add',$data);
				$this->load->view('common/footer');
			}
			
		
		}
	}
	public function deleteUser(){
		$this->user_model->delete_records('question_master',array('question_id'=>$_POST['question_id']));
		return true;
	}
	
}
