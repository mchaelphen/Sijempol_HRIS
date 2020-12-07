<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_leave extends CI_Model {

  function InsertLeave($data) {
    $this->db->insert('attendance_leave', $data);
  }

  function getEmpCuti($nip) {
    $query = "SELECT emp_date_entry, emp_paid_leave_default, emp_paid_leave
    FROM employee WHERE emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getEmpLeaveList($nip) {
    $query = "SELECT * FROM attendance_leave WHERE master_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getCountCutiBersama($year) {
    $query = "SELECT COUNT(massleave_id) AS cutibersama FROM attendance_massleave WHERE massleave_year = '$year'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getMassLeaveBetweenDates($start, $end) {
    $query = "SELECT COUNT(massleave_id) AS massleave FROM attendance_massleave WHERE massleave_date BETWEEN '$start' AND '$end'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getCountAmbilCuti($nip, $year) {
    $query = "SELECT sum(leave_days) AS cutiterambil
    FROM attendance_leave
    WHERE master_nip = '$nip' AND YEAR(leave_from) = '$year'
    AND leave_manager_flag = 2 AND leave_hr_flag = 2";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->row();
  }

  function updateEmpPaidLeave($nip, $data) {
    $this->db->where('emp_nip', $nip);
		$this->db->update('employee',$data);
  }

  // Manager Sides
  function getStaffLeave($manager_nip) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_leave a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE leave_manager_nip = '$manager_nip' ORDER BY leave_request_date DESC";
    $result = $this->db->query($query);
    return $result->result();
  }

  function updateLeave($id, $data) {
    $this->db->where('leave_id', $id);
		$this->db->update('attendance_leave',$data);
  }

  // HR Sides
  function getAllStaffLeave($startDate, $endDate) {
    $query = "SELECT a.*, emp_fullname, dept_division, dept_position
    FROM attendance_leave a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    WHERE leave_request_date BETWEEN '$startDate' AND '$endDate'
    ORDER BY leave_request_date DESC";
    $result = $this->db->query($query);
    return $result->result();
  }
}
?>
