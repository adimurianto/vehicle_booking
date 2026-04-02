<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_access extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Menu_model', 'menu');
    $this->load->model('Menuaccess_model', 'menu_access');
    // if(!$this->check_login()){
    //   redirect('login');
    // }
  }

  function index(){
    $otoritas = $this->input->post('otoritas');
    $data['main_menu'] = $this->menu->getbylevel('1')->result();
    $data['second_menu'] = $this->menu->getbylevel('2')->result();
    $data['third_menu'] = $this->menu->getbylevel('3')->result();
    $data['addBtn'] = $this->menu_access->getAdd($otoritas);
    $data['editBtn'] = $this->menu_access->getEdit($otoritas);
    $data['deleteBtn'] = $this->menu_access->getDelete($otoritas);
    $data['getArray'] = $this->menu_access->getById($otoritas);
    $this->load->view('async/menuaccess_view',$data);
  }

  public function updateMenuAccess(){
    // if(!$this->check_login()){
    //   echo json_encode(array('status' => false, 'msg' => 'You must log in to continue'));
    //   exit;
    // }
    $groupID    = $this->input->post('authority');
    $chkMenuID  = $this->input->post('chkMenuID');
    $chkAddBtn	= $this->input->post('chkAddBtn');
    $chkEditBtn	= $this->input->post('chkEditBtn');
    $chkDeleteBtn	= $this->input->post('chkDeleteBtn');

    $this->menu_access->deleteData($groupID);
    if(isset($chkMenuID)){
    foreach ($chkMenuID as $key => $value){
      if(isset($chkAddBtn[$key]) && $chkAddBtn[$key] != $value){
      array_unshift($chkAddBtn, 0);
      }
      if(isset($chkEditBtn[$key]) && $chkEditBtn[$key] != $value){
      array_unshift($chkEditBtn, 0);
      }
      if(isset($chkDeleteBtn[$key]) && $chkDeleteBtn[$key] != $value){
      array_unshift($chkDeleteBtn, 0);
      }
      $data = array(
              'id_group' => $groupID,
              'id_menu' => $value,
              'adds' => isset($chkAddBtn[$key]) && $chkAddBtn[$key] == $value ? $chkAddBtn[$key] : null,
              'edit' => isset($chkEditBtn[$key]) && $chkEditBtn[$key] == $value ? $chkEditBtn[$key] : null,
              'deleted' => isset($chkDeleteBtn[$key]) && $chkDeleteBtn[$key] == $value ? $chkDeleteBtn[$key] : null,
            );
            $this->menu_access->addData($data);
    }

      echo json_encode(array("status" => TRUE, 'msg' => 'Berhasil Merubah Akses Menu'));
    }else if(!isset($chkMenuID) && !isset($chkAddBtn) && !isset($chkEditBtn) && !isset($chkDeleteBtn)){
      echo json_encode(array("status" => TRUE, 'msg' => 'Berhasil Merubah Akses Menu'));
    }else{
      echo json_encode(array("status" => FALSE, 'msg' => 'Pilih View Yang Telah Diberi Akses!'));
    }
  }
}
