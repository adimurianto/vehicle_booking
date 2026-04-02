<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menuaccess_model extends CI_Model{

  var $table = 'admin_access';
  var $otoritasid = 'id_group';

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function addData($data){
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function getAdd($groupID){
    $this->db->where($this->otoritasid, $groupID);
    $table = $this->db->get($this->table);
    if($table->num_rows() > 0){
      foreach($table->result() as $t){
        $result[] = $t->adds;
      }
      return $result;
    }else{
      return $result = array('');
    }
  }
  public function getEdit($groupID){
    $this->db->where($this->otoritasid, $groupID);
    $table = $this->db->get($this->table);
    if($table->num_rows() > 0){
      foreach($table->result() as $t){
        $result[] = $t->edit;
      }
      return $result;
    }else{
      return $result = array('');
    }

  }

  public function getDelete($groupID){
    $this->db->where($this->otoritasid, $groupID);
    $table = $this->db->get($this->table);
    if($table->num_rows() > 0){
      foreach($table->result() as $t){
        $result[] = $t->deleted;
      }
      return $result;
    }else{
      return $result = array('');
    }
  }

  public function getById($groupID){
    $this->db->where($this->otoritasid, $groupID);
    $table = $this->db->get($this->table);
    if($table->num_rows() > 0){
      foreach($table->result() as $t){
        $result[] = $t->id_menu;
      }
      return $result;
    }else{
      return $result = array('');
    }
  }

  public function deleteData($groupID){
    $this->db->where($this->otoritasid, $groupID);
    $this->db->delete($this->table);
  }

  public function checkAuthority($authority,$menu){
    $this->db->join('admin_menu', 'admin_menu.id = admin_access.id_menu', 'left');
    $this->db->where('admin_access.id_group', $authority)->where('admin_menu.name', $menu);
    $query = $this->db->get($this->table);
    return ($query->num_rows() > 0 ? TRUE : FALSE);
  }

  public function getBtnMenu($menu,$authority){
    $this->db->join('admin_menu', 'admin_menu.id = admin_access.id_menu', 'left');
    $this->db->where('admin_access.id_group', $authority)->where('admin_menu.name', $menu);
    $query = $this->db->get($this->table);
    return $query;
  }

  public function getMenu($level,$authority){
    $this->db->join('admin_menu', 'admin_menu.id = admin_access.id_menu', 'left');
    $this->db->where('admin_menu.level',$level);
    $this->db->where('admin_access.id_group',$authority);
    $this->db->order_by('sort','ASC');
    $data = $this->db->get($this->table);
    return $data->result();
  }

  public function getMenuGroup($level,$authority){
    $this->db->join('admin_menu', 'admin_menu.id = admin_access.id_menu', 'left');
    $this->db->where('admin_menu.level',$level);
    $this->db->where('admin_access.id_group',$authority);
    $this->db->order_by('admin_menu.sort','ASC');
    $this->db->group_by('admin_menu.parent');
    $data = $this->db->get($this->table);
    return $data->result();
  }

}
