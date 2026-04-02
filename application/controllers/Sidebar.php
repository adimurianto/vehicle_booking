<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Menuaccess_model', 'menu_access');
  }

  function index(){
    $authority = ($this->session->userdata('id_group_admin')) ? $this->session->userdata('id_group_admin') : '';
    $currentMenu = $this->input->post('current_menu');

    $data['main_menu'] = $this->menu_access->getMenu('1',$authority);
    $data['second_menu'] = $this->menu_access->getMenu('2',$authority);
    $data['current_menu'] = $currentMenu;

    $largesidebar = $this->load->view('async/sidebar_view',$data, TRUE);
    $smallsidebar = $this->load->view('async/sidebar_small_view',$data, TRUE);

    $output = array(
      'large_sidebar' => $largesidebar,
      'small_sidebar' => $smallsidebar
    );

    echo json_encode($output);
  }

}
