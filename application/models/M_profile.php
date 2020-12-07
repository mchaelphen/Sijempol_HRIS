<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_Profile extends CI_Model {
  function getEmployeeProfile($nip) {
    $query = "SELECT a.*
    FROM employee a
    WHERE a.emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getProfilePic($nip) {
    $query = "SELECT a.emp_profile_pic
    FROM employee a
    WHERE a.emp_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getEmployeeDepartment($nip) {
    $query = "SELECT a.*
    FROM department a
    WHERE a.master_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function getEmployeeEducation($nip) {
    $query = "SELECT a.*
    FROM education a
    WHERE a.master_nip = '$nip' ORDER BY a.edu_startyear ASC";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployeeEducationDetail($edu_id) {
    $query = "SELECT a.*
    FROM education a
    WHERE a.edu_id = '$edu_id'";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployeeFamily($nip) {
    $query = "SELECT a.*
    FROM family a
    WHERE a.master_nip = '$nip'";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getEmployeeFamilyDetail($id) {
    $query = "SELECT a.*
    FROM family a
    WHERE a.fam_id = '$id'";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getManagerInfo($nip) {
    $query = "SELECT a.emp_fullname, a.emp_profile_pic FROM employee a WHERE a.emp_nip = '$nip'";
    return $this->db->query($query)->row();
  }

  function checkPassword($user_name) {
    $query = "SELECT a.user_pass FROM user a WHERE a.user_name='$user_name'";
    return $this->db->query($query)->row();
  }

  // update email, phone, address
  function updateEmployee($data, $nip) {
    $this->db->where('emp_nip', $nip);
		$this->db->update('employee',$data);
  }

  // update education history detail
  function updateEducation($data, $edu_id) {
    $this->db->where('edu_id', $edu_id);
    $this->db->update('education', $data);
  }

  // update family member
  function updateFamily($data, $fam_id) {
    $this->db->where('fam_id', $fam_id);
    $this->db->update('family', $data);
  }

  function removeFile($type, $file_name, $nip) {
    $this->db->where('emp_nip', $nip);
    $this->db->update('employee', array('emp_'.$type.'_img' => NULL));
    unlink("assets/uploads/emp_".$type."/".$file_name);
  }

  function insertEducation($data) {
    $this->db->insert('education', $data);
  }

  function insertFamily($data) {
    $this->db->insert('family', $data);
  }

  
}

?>
