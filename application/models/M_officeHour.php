<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_officeHour extends CI_Model {

  function InsertSchedule($data) {
    $this->db->insert('attendance_officehour', $data);
  }

  function getAllSchedule() {
    $query  = "SELECT * FROM attendance_officehour a";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->result();
  }

  function getScheduleInfo($id) {
    $query  = "SELECT * FROM attendance_officehour a WHERE a.hourId = '$id'";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->row();
  }

  function getScheduleInfoByType($type) {
    $query  = "SELECT * FROM attendance_officehour a WHERE a.hourType = '$type'";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->row();
  }

  function update_schedule($id, $data) {
    $this->db->where('hourId', $id);
		$this->db->update('attendance_officehour',$data);
  }

  function DeleteSchedule($id) {
    $this->db->where('hourId',$id);
    $this->db->delete('attendance_officehour');
  }

  // Online Absence
  function getAttendanceByDay($nip, $now) {
    $query = "SELECT * FROM attendance_consolepairing a WHERE a.pairingNik = '$nip' AND pairingDate = '$now'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function insertAttendancePairing($data) {
    $this->db->insert('attendance_consolepairing', $data);
  }

  function updateAttendancePairing($where, $data) {
    $this->db->where($where);
		$this->db->update('attendance_consolepairing',$data);
  }

  // Manager Menu: Staff Scheduling
  function getStaffSchedule($manager_nip) {
    $query  = "SELECT a.emp_nip, a.emp_fullname, a.emp_branch, a.emp_office_hour,
    c.hourTimeIn, c.hourTimeOut, c.hourOver
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN attendance_officehour c ON c.hourType = a.emp_office_hour
    WHERE b.dept_manager = '$manager_nip'";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployeeInfo($emp_nip) {
    $query = " SELECT a.emp_nip, a.emp_fullname, a. emp_office_hour
    FROM employee a
    WHERE a.emp_nip = '$emp_nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function updateEmpOfficeHour($nip, $data){
    $this->db->where('emp_nip', $nip);
		$this->db->update('employee', $data);
  }
}

?>
