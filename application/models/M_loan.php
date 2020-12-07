<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_loan extends CI_Model {
  function InsertLoanMaster($data) {
    $this->db->insert('loan_master', $data);
  }

  function InsertLoanDetail($data) {
    $this->db->insert('loan_detail', $data);
  }

  function getEmployeeList() {
    $query  = "SELECT a.emp_nip, a.emp_fullname
    FROM employee a
    LEFT JOIN user b ON b.user_name = a.emp_nip
    WHERE b.user_active = 1";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getLoanMaster() {
    $query  = "SELECT a.*, b.emp_fullname, b.emp_branch, c.dept_position
    FROM loan_master a
    LEFT JOIN employee b ON a.master_nip = b.emp_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    ORDER BY loan_startDate ASC;";
    $result = $this->db->query($query);
    return $result->result();
  }

  function getLoanmasterById($id) {
    $query  = "SELECT a.*, b.emp_fullname, b.emp_branch, c.dept_position FROM loan_master a
    LEFT JOIN employee b ON a.master_nip = b.emp_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    WHERE loan_id = '$id';";
    $result = $this->db->query($query);
    return $result->row();
  }

  function getLoanDetail($loandet_id) {
    $query  = "SELECT * FROM loan_detail a
    WHERE a.loandet_masterId = '$loandet_id' ORDER BY a.loandet_datePaid ASC;";
    $result = $this->db->query($query);
    return $result->result();
  }

  function updateLoanMaster($id, $data) {
    $this->db->where('loan_id',$id);
    $this->db->update('loan_master', $data);
  }

  function DeleteHoliday($id) {
    $this->db->where('holiday_id',$id);
    $this->db->delete('attendance_holiday');
  }
}

?>
