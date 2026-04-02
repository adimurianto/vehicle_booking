<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}

		if(!$this->checkMenu('Approval',$this->session->userdata('id_group_admin'))){
			redirect('dashboard');
		}
		
		$this->load->model('Datatable_model', 'datatable');
		$this->load->model('Approval_model', 'approval');
		$this->load->model('Booking_model', 'booking');
	}
	
	public function index()
	{
		$data['title'] = "Data Approval";
		$data['scripts'][] = 'assets/js/approval.js';
		
		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';
		$data['sess_role'] = ($this->session->userdata('role')) ? $this->session->userdata('role') : '';

		$data['btnAccess'] = $this->access->getBtnMenu('Approval',$this->session->userdata('id_group_admin'))->row();
		$this->load->template('approval_view', $data);
	}

	public function processData(){
		$validate = $this->access->getBtnMenu('Approval',$this->session->userdata('id_group_admin'))->row();

		if(!$this->check_login()){
		  echo json_encode(array('status' => false, 'msg' => 'Login To Continue'));
		  exit;
		}
	
		if(!$validate || $validate->edit == 0){
		  echo json_encode(array('status' => false, 'msg' => 'Sorry Permission Denied!'));
		  exit;
		}

		$id = $this->input->post('id');
		$status = $this->input->post('approve') == 'yes' ? "approved" : "rejected";

		$data = array(
			'status' => $status,
			'approved_at' => date('Y-m-d H:i:s'),
		);
		$res = $this->approval->updateData($data,$id);
		$this->app_logger->log('Update Approval Id : '.$id);
		
		$get = $this->approval->getById($id)->row();
		if($get){
			$getApproval = $this->approval->getData(['booking_id'=>$get->booking_id]);

			$changeApprove = 1;	
			foreach ($getApproval as $approval) {
				if($approval->status == 'pending' || $approval->status == 'rejected'){
					$changeApprove = 0;
				}
			}
			
			if($changeApprove == 1){
				$approvalData = array(
					'status' => $status,
				);
				$this->booking->updateData($approvalData, $get->booking_id);
			}else{
				if($status == 'rejected'){
					$approvalData = array(
						'status' => $status,
					);
					$this->booking->updateData($approvalData, $get->booking_id);
				}
			}
		}

		echo ($res) ? json_encode(array('status' => true, 'msg' => 'Berhasil Mengupdate Data')) : json_encode(array('status' => false, 'msg' => 'Gagal Mengupdate Data'));
	}

	public function getById(){
		$id = $this->input->post('id');
		$data = $this->approval->getById($id)->row();

		echo json_encode($data);
	}

	public function getData(){
		$validate = $this->access->getBtnMenu('Approval',$this->session->userdata('id_group_admin'))->row();

		$this->datatable->addTable('approvals');
        $this->datatable->pickColumn('approvals.id, approvals.status, approvals.booking_id, bookings.requester_name, bookings.purpose, bookings.start_date, bookings.end_date, drivers.name as driver_name, vehicles.plate_number as vehicle_plate_number, admin_user.name as approver_name');
        $this->datatable->joinTable(array(
            array(
                'table' => 'bookings',
                'query' => 'bookings.id = approvals.booking_id',	
                'method' => 'left'
            ),
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
			array(
                'table' => 'admin_user',
                'query' => 'admin_user.id = approvals.approver_id',
                'method' => 'left'
            ),
		));
		
		if($this->session->userdata('role') == 'Approver'){
			$this->datatable->addColumn(array('','approvals.booking_id','bookings.requester_name','bookings.purpose','bookings.start_date','bookings.end_date','drivers.name','vehicles.plate_number','approvals.status'));
			$this->datatable->whereColumn(
				array(
					array(
						'column' => 'approvals.approver_id',
						'search' => $this->session->userdata('id_admin'),
					),
				)
			);
		}else{
			$this->datatable->addColumn(array('','approvals.booking_id','bookings.requester_name','bookings.purpose','bookings.start_date','bookings.end_date','drivers.name','vehicles.plate_number','approvals.status','admin_user.name'));
		}

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

			$row[] = "<td style='vertical-align:middle;'>#".str_pad($l->booking_id, 5, '0', STR_PAD_LEFT)."</td>";
			$row[] = "<td style='vertical-align:middle;'>".$l->requester_name."</td>";
			$row[] = $l->purpose;
			$row[] = date('d-m-Y', strtotime($l->start_date));
			$row[] = date('d-m-Y', strtotime($l->end_date));
			$row[] = $l->driver_name;
			$row[] = $l->vehicle_plate_number;
			$row[] = ($l->status == 'approved' ? '<span class="badge badge-success">Approved</span>' : ($l->status == 'rejected' ? '<span class="badge badge-danger">Rejected</span>' : '<span class="badge badge-info">Pending</span>'));

			if($this->session->userdata('role') == 'Approver'){
				if($validate && $validate->edit != 0 && $l->status == 'pending'){
					$row[] = '<button class="btn btn-success btn-process-data" data-id="'.$l->id.'" data-approve="yes">
								<i class="fa fa-check"></i>
							</button>
							<button class="btn btn-danger btn-process-data" data-id="'.$l->id.'" data-approve="no">
								<i class="fa fa-times"></i>	
							</button>';
				}else{
					$row[] = '-';
				}
			}else{
				$row[] = $l->approver_name;
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
