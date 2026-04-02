<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}

		if(!$this->checkMenu('Driver',$this->session->userdata('id_group_admin'))){
			redirect('dashboard');
		}
		
		$this->load->model('Datatable_model', 'datatable');
		$this->load->model('Drivers_model', 'drivers');
	}
	
	public function index()
	{
		$data['title'] = "Data Driver";
		$data['scripts'][] = 'assets/js/drivers.js';
		
		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';

		$data['btnAccess'] = $this->access->getBtnMenu('Driver',$this->session->userdata('id_group_admin'))->row();
		$this->load->template('drivers_view', $data);
	}

	public function addData(){
		$validate = $this->access->getBtnMenu('Driver',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->adds == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('drivers') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');	
			$status = $this->input->post('status');

			$data = array(
				'name' => $name,
				'phone' => $phone,
				'status' => $status	
			);

			$res = $this->drivers->addData($data);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function updateData(){
		$validate = $this->access->getBtnMenu('Driver',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->edit == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('drivers') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');	
			$status = $this->input->post('status');

			$data = array(
				'name' => $name,
				'phone' => $phone,
				'status' => $status	
			);

			$res = $this->drivers->updateData($data,$id);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Mengupdate Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Mengupdate Data'));
		}
	}

	public function getById(){
		$id = $this->input->post('id');
		$data = $this->drivers->getById($id)->row();

		echo json_encode($data);
	}

	public function deleteData(){
		$validate = $this->access->getBtnMenu('Driver',$this->session->userdata('id_group_admin'))->row();

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
			  $res = $this->drivers->deleteData($id);
			}
			echo ($res) ? json_encode(array('status' => TRUE, 'msg' => 'Berhasil Menghapus Data')) : json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}else{
			echo json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}
	}

	public function getData(){
		$validate = $this->access->getBtnMenu('Driver',$this->session->userdata('id_group_admin'))->row();

		$this->datatable->addTable('drivers');
		$this->datatable->addColumn(array('','name','phone','status'));
		$this->datatable->addOrder(array('id' => 'desc'));
	
		$list = $this->datatable->get_datatables();
		$data = array();

		foreach ($list as $l) {
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
		  $row[] = $l->phone;
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
