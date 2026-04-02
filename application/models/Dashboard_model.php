<?php
class Dashboard_model extends CI_Model {

    public function get_summary()
    {
        return [
            'total_booking' => $this->db->count_all('bookings'),

            'approved' => $this->db
                ->where('status', 'approved')
                ->count_all_results('bookings'),

            'rejected' => $this->db
                ->where('status', 'rejected')
                ->count_all_results('bookings'),

            'pending' => $this->db
                ->where('status', 'pending')
                ->count_all_results('bookings'),
        ];
    }

    public function get_summary_approver($user_id)
    {
        return [
            'total_booking' => $this->db->select('COUNT(*) as total')
                                        ->from('approvals')
                                        ->join('bookings', 'approvals.booking_id = bookings.id')
                                        ->where('approvals.approver_id', $user_id)
                                        ->count_all_results(),

            'approved' => $this->db->select('COUNT(*) as total')
                                        ->from('approvals')
                                        ->join('bookings', 'approvals.booking_id = bookings.id')
                                        ->where('approvals.approver_id', $user_id)
                                        ->where('approvals.status', 'approved')
                                        ->count_all_results(),    

            'rejected' => $this->db->select('COUNT(*) as total')
                                        ->from('approvals')
                                        ->join('bookings', 'approvals.booking_id = bookings.id')
                                        ->where('approvals.approver_id', $user_id)
                                        ->where('approvals.status', 'rejected')
                                        ->count_all_results(),     

            'pending' => $this->db->select('COUNT(*) as total')
                                        ->from('approvals')
                                        ->join('bookings', 'approvals.booking_id = bookings.id')
                                        ->where('approvals.approver_id', $user_id)
                                        ->where('approvals.status', 'pending')
                                        ->count_all_results(),    
        ];
    }

    public function get_chart_booking()
    {
        $this->db->select("MONTH(start_date) as month_num, COUNT(*) as total");
        $this->db->group_by("MONTH(start_date)");
        $this->db->order_by("month_num", "ASC");
        
        $results = $this->db->get('bookings')->result();
        
        // Convert month numbers to month names
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        foreach ($results as $result) {
            $result->month = $months[$result->month_num];
        }
        
        return $results;
    }

    public function get_chart_approver($user_id)
    {
        $this->db->select("MONTH(bookings.start_date) as month_num, COUNT(*) as total");
        $this->db->from('approvals');
        $this->db->join('bookings', 'approvals.booking_id = bookings.id');
        $this->db->group_by("MONTH(bookings.start_date)");  
        $this->db->order_by("month_num", "ASC");
        $this->db->where('approvals.approver_id', $user_id);
        
        $results = $this->db->get()->result();
        
        // Convert month numbers to month names
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        foreach ($results as $result) {
            $result->month = $months[$result->month_num];
        }
        
        return $results;
    }

    public function get_fuel_stats()
    {
        $this->db->select("SUM(liters) as total_fuel");
        return $this->db->get('fuel_logs')->row();
    }

    public function get_service_stats()
    {
        $this->db->select("COUNT(*) as total_service");
        return $this->db->get('service_logs')->row();
    }

    public function get_recent_logs()
    {
        return $this->db
            ->select('app_logs.*, admin_user.name as user_name') 
            ->from('app_logs')
            ->join('admin_user', 'app_logs.user_id = admin_user.id', 'left')      
            ->order_by('app_logs.created_at', 'DESC')
            ->limit(10)
            ->get()
            ->result();
    }
}