<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

  var $table = 'admin_user';
  var $primary = 'id';

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function addData($data){
    $res = $this->db->insert($this->table,$data);
    return $res;
  }

  public function updateData($data,$id){
    $this->db->where($this->primary,$id);
    $res = $this->db->update($this->table,$data);
    return $res;
  }

  public function getById($id){
    $this->db->where($this->primary,$id);
    $data = $this->db->get($this->table);
    return $data;
  }

  public function deleteData($id){
    $this->db->where($this->primary,$id);
    $res = $this->db->delete($this->table);
    return $res;
  }

  public function getbyEmail($email){
    $this->db->where('email',$email);
    $data = $this->db->get($this->table);
    return $data;
  }

  public function loginUser($email,$pass){
    $this->db->select('admin_user.*,admin_group.name as group_name');
    $this->db->from($this->table);
    $this->db->where('admin_user.email',$email);
    $this->db->where('admin_user.password',sha1(md5($pass)));
    $this->db->join('admin_group','admin_group.id = admin_user.id_group');
    $data = $this->db->get();
    return $data;
  }

  public function get_approvers() {
    $this->db->select('admin_user.*,admin_group.name as group_name');
    $this->db->from($this->table);
    $this->db->where('admin_group.name', 'Approver');
    $this->db->where('admin_user.status', 1);
    $this->db->join('admin_group','admin_group.id = admin_user.id_group');
    $data = $this->db->get();
    return $data->result();
  }
  
  public function get_user_by_id($id) {
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    return $query->row();
  }
  
}
