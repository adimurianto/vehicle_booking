<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable_model extends CI_Model{

  var $table;
  var $column;
  var $order;
  var $groupby = null;
  var $join = array();
  var $where = array();
  var $select = null;

  public function __construct()
  {
    parent::__construct();
    $this->search = '';
  }

  private function _get_datatables_query(){
    if($this->select != null){
      $this->db->select($this->select);
    }
    if($this->join && count((array)$this->join) > 0){
      foreach ($this->join as $jn) {
        $this->db->join($jn['table'], $jn['query'], $jn['method']);
      }
    }
    $this->db->from($this->table);
    if($this->join && count((array)$this->where ) > 0){
      foreach ($this->where as $wh) {
        $this->db->where($wh['column'],$wh['search']);
      }
    }
    if($this->groupby != null){
      $this->db->group_by($this->groupby);
    }
    $i = 0;

    if($_POST['search']['value']){
      $this->db->group_start();
      foreach ($this->column as $item){
        if($item != ''){
          ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
          $i++;  
        }
      }
      $this->db->group_end();
    }

    if(isset($_POST['order']))
    {
      $this->db->order_by($this->column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function get_datatables(){
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  public function count_filtered(){
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all(){
    if($this->select != null){
      $this->db->select($this->select);
    }
    $this->db->from($this->table);
    if($this->join && count((array)$this->join ) > 0){
      foreach ($this->join as $jn) {
        $this->db->join($jn['table'], $jn['query'], $jn['method']);
      }
    }
    if($this->join && count((array)$this->where ) > 0){
      foreach ($this->where as $wh) {
        $this->db->where($wh['column'],$wh['search']);
      }
    }
    return $this->db->count_all_results();
  }

  public function addTable($value){
    $this->table = $value;
  }

  public function addColumn($value){
    $this->column = $value;
  }

  public function addOrder($value){
    $this->order = $value;
  }

  public function pickColumn($value){
    $this->select = $value;
  }

  public function joinTable($value){
    $this->join = $value;
  }

  public function whereColumn($value){
    $this->where = $value;
  }

  public function groupColumn($value){
    $this->groupby = $value;
  }
}
