<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons extends CI_Controller {

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
		
			
		$data['key']	=	(!$this->input->post('key') ? ($this->input->get('key') ? $this->input->get('key') :''):$this->input->post('key'));
		$data['status']	=	(!$this->input->post('status') ? ($this->input->get('status') ? $this->input->get('status') :''):$this->input->post('status'));
		$data['limit']	=	(!$this->input->post('limit') ? ($this->input->get('limit') ? $this->input->get('limit') :$data['page_limit']):$this->input->post('limit'));
		
		
		$config['per_page'] = $data['limit'] == 'all' ? $config['total_rows'] : $data['limit'];
		$_REQUEST['per_page'] = isset($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 0;
		$data['status'] = $data['status']?$data['status']:'Y';
		
		$config["total_rows"] = $this->user_model->getLessonListsCount($data['key']);	
		$data['users'] = $this->user_model->getLessonLists($_REQUEST['per_page'],$data['limit'],$data['key']);
	
		$params = '?t=1';
		if($data['limit']!='') $params .= '&limit='.$data['limit'];
		if($data['key']!='') $params .= '&key='.$data['key'];
		if($data['status']!='') $params .= '&status='.$data['status'];
	
		
		$config['base_url'] = site_url("admin/lessons/index")."/".$params;
		
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
		$this->load->view('admin/lessons/index',$data);
		$this->load->view('common/footer');
	}
	public function deleteUser(){
		$this->user_model->delete_records('lesson_master',array('lesson_id'=>$_POST['lesson_id']));
		return true;
	}
	public function changeStatus(){

		$insertid = $this->user_model->update("lesson_master",array('status'=>$_POST['status']),array('lesson_id'=>$_POST['lesson_id']));
		return true;
	}
	public function add($lesson_id='')
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){	
			
			
				$arr = explode('?v=',$_POST['video_url']);
				$arr2 = explode('&',$arr[1]);

				$video_image = 'https://img.youtube.com/vi/'.$arr2[0].'/0.jpg';
				$userData = array("title"=>$_POST['title'],
					"video_image"=>$video_image,
					"video_url"=>$_POST['video_url'],
					"description"=>$_POST['description'],
					"created_at"=>date('Y-m-d H:i:s')
				);

				if ($_FILES['pdfFile']['name'] <> "") {
					$upload_dir = FCPATH . "uploads/";
					if (!is_dir($upload_dir)) {
						mkdir($upload_dir, 0777);
					}
					$name = explode(".", $_FILES['pdfFile']['name']);
					$image = $name[0] . '_tmp.' . $name[1];
					move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $upload_dir . $image);
					$userData['lesson_pdf_url'] = base_url()."uploads/".$image;
					
				}

			
			if($_POST['lesson_id'] !=''){
				$this->user_model->update("lesson_master",$userData,array('lesson_id'=>$_POST['lesson_id']));
			}else{
				$insertid = $this->user_model->insert("lesson_master",$userData);
			}

			redirect('admin/lessons');
	
		}else{

			if($lesson_id!=''){
				$data['details'] = $this->user_model->getLessonDetailsByID($lesson_id);

				$arr = explode('?v=',$data['details']['video_url']);
				$arr2 = explode('&',$arr[1]);

				$youtube_id = 'https://www.youtube.com/embed/'.$arr2[0];
				$data['details']['embeded_url'] = $youtube_id;

				//$data['details']['embeded_url']=$this->getYoutubeEmbedUrl($data['details']['video_url']);


				//echo '<pre>';print_r($data);exit;
				$this->load->view('common/header');
				$this->load->view('admin/lessons/add',$data);
				$this->load->view('common/footer');
				
			}else{
				$data['details'] = [];
				$this->load->view('common/header');
				$this->load->view('admin/lessons/add',$data);
				$this->load->view('common/footer');
				//redirect('admin/lessons');
			}
			
		
		}
	}

	function getYoutubeEmbedUrl($url)
    {
		$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
		$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

		if (preg_match($longUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}

		if (preg_match($shortUrlRegex, $url, $matches)) {
			$youtube_id = $matches[count($matches) - 1];
		}
		return 'https://www.youtube.com/embed/' . $youtube_id ;
    }


	
}
