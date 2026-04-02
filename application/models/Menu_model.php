<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model{

  var $table = 'admin_menu';
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

  public function getbylevel($level){
    $this->db->where('level',$level);
    $this->db->where('status',1);
    $data = $this->db->get($this->table);
    return $data;
  }

  public function getbysort($sort,$id='',$level=''){
    $this->db->where('sort',$sort);
    if($id != ''){
      $this->db->where('parent',$id);
    }else{
      $this->db->where('level',$level);
    }
    $data = $this->db->get($this->table);
    return $data;
  }

  public function getCurrentSort($id='',$level=''){
    $this->db->select('admin_menu.sort');
    $this->db->from($this->table);
    if($id != ''){
      $this->db->where('parent',$id);
    }else{
      $this->db->where('level',$level);
    }
    $this->db->order_by('admin_menu.sort','DESC');
    $this->db->limit(1);
    $data = $this->db->get();
    return $data;
  }
  
}
