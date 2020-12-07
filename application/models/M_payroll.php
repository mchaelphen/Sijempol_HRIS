<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_payroll extends CI_Model {

  // Master Minimum Wage
  function InsertMinimumWage($data) {
    $this->db->insert('payroll_master_minwage', $data);
  }

  function getCurrentYearWage($year, $where="") {
    $query  = "SELECT * FROM payroll_master_minwage a WHERE wage_year = '$year' $where;";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->result();
  }

  function getMinimumWage($year, $branch) {
    $query  = "SELECT * FROM payroll_master_minwage a WHERE wage_year = '$year' AND wage_tlcreg = '$branch';";
    $result = $this->db->query($query);
    // echo $query; exit();
    return $result->row();
  }

  function DeleteMinWage($id) {
    $this->db->where('wage_id',$id);
    $this->db->delete('payroll_master_minwage');
  }
  //  End Master Minimum Wage

  // Master Employee Salary
  function getEmployeesSalary() {
    $query = "SELECT a.emp_nip, a.emp_fullname, a.emp_branch, b.dept_division, b.dept_position, b.dept_level,
    c.*
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN payroll_salary c ON c.master_nip = a.emp_nip";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getSalary($nip) {
    $query = "SELECT a.emp_nip, a.emp_fullname, a.emp_branch, b.dept_division, b.dept_position, b.dept_level,
    c.*
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN payroll_salary c ON c.master_nip = a.emp_nip
    WHERE a.emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function updateSalary($data, $nip) {
    $this->db->where('master_nip', $nip);
    $this->db->update('payroll_salary', $data);
  }
  // End Master Employee Salary

  // Generate Employee Paycheck
  function getFilteredEmployees($emp_branch, $emp_designation) {
    $query = "SELECT a.emp_nip, a.emp_fullname, a.emp_branch, a.emp_designation, b.dept_division, b.dept_position, b.dept_level,
    c.*
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN payroll_salary c ON c.master_nip = a.emp_nip
    WHERE a.emp_branch = '$emp_branch' AND a.emp_designation = '$emp_designation';";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getFilteredEmployeesBranch($emp_branch) {
    $query = "SELECT a.emp_nip, a.emp_fullname, a.emp_branch, a.emp_designation, b.dept_division, b.dept_position, b.dept_level,
    c.*
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN payroll_salary c ON c.master_nip = a.emp_nip
    WHERE a.emp_branch = '$emp_branch';";
    $result = $this->db->query($query);

    return $result->result();
  }

  function checkDupePaycheck($nip, $month, $year) {
    $query = "SELECT *
    FROM payroll_paycheck a
    WHERE a.master_nip = '$nip' AND a.paycheck_month = '$month' AND a.paycheck_year='$year';";
    $result = $this->db->query($query);

    return $result->num_rows();
  }

  // check overtime approved hour
  function getOvertimeApprovedHour($nip, $start_date, $end_date) {
    $query = "SELECT SUM(a.overtime_approved_hour) AS approvedHour
    FROM attendance_overtime a
    WHERE a.master_nip = '$nip'
    AND a.overtime_date BETWEEN '$start_date' AND '$end_date'
    AND a.overtime_flag_manager = '2' AND a.overtime_flag_hrd = '2'";
    $result = $this->db->query($query);

    return $result->row_array();
  }

  function InsertOTHistory($data) {
    $this->db->insert('payroll_history_overtime', $data);
  }

  // check employee attendance
  function getEmployeeAttendance($nip, $start_date, $end_date) {
    $query = "SELECT a.pairingDate, a.pairingNik, a.pairingTimeIn, a.pairingTimeOut,
    a.pairingTimeOffice, b.hourName, b.hourTimeIn, a.pairingcurday
    FROM attendance_consolepairing a
    LEFT JOIN attendance_officehour b ON b.hourType = a.pairingTimeOffice
    WHERE a.pairingNik = '$nip' AND a.pairingDate BETWEEN '$start_date' AND '$end_date'";
    $result = $this->db->query($query);

    return $result->result();
  }

  // check Employee Loan
  function getEmployeeLoan($emp_nip, $paycheck_month, $paycheck_year) {
    $query = "SELECT a.loandet_debtPaid
    FROM loan_detail a
    WHERE a.master_nip = '$emp_nip' AND a.loandet_month = '$paycheck_month'
    AND a.loandet_year = '$paycheck_year'";
    $result = $this->db->query($query);

    return $result->row();
  }

  // check employee attendance
  function checkMassLeave($date) {
    $query = "SELECT * FROM attendance_massleave a
    WHERE a.massleave_date = '$date'";
    $result = $this->db->query($query);

    return $result->num_rows();
  }

  function checkHoliday($date) {
    $query = "SELECT * FROM attendance_holiday a
    WHERE a.holiday_date = '$date'";
    $result = $this->db->query($query);

    return $result->num_rows();
  }

  function checkPermittance($date, $nip) {
    $query = "SELECT * FROM attendance_permit a
    WHERE a.master_nip = '$nip' AND a.permit_date = '$date' AND permit_approved_flag = 2";
    $result = $this->db->query($query);

    return $result->num_rows();
  }

  function checkLeave($where) {
    $query = "SELECT * FROM attendance_leave a ".$where;
    $result = $this->db->query($query);
    // die($query);
    return $result->result();
  }

  function checkSickLeave($where) {
    $query = "SELECT * FROM attendance_medicleave a ".$where;
    $result = $this->db->query($query);
    // die($query);
    return $result->result();
  }
  // End check employee attendance


  function InsertPaycheck($data) {
    $this->db->insert('payroll_paycheck', $data);
  }

  // End Generate Employee Paycheck

  // Get Employee Paycheck
  function getEmployeePaycheck($paycheck_month, $paycheck_year, $emp_branch, $dept_level) {
    $query = "SELECT a.*, b.emp_fullname, c.dept_position, c.dept_level
    FROM payroll_paycheck a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    WHERE a.paycheck_year = '$paycheck_year' AND a.paycheck_month = '$paycheck_month'
    AND b.emp_branch = '$emp_branch' ";
    if ($dept_level == 1) {
      $query .= "AND c.dept_level = 'Staff'";
    } else {
      $query .= "AND c.dept_level != 'Staff'";
    }
    $result = $this->db->query($query);

    return $result->result();
  }
  // End Get Employee Paycheck

}
?>
