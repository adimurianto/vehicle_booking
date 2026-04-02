<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{

  var $table = 'bookings';
  var $primary = 'id';

  public function __construct()
  {
    parent::__construct();
  }

  public function addData($data){
    $this->db->insert($this->table,$data);
		return $this->db->insert_id();
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

  public function is_vehicle_available($vehicle_id, $start_date, $end_date, $exclude_id = null)
  {
      $this->db->where('vehicle_id', $vehicle_id);
      $this->db->where("(start_date <= '$end_date' AND end_date >= '$start_date')");

      if ($exclude_id) {
          $this->db->where('id !=', $exclude_id);
      }

      $this->db->where_in('status', ['pending','approved']);

      return $this->db->get('bookings')->num_rows() == 0;
  }


  public function is_driver_available($driver_id, $start_date, $end_date, $exclude_id = null)
  {
      $this->db->where('driver_id', $driver_id);
      $this->db->where("(start_date <= '$end_date' AND end_date >= '$start_date')");

      if ($exclude_id) {
          $this->db->where('id !=', $exclude_id);
      }

      $this->db->where_in('status', ['pending','approved']);

      return $this->db->get('bookings')->num_rows() == 0;
  }
}
