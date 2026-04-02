<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model{

  var $table = 'approvals';
  var $primary = 'id';

  public function __construct()
  {
    parent::__construct();
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

  public function getData($where = array()){
    if($where){
      $this->db->where($where);
    }
    return $this->db->get($this->table)->result();
  }
}
