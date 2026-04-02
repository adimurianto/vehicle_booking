<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model{

  var $table = 'admin_group';
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
    $this->db->trans_start();
      $this->db->where($this->primary,$id);
      $this->db->delete($this->table);
      
      $this->db->where('id_group',$id);
      $this->db->delete('admin_access');
    $this->db->trans_complete();
    return $this->db->trans_status();
  }  

  public function getAllGroupActive(){
    $this->db->where('status',1);
    $res = $this->db->get($this->table);
    return $res;
  }

  public function getData($where = array()){
    if($where){
      $this->db->where($where);
    }
    return $this->db->get($this->table)->result();
  }
}
