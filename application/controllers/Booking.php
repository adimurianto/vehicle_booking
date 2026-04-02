<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}

		if(!$this->checkMenu('Booking',$this->session->userdata('id_group_admin'))){
			redirect('dashboard');
		}
		
		$this->load->model('Datatable_model', 'datatable');
		$this->load->model('Booking_model', 'booking');
		$this->load->model('Vehicles_model', 'vehicle');
		$this->load->model('Drivers_model', 'driver');
		$this->load->model('Users_model', 'user');
		$this->load->model('Approval_model', 'approval');
	}
	
	public function index()
	{
		$data['title'] = "Data Booking";
		$data['scripts'][] = 'assets/js/booking.js';
		$data['scripts'][] = 'assets/js/vendor/xlsx.full.min.js';
		
		$data['vehicles'] = $this->vehicle->getData(['status' => 'available']);
		$data['drivers'] = $this->driver->getData(['status' => 1]);
		$data['approvers'] = $this->user->get_approvers();
		
		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';

		$data['btnAccess'] = $this->access->getBtnMenu('Booking',$this->session->userdata('id_group_admin'))->row();
		$this->load->template('booking_view', $data);
	}

	public function addData(){
		$validate = $this->access->getBtnMenu('Booking',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->adds == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('booking') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$vehicle_id = $this->input->post('vehicle_id');
			$driver_id = $this->input->post('driver_id');
			$requester_name = $this->input->post('requester_name');
			$purpose = $this->input->post('purpose');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$created_by = $this->session->userdata('id_admin');
			$approver1 = $this->input->post('approver1');
			$approver2 = $this->input->post('approver2');

			// check vehicle status
			if(!$this->booking->is_vehicle_available($vehicle_id, $start_date, $end_date)){
				echo json_encode(array('status' => FALSE, 'msg' => 'Vehicle Not Available'));
				exit;
			}

			// check driver status
			if(!$this->booking->is_driver_available($driver_id, $start_date, $end_date)){
				echo json_encode(array('status' => FALSE, 'msg' => 'Driver Not Available'));
				exit;
			}

			// check approver 1 and approver 2 not same
			if($approver1 == $approver2){
				echo json_encode(array('status' => FALSE, 'msg' => 'Approver 1 and Approver 2 Can Not Be Same'));
				exit;
			}

			$data = array(
				'vehicle_id' => $vehicle_id,
				'driver_id' => $driver_id,
				'requester_name' => $requester_name,
				'purpose' => $purpose,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'status' => 'pending',
				'created_by' => $created_by,
			);

			$res = $this->booking->addData($data);

			$approver1_data = array(
				'booking_id' => $res,
				'approver_id' => $approver1,
				'level' => 1,
				'status' => 'pending',
			);
			$this->approval->addData($approver1_data);

			$approver2_data = array(
				'booking_id' => $res,
				'approver_id' => $approver2,
				'level' => 2,
				'status' => 'pending',
			);
			$this->approval->addData($approver2_data);
			$this->app_logger->log('Create Booking Id : '.$res);
			
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Menambah Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Menambah Data'));
		}
	}

	public function updateData(){
		$validate = $this->access->getBtnMenu('Booking',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->edit == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		if($this->form_validation->run('booking') == FALSE){
			echo json_encode(array('status' => FALSE, 'msg' => validation_errors()));
		}else{
			$id = $this->input->post('id');
			$vehicle_id = $this->input->post('vehicle_id');
			$driver_id = $this->input->post('driver_id');
			$requester_name = $this->input->post('requester_name');
			$purpose = $this->input->post('purpose');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');

			// check vehicle status
			if(!$this->booking->is_vehicle_available($vehicle_id, $start_date, $end_date, $id)){
				echo json_encode(array('status' => FALSE, 'msg' => 'Vehicle Not Available'));
				exit;
			}
			
			// check driver status
			if(!$this->booking->is_driver_available($driver_id, $start_date, $end_date, $id)){
				echo json_encode(array('status' => FALSE, 'msg' => 'Driver Not Available'));
				exit;
			}

			$data = array(
				'vehicle_id' => $vehicle_id,
				'driver_id' => $driver_id,
				'requester_name' => $requester_name,
				'purpose' => $purpose,
				'start_date' => $start_date,
				'end_date' => $end_date,
			);

			$res = $this->booking->updateData($data,$id);
			$this->app_logger->log('Update Booking Id : '.$id);
			echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Mengupdate Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Mengupdate Data'));
		}
	}

	public function getById(){
		$id = $this->input->post('id');
		$data = $this->booking->getById($id)->row();

		$data->approver1 = $this->approval->getData(array('booking_id'=>$id, 'level'=>1))[0]->approver_id ?? 0;	
		$data->approver2 = $this->approval->getData(array('booking_id'=>$id, 'level'=>2))[0]->approver_id ?? 0;

		echo json_encode($data);
	}

	public function deleteData(){
		$validate = $this->access->getBtnMenu('Booking',$this->session->userdata('id_group_admin'))->row();

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
			  $res = $this->booking->deleteData($id);
				$this->app_logger->log('Delete Booking Id : '.$id);
			}
			echo ($res) ? json_encode(array('status' => TRUE, 'msg' => 'Berhasil Menghapus Data')) : json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}else{
			echo json_encode(array('status' => FALSE, 'msg' => 'Gagal Menghapus Data'));
		}
	}

	public function getData(){
		$validate = $this->access->getBtnMenu('Booking',$this->session->userdata('id_group_admin'))->row();

		$this->datatable->addTable('bookings');
        $this->datatable->pickColumn('bookings.id, bookings.requester_name, bookings.purpose, bookings.start_date, bookings.end_date, drivers.name as driver_name, vehicles.plate_number as vehicle_plate_number, bookings.status');
        $this->datatable->joinTable(array(
            array(
                'table' => 'vehicles',
                'query' => 'vehicles.id = bookings.vehicle_id',
                'method' => 'left'
            ),
			array(
                'table' => 'drivers',
                'query' => 'drivers.id = bookings.driver_id',
                'method' => 'left'
            ),
		));
		
		$this->datatable->addColumn(array('','bookings.requester_name','bookings.purpose','bookings.start_date','bookings.end_date','drivers.name','vehicles.plate_number','bookings.status'));

		$this->datatable->addOrder(array('bookings.id' => 'desc'));
	
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

			$row[] = "<td style='vertical-align:middle;'>#".str_pad($l->id, 5, '0', STR_PAD_LEFT)."</td>";
			$row[] = "<td style='vertical-align:middle;'>".$l->requester_name."</td>";
			$row[] = $l->purpose;
			$row[] = date('d-m-Y', strtotime($l->start_date));
			$row[] = date('d-m-Y', strtotime($l->end_date));
			$row[] = $l->driver_name;
			$row[] = $l->vehicle_plate_number;
			$row[] = ($l->status == 'approved' ? '<span class="badge badge-success">Approved</span>' : ($l->status == 'rejected' ? '<span class="badge badge-danger">Rejected</span>' : '<span class="badge badge-info">Pending</span>'));

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
