<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_hr extends CI_Model {
  // Get
  function getAllEmployees() {
    $query = "SELECT a.*, b.user_active, b.user_flag_editprofile, c.dept_division, c.dept_position
    FROM employee a
    LEFT JOIN user b ON b.user_name = a.emp_nip
    LEFT JOIN department c ON c.master_nip = a.emp_nip ";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployees($active_status) {
    $query = "SELECT a.*, b.user_active, b.user_flag_editprofile, c.dept_division, c.dept_position
    FROM employee a
    LEFT JOIN user b ON b.user_name = a.emp_nip
    LEFT JOIN department c ON c.master_nip = a.emp_nip
    WHERE b.user_active = $active_status";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployeeProfile($nip) {
    $query = "SELECT a.*
    FROM employee a
    WHERE a.emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getAllManager() {
    $query = "SELECT emp_nip, emp_fullname, dept_position
    FROM employee a
    LEFT JOIN department b ON b.master_nip = a.emp_nip
    LEFT JOIN user c ON c.user_name = a.emp_nip
    WHERE b.dept_level = 'Manager' OR b.dept_level = 'Assistant Manager' OR b.dept_level = 'Supervisor'
    AND c.user_active = 1";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getContracts($id) {
    if (!empty($id)) {
      $where = " WHERE contract_id = '$id'";
    } else {
      $where = "";
    }

    $query = "SELECT a.*, b.emp_fullname, c.dept_position
    FROM contracts a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip".$where."
    ORDER BY a.contract_signed_date DESC";

    $result = $this->db->query($query);
    return $result->result();
  }

  function count_contract_detail($nip) {
    $query = "SELECT COUNT(contract_id) as SumOfContract FROM contracts a WHERE a.master_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getEmployeeSelect() {
    $query = "SELECT emp_nip, emp_fullname
    FROM employee a
    LEFT JOIN user b ON b.user_name = a.emp_nip
    WHERE b.user_active = 1";

    $result = $this->db->query($query);

    return $result->result();
  }

  //Insert
  function InsertNewUser($data) {
    $this->db->insert('user', $data);
  }
  function InsertNewEmployee($data) {
    $this->db->insert('employee', $data);
  }
  function InsertContract($data) {
    $this->db->insert('contracts', $data);
  }
  function InsertNewSalary($data) {
    $this->db->insert('payroll_salary', $data);
  }


  //Update
  function UpdateUser($data, $nip) {
    $this->db->where('user_name', $nip);
    $this->db->update('user', $data);
  }
  function UpdateEmployee($data, $nip) {
    $this->db->where('emp_nip', $nip);
    $this->db->update('employee', $data);
  }

  function updateContract($data, $id) {
    $this->db->where('contract_id', $id);
    $this->db->update('contracts', $data);
  }

  function unlinkContractFIle($file_name, $id) {
    $this->db->where('contract_id', $id);
    $this->db->update('contracts', array('contract_file' => NULL));
    unlink("assets/uploads/emp_contracts/".$file_name);
  }

  function updateMasterContract($nip, $data) {
    $this->db->where('master_nip', $nip);
    $this->db->update('mastercontracts', $data);
  }

  function InsertNewDepartment($data) {
    $this->db->insert('department', $data);
  }
  function UpdateDepartment($data, $nip) {
    $this->db->where('master_nip', $nip);
    $this->db->update('department', $data);
  }

}

?>
