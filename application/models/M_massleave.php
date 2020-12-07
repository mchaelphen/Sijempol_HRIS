<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_massleave extends CI_Model {
  function Insertmassleave($data) {
    $this->db->insert('attendance_massleave', $data);
  }

  function getCurrentYearmassleave($year) {
    $query  = "SELECT * FROM attendance_massleave a WHERE massleave_year = '$year' ORDER BY massleave_date ASC;";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->result();
  }

  function Deletemassleave($id) {
    $this->db->where('massleave_id',$id);
    $this->db->delete('attendance_massleave');
  }
}

?>
