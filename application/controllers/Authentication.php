<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
		
		$this->load->model('Users_model', 'users');
	}

	public function index()
	{
		if($this->check_login()){
			redirect(base_url());
		}else{
			$this->load->view('authentication_view');
		}
	}

	public function loginProcess(){
		if($this->form_validation->run('admin_login') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$email = $this->input->post('login_email');
			$password = $this->input->post('login_password');

			$res = $this->users->loginUser($email,$password)->row();
			if(count((array)$res) > 0){
				if($res->status == '0'){
					echo json_encode(array('status' => FALSE, 'msg' => 'Akun Anda telah dinonaktifkan'));
				  }else{
					$session = array(
					  'id_admin' => $res->id,
					  'name_admin' => $res->name,
					  'email_admin' => $res->email,
					  'image_admin' => "1.png",
					  'id_group_admin' => $res->id_group,
					  'role' => $res->group_name,
					  'am_i_login' => 'yes_i_am_admin'
					);
					$this->session->set_userdata($session);
	  
					echo json_encode(array('status' => TRUE, 'msg' => base_url()));
				  }
			}else{
			  echo json_encode(array('status' => FALSE, 'msg' => 'Email/password Anda tidak ditemukan'));
			}
		}
	}

	public function updateAccount(){
		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}

		if($this->form_validation->run('users_update') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$id = $this->input->post('id_account');
			$name = $this->input->post('name_account');
			$phonenumber = $this->input->post('phonenumber_account');
			$gender = $this->input->post('gender_account');
			$address = $this->input->post('address_account');

			$data = array(
				'name' => $name,
				'phonenumber' => $phonenumber,
				'gender' => $gender,
				'address' => $address
			);

			$res = $this->users->updateData($data,$id);
			$data = $this->users->getById($id)->row();

			$session = array('name_admin' => $data->name);
			$this->session->set_userdata($session);

			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Mengubah Akun', 'account' => $data)) : json_encode(array('status' => false, 'msg' => 'Gagal Mengubah Akun', 'account' => $data));
		}
	}

	public function getAccount(){
		$id = $this->session->userdata('id_admin');
		$data = $this->users->getById($id)->row();

		echo json_encode($data);
	}

	public function logout(){
		$this->session->sess_destroy();
		echo json_encode(array('status' => true, 'msg' => base_url()));
	}
}
