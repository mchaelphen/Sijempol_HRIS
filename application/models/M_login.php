<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_login extends CI_Model {
  function getUserData($username, $password) {
    $query = "SELECT a.*, b.dept_name, b.dept_subname, b.dept_position,
    b.dept_level, b.dept_manager, c.emp_branch, c.emp_office_hour
    FROM user a
    LEFT JOIN department b ON b.master_nip = a.user_name
    LEFT JOIN employee c ON c.emp_nip = a.user_name
    WHERE user_name = '$username' AND user_pass = '$password'";
    $result = $this->db->query($query);

    return $result;
  }

  function getAdminData($username, $password) {
    $query = "SELECT a.*, b.dept_level, b.dept_manager FROM user_admin a
    LEFT JOIN department b ON b.master_nip = a.user_name
    WHERE user_name = '$username' AND user_pass = '$password'";
    $result = $this->db->query($query);

    return $result;
  }

  function checkBeforeRegister($nip) {
    $query = "SELECT a.* FROM user a WHERE user_name = '$nip'";
    $result = $this->db->query($query);

    return $result;
  }

  function checkDuplicateAdmin($nip) {
    $query = "SELECT a.* FROM user_admin a WHERE user_name = '$nip'";
    $result = $this->db->query($query);

    return $result;
  }

  function insertNewAdmin($data) {
    $this->db->insert('user_admin', $data);
  }
}

?>
