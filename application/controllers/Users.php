<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}

		if(!$this->checkMenu('User',$this->session->userdata('id_group_admin'))){
			redirect('admin');
		}
		
		$this->load->model('Datatable_model', 'datatable');
		$this->load->model('Users_model', 'users');
		$this->load->model('Group_model','group');
	}
	
	public function index()
	{
		$data['title'] = "Data Admin";
		$data['scripts'][] = 'assets/js/users.js';

		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';
		$data['sess_role'] = ($this->session->userdata('role')) ? $this->session->userdata('role') : '';
		
		$data['group'] = $data['sess_role'] == 'Developer' ? $this->group->getData(array('status'=>1)) : $this->group->getData(array('status'=>1, 'name !='=>'Developer'));	

		$data['btnAccess'] = $this->access->getBtnMenu('User',$this->session->userdata('id_group_admin'))->row();
		$this->load->template('users_view', $data);
	}

	public function addData(){
		$validate = $this->access->getBtnMenu('User',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->adds == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('admin_users') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phonenumber = $this->input->post('phonenumber');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$password = $this->input->post('password');
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$data = array(
				'name' => $name,
				'email' => $email,
				'phonenumber' => $phonenumber,
				'gender' => $gender,
				'address' => $address,
				'password' => sha1(md5($password)),
				'id_group' => $level,
				'status' => $status
			);

			$res = $this->users->addData($data);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function updateData(){
		$validate = $this->access->getBtnMenu('User',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->edit == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('admin_users') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$phonenumber = $this->input->post('phonenumber');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$password = $this->input->post('password');
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$data = array(
				'name' => $name,
				'phonenumber' => $phonenumber,
				'gender' => $gender,
				'address' => $address,
				'id_group' => $level,
				'status' => $status
			);

			if($password != ""){
				$data['password'] = sha1(md5($password));
			}

			$res = $this->users->updateData($data,$id);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function getById(){
		$id = $this->input->post('id');
		$data = $this->users->getById($id)->row();

		echo json_encode($data);
	}

	public function deleteData(){
		$validate = $this->access->getBtnMenu('User',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->deleted == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if(!empty($_POST['deleted'])){
			foreach ($_POST['deleted'] as $id) {
			  $res = $this->users->deleteData($id);
			}
			echo ($res) ? json_encode(array('status' => TRUE, 'msg' => 'Berhasil Menghapus Data')) : json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}else{
			echo json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}
	}

	public function getData(){
		$validate = $this->access->getBtnMenu('User',$this->session->userdata('id_group_admin'))->row();

		$this->datatable->addTable('admin_user');
		$this->datatable->pickColumn('admin_user.id, admin_user.name, admin_user.email, admin_user.status, admin_group.name as group_name, admin_user.id_group');
        $this->datatable->joinTable(array(
            array(
                'table' => 'admin_group',
                'query' => 'admin_group.id = admin_user.id_group',
                'method' => 'left'
            ),
		));
		$this->datatable->addColumn(array('','admin_user.name','admin_user.email','admin_group.name','admin_user.status'));

		$this->datatable->addOrder(array('admin_user.id' => 'desc'));
		$list = $this->datatable->get_datatables();
		$data = array();

		foreach ($list as $l) {
			if($l->group_name == "Developer" && $this->session->userdata('role') !== 'Developer'){
				continue;
			}
			$row = array();

			if($validate && $validate->deleted != 0){
				$row[] = '<div class="checkbox-wrap">
							<label for="delete-data-'.$l->id.'">
							<input type="checkbox" id="delete-data-'.$l->id.'" class="delete-data" name="deleted[]" value="'.$l->id.'">
							</label>                          
						</div>';
			}else{
				$row[] = '<center>-</center>';
			}

			$row[] = "<td style='vertical-align:middle;'>".$l->name."</td>";
			$row[] = $l->email;
			$row[] = $l->group_name;
			$row[] = ($l->status == 1) ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>';

			if($validate && $validate->edit != 0){
				$row[] = '<button class="btn btn-primary btn-update" data-id="'.$l->id.'">
							<i class="fa fa-pencil-square-o"></i>
						</button>';
			}else{
				$row[] = '-';
			}
		
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->datatable->count_all(),
				"recordsFiltered" => $this->datatable->count_filtered(),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	  }
}
