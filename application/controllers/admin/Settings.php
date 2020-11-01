<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $configs = GeneralConfig::where('editable', 'Y')->get();
      foreach ($configs as $key => $config) {
        $this->form_validation->set_rules($config->field, $config->title, 'trim|required');
      }
      
      $this->form_validation->set_message('required', '%s field is required.');

      if ($this->form_validation->run() == FALSE)
      {
        if($this->input->post('isAjax') && $this->input->post('isAjax') == '1') {
          $output = array('status' => 'error', 'message' => validation_errors());
          echo json_encode($output);
        } else {
          $data = array();
          $data['form_error'] = validation_errors();
          $data['configs'] = GeneralConfig::where('editable', 'Y')->get();
          $this->renderView('admin/settings/index', $data);
        }
      } else {
        foreach ($configs as $key => $config) {
          $config->value = $this->input->post($config->field);
          $config->save();
        }

        if($this->input->post('isAjax') && $this->input->post('isAjax') == '1') {
          $output = array('status' => 'success', 'message' => 'Settings successfully saved.');
          echo json_encode($output);
        } else {
          $data = array();
          $data['success_message'] = 'Settings successfully saved.';
          $data['configs'] = GeneralConfig::where('editable', 'Y')->get();
          $this->renderView('admin/settings/index', $data);
        }
      }
    } else {
      $data = array();
      $data['configs'] = GeneralConfig::where('editable', 'Y')->get();
      $this->renderView('admin/settings/index', $data);
    }
  }



  public function change(){

    $user_id = $this->session->user_id;
    $response = $this->user_model->get_where('user_master', array('user_id' => $user_id), 'user_id ASC','row');

    if (password_verify($_POST['cur_password'], $response['password'])) {
      $result = array("status" => TRUE, 'message' => 'Success');
    }else{
      $result = array("status" => FALSE, 'message' => 'Incorrect Current Password.');
    }
    echo json_encode($result);
    exit;
  }
  public function changepassword(){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user_id = $this->session->user_id;
      // echo $user_id;
      // echo '<pre>';print_r($_POST);
      $response = $this->user_model->get_where('user_master', array('user_id' => $user_id), 'user_id ASC','row');

      if (password_verify($_POST['cur_password'], $response['password'])) {
        $userData['password'] = password_hash($_POST['cur_password'],PASSWORD_DEFAULT);
        $this->user_model->update("user_master",$userData,array('user_id'=>$user_id));
        $this->session->set_flashdata('message', 'Password Changed Successfully.', 'SUCCESS');
        // echo '<pre>';print_r($_POST);
        //$result = array("status" => TRUE, 'message' => 'Success');
        redirect('admin/settings/password');
      }else{
        $this->session->set_flashdata('error_message', 'Incorrect Current Password.', 'SUCCESS');
        //echo '<pre>';print_r($_POST);
      }
    }else{
      redirect('admin/settings/password');
    }
    exit;
  }
  

  public function password()
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_password_check');
      $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
      $this->form_validation->set_message('required', '%s field is required.');
      $this->form_validation->set_message('matches', 'Passwords doesn\'t match.');
      if ($this->form_validation->run() == FALSE)
      {
        if($this->input->post('isAjax') && $this->input->post('isAjax') == '1') {
          $output = array('status' => 'error', 'message' => validation_errors());
          echo json_encode($output);
        } else {
          $data = array();
          $data['form_error'] = validation_errors();
          $this->renderView('admin/settings/password', $data);
        }
      } else {
        $password = $this->input->post('new_password');
        // creating password hash
        $options = [
            'cost' => 12,
        ];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);

        $admin = Admin::find($this->session->userdata('memberId'));
        $admin->password = $passwordHash;
        $admin->save();

        if($this->input->post('isAjax') && $this->input->post('isAjax') == '1') {
          $output = array('status' => 'success', 'message' => 'Password successfully changed.');
          echo json_encode($output);
        } else {
          $data = array();
          $data['success_message'] = 'Password successfully changed.';
          $this->renderView('admin/settings/password', $data);
        }
      }
    } else {
      $data = array();
      $this->load->view('common/header');
      $this->load->view('admin/settings/password',$data);
      $this->load->view('common/footer');
    }
  }

  public function password_check($password)
  {
    $admin = Admin::where('id', $this->session->userdata('memberId'))->first();
    if($admin) {
      if (password_verify($password, $admin->password)) {
        return TRUE;
      } else {
        $this->form_validation->set_message('password_check', '{field} is invalid.');
        return FALSE;
      }
    } else {
      $this->form_validation->set_message('password_check', '{field} is invalid.');
      return FALSE;
    }
  }

  public function emails(){
   $data = array();
   $data['records'] = GeneralEmail::where('status', 'Y')->get();
      $this->renderView('admin/settings/email_list', $data); 
  }

  
  public function delete($id = '') 
  {
    if($id != '') {
      GeneralEmail::where('id', $id)->delete();
      $this->session->set_flashdata('toast', 'Email removed successfully.');
      echo "Email removed successfully.";
    } else {
      $records = $this->input->post('records');
      foreach ($records as $id) {
        GeneralEmail::where('id', $id)->delete();
      }
      $this->session->set_flashdata('toast', 'Email removed successfully.');
      echo "Email removed successfully.";
    }
  }

   public function edit($id)
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
     
        $model = GeneralEmail::find($id);
        $model->email_title = $this->input->post('email_title');
        $model->email_template = $this->input->post('email_template');
        $model->email_subject = $this->input->post('email_subject');
        $model->save(); 
        
        if($this->input->post('isAjax') && $this->input->post('isAjax') == '1') {
          $output = array('status' => 'success', 'message' => 'Email details saved successfully.');
          echo json_encode($output);
        } else {
          $data = array();
          $data['record'] = $model;
          $data['mail_id']=$id;
          $data['success_message'] = 'Email details saved successfully.';
          $this->renderView('admin/settings/edit', $data);
        }
    } else {
      $data['record'] = GeneralEmail::where('id','=',$id)->first();
      $data['mail_id'] = $id;
      $this->renderView('admin/settings/edit', $data);
    }
  }
}
