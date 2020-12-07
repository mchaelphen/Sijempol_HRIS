<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_holiday extends CI_Model {
  function InsertHoliday($data) {
    $this->db->insert('attendance_holiday', $data);
  }

  function getCurrentYearHoliday($year) {
    $query  = "SELECT * FROM attendance_holiday a WHERE holiday_year = '$year' ORDER BY holiday_date ASC;";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->result();
  }

  function DeleteHoliday($id) {
    $this->db->where('holiday_id',$id);
    $this->db->delete('attendance_holiday');
  }
}

?>
