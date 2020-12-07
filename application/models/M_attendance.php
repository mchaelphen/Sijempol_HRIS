<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_attendance extends CI_Model {
  function InsertPermit($data) {
    $this->db->insert('attendance_permit', $data);
  }

  function getAllPermit($startDate, $endDate) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_permit a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.permit_date BETWEEN '$startDate' AND '$endDate'
    ORDER BY a.permit_from DESC";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getUserPermit($nip) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_permit a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.master_nip = '$nip' ORDER BY a.permit_from DESC";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getStaffPermit($nip) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_permit a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.permit_manager_nip = '$nip' ORDER BY a.permit_from DESC LIMIT 10";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getPermitInfo($id) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_permit a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.permit_id='$id'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getManagerName($nip) {
    $query = "SELECT emp_fullname
    FROM employee a
    WHERE emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function UpdatePermitFlag($data, $id) {
    $this->db->where('permit_id', $id);
    $this->db->update('attendance_permit', $data);
  }
}

?>
