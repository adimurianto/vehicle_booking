<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}

		if(!$this->checkMenu('Menu',$this->session->userdata('id_group_admin'))){
			redirect('admin');
		}
		
		$this->load->model('Datatable_model', 'datatable');
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = "Data Menu";
		$data['scripts'][] = 'assets/js/menu.js';;

		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';

		$data['btnAccess'] = $this->access->getBtnMenu('Menu',$this->session->userdata('id_group_admin'))->row();
		$this->load->template('menu_view', $data);
	}

	public function addData(){
		$validate = $this->access->getBtnMenu('Menu',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->adds == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('admin_menu') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$name = $this->input->post('name');
			$icon = $this->input->post('icon');
			$url = $this->input->post('url');
			$sort = $this->input->post('sort');
			$level = $this->input->post('level');
			$submenu = ($level != '1') ? $this->input->post('menu_sub') : '';
			$status = $this->input->post('status');

			$this->_checksort($sort,$level,$submenu);

			$data = array(
				'name' => $name,
				'url' => $url,
				'icon' => $icon,
				'level' => $level,
				'sort' => $sort,
				'parent' => $submenu,
				'status' => $status
			);

			$res = $this->menu->addData($data);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function updateData(){
		$validate = $this->access->getBtnMenu('Menu',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->edit == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('admin_menu') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$icon = $this->input->post('icon');
			$url = $this->input->post('url');
			$sort = $this->input->post('sort');
			$level = $this->input->post('level');
			$submenu = ($level != '1') ? $this->input->post('menu_sub') : '';
			$status = $this->input->post('status');

			$this->_checksort($sort,$level,$submenu);

			$data = array(
				'name' => $name,
				'url' => $url,
				'icon' => $icon,
				'level' => $level,
				'sort' => $sort,
				'parent' => $submenu,
				'status' => $status
			);

			$res = $this->menu->updateData($data,$id);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function getById(){
		$id = $this->input->post('id');
		$data = $this->menu->getById($id)->row();

		echo json_encode($data);
	}

	public function deleteData(){
		$validate = $this->access->getBtnMenu('Menu',$this->session->userdata('id_group_admin'))->row();

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
			  $res = $this->menu->deleteData($id);
			}
			echo ($res) ? json_encode(array('status' => TRUE, 'msg' => 'Berhasil Menghapus Data')) : json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}else{
			echo json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}
	}

	public function getSubMenu(){
		// if(!$this->check_login()){
		//   echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		//   exit;
		// }

		$level = $this->input->post('level');
		$data = $this->menu->getbylevel($level)->result();
		echo json_encode(array('status' => true, 'data' => $data));
	}
	
	public function getCurrentSort(){
		// if(!$this->check_login()){
		//   echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		//   exit;
		// }
	
		$id = $this->input->post('id');
		$level = $this->input->post('level');
		$data = $this->menu->getCurrentSort($id,$level)->row();
		if($data){
		  $sort = $data->sort+1;
		}else{
		  $sort = 1;
		}
		echo json_encode(array('status' => true, 'sort' => $sort));
	}

	public function _checksort($sort=0,$level='1',$id=''){
		$data = $this->menu->getbysort($sort,$id,$level)->row();
		if($data){
		  $idmenu = $data->id;
		  $current_sort = $this->menu->getCurrentSort($id,$level)->row();
	
		  if($current_sort){
			$last_sort = $current_sort->sort+1;
		  }else{
			$last_sort = 1;
		  }
	
		  $update_sort = array('sort' => $last_sort);
		  $this->db->where('id',$idmenu);
		  $res = $this->db->update('admin_menu',$update_sort);
		  return $res;
		}else{
		  return true;
		}
	  }
	

	public function getData(){
		$validate = $this->access->getBtnMenu('Menu',$this->session->userdata('id_group_admin'))->row();

		$this->datatable->addTable('admin_menu');
		$this->datatable->addColumn(array('','name','icon','url','level','status',''));
		$this->datatable->addOrder(array('id' => 'desc'));
	
		$list = $this->datatable->get_datatables();
		$data = array();

		foreach ($list as $l) {
		  $row = array();

		  if($validate && $validate->deleted != 0){
			$row[] = '<div class="checkbox-wrap">
						<label for="delete-data-'.$l->id.'" >
						<input type="checkbox" id="delete-data-'.$l->id.'" class="delete-data" name="deleted[]" value="'.$l->id.'">
						</label>                          
					</div>';
		  }else{
			$row[] = '<center>-</center>';
		  }

		  $row[] = "<td style='vertical-align:middle;'>".$l->name."</td>";
		  $row[] = "<i class='$l->icon'></i>";
		  $row[] = $l->url;
		  $row[] = ($l->level == 1) ? '<span class="badge badge-primary">Main Menu</span>' : '<span class="badge badge-warning">Sub Menu</span>';
		  $row[] = ($l->status == 1) ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Nonaktif</span>';

		  if($validate && $validate->edit != 0){
			$row[] = '<button class="btn btn-primary btn-update" data-id="'.$l->id.'" style="width:50px; height:auto;">
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
