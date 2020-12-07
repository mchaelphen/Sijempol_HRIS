<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_medicleave extends CI_Model {

  function InsertMedicalLeave($data) {
    $this->db->insert('attendance_medicleave', $data);
  }

  function getUserMedlev($nip) {
    $query = "SELECT * FROM attendance_medicleave a WHERE a.master_nip = '$nip'";
    $result = $this->db->query($query);
    return $result->result();
  }

  function getAllMedLev($startDate, $endDate) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_medicleave a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE medic_from BETWEEN '$startDate' AND '$endDate'";
    $result = $this->db->query($query);
    return $result->result();
  }

  function getMedicbyId($id) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_medicleave a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.medic_id = '$id'";
    $result = $this->db->query($query);
    return $result->row();
  }

  function updateMedic($oldimage, $data, $medic_id) {
    unlink("assets/uploads/attendance_medicalleave/".$oldimage);
    $this->db->where('medic_id', $medic_id);
    $this->db->update('attendance_medicleave', $data);
  }

  function updateApproval($medic_id, $data) {
    $this->db->where('medic_id', $medic_id);
    $this->db->update('attendance_medicleave', $data);
  }
}
?>
