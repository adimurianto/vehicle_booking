<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
		
		if(!$this->check_login()){
			redirect('login');
		}
		
		$this->load->model('Dashboard_model', 'dashboard');
	}

	public function index()
	{
		$data['title'] = "";

		$data['sess_id'] = ($this->session->userdata('id_admin')) ? $this->session->userdata('id_admin') : '';
		$data['sess_name'] = ($this->session->userdata('name_admin')) ? $this->session->userdata('name_admin') : '';
		$data['sess_email'] = ($this->session->userdata('email_admin')) ? $this->session->userdata('email_admin') : '';
		$data['sess_image'] = ($this->session->userdata('image_admin')) ? $this->session->userdata('image_admin') : '';
		$data['sess_group'] = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';
		$data['role'] = ($this->session->userdata('role')) ? $this->session->userdata('role') : ''; 

		$summary = $data['role'] == 'Approver' ? $this->dashboard->get_summary_approver($data['sess_id']) : $this->dashboard->get_summary();
        $chart   = $data['role'] == 'Approver' ? $this->dashboard->get_chart_approver($data['sess_id']) : $this->dashboard->get_chart_booking();

        $months = [];
        $counts = [];

        foreach ($chart as $row) {
            $months[] = $row->month;
            $counts[] = $row->total;
        }

        $data['chart'] = [
            'total_booking' => $summary['total_booking'],
            'approved'      => $summary['approved'],
            'rejected'      => $summary['rejected'],
            'pending'       => $summary['pending'],
            'months'        => $months,
            'counts'        => $counts,
            'fuel'          => $this->dashboard->get_fuel_stats()->total_fuel ?? 0,
            'service'       => $this->dashboard->get_service_stats()->total_service ?? 0,
            'logs'          => $this->dashboard->get_recent_logs()
        ];
		
		$this->load->template('dashboard_view', $data);
	}
}
