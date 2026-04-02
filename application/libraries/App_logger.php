<?php
class App_logger {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function log($action)
    {
        $user_id = $this->CI->session->userdata('id_admin');

        $data = [
            'user_id'    => $user_id,
            'action'     => $action,
        ];

        $this->CI->db->insert('app_logs', $data);
    }
}