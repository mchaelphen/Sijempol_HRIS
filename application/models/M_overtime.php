<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_overtime extends CI_Model {
  function InsertOvertime($data) {
    $this->db->insert('attendance_overtime', $data);
  }

  function getAllOvertime($startDate, $endDate) {
    // $query = "SELECT a.*, emp_fullname, emp_nip, pairingTimeIn, pairingTimeOut,
    // dept_division, dept_position
    // FROM attendance_overtime a
    // LEFT JOIN employee b ON b.emp_nip = a.master_nip
    // LEFT JOIN attendance_consolepairing c ON c.pairingNik = b.emp_nip AND date(c.pairingDate) = date(a.overtime_date)
    // LEFT JOIN department d ON d.master_nip = b.emp_nip
    // WHERE overtime_flag_hrd IN (1,2,3)
    // ORDER BY a.overtime_date DESC";
    // $result = $this->db->query($query);
    // // echo $query; exit();
    // return $result->result();

    $this->db->query("CREATE TEMPORARY TABLE t1
    SELECT emp_nip, emp_fullname, emp_branch, DAYNAME(a.overtime_date) AS hari, a.*,
    pairingTimeIn, pairingTimeOut, pairingcurday,
    dept_division, dept_position,
    (TIMEDIFF(pairingTimeOut, pairingTimeIn)) as jam_kerja
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN attendance_consolepairing c ON c.pairingNik = a.master_nip and date(pairingdate)=date(overtime_date)
    LEFT JOIN department d ON d.master_nip = b.emp_nip
    WHERE a.overtime_flag_hrd IN (1,2,3) AND overtime_flag_manager != 0
    AND overtime_date BETWEEN '$startDate' AND '$endDate';");

    // CREATE TEMPORARY TABLE t1
    //   SELECT emp_nip, emp_fullname, DAYNAME(a.overtime_date) AS hari, a.*,
    //   pairingTimeIn, pairingTimeOut, dept_division, dept_position,
    //   (TIMEDIFF(pairingTimeOut, pairingTimeIn)) as jam_kerja
    //   FROM attendance_overtime a
    //   LEFT JOIN employee b ON b.emp_nip = a.master_nip
    //   LEFT JOIN attendance_consolepairing c ON c.pairingNik = a.master_nip
    //   LEFT JOIN department d ON d.master_nip = b.emp_nip
    //   WHERE a.overtime_flag_hrd IN (1,2,3) AND DATE(c.pairingDate) = DATE(a.overtime_date)
    //   AND overtime_date BETWEEN '$startDate' AND '$endDate'

    $this->db->query("CREATE TEMPORARY TABLE t2
      SELECT *, IF(hari = 'wednesday', timediff(jam_kerja, '10:30'),
      TIMEDIFF(jam_kerja,'10:00')) AS lembur FROM t1");

    $this->db->query("CREATE TEMPORARY TABLE t3
      SELECT *, IF(lembur > 0, lembur, 0) AS over_time from t2;");

    $this->db->query("CREATE TEMPORARY TABLE t4
      SELECT *, IF(minute(over_time)>=30,(HOUR(over_time)+1),(HOUR(over_time))) as fix from t3;");

    $result = $this->db->query("SELECT * FROM t4 ORDER BY overtime_date DESC");
    return $result->result();
  }

  function getStaffOvertime($nip) {
    $this->db->query("CREATE TEMPORARY TABLE t1
    SELECT a.*, emp_fullname, DAYNAME(a.overtime_date) AS hari, pairingTimeIn, pairingTimeOut,
    (TIMEDIFF(pairingTimeOut, pairingTimeIn)) as jam_kerja
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN attendance_consolepairing c ON c.pairingNik = b.emp_nip AND date(c.pairingDate) = date(a.overtime_date)
    WHERE a.overtime_manager_nip = '$nip' AND overtime_flag_manager NOT IN (0, 2, 3)
    ORDER BY a.overtime_date DESC");

    $this->db->query("CREATE TEMPORARY TABLE t2
      SELECT *, IF(hari = 'wednesday', timediff(jam_kerja, '10:30'),
      TIMEDIFF(jam_kerja,'10:00')) AS lembur FROM t1");

    $this->db->query("CREATE TEMPORARY TABLE t3
      SELECT *, IF(lembur > 0, lembur, 0) AS over_time from t2;");

    $this->db->query("CREATE TEMPORARY TABLE t4
      SELECT *, IF(minute(over_time)>=30,(HOUR(over_time)+1),(HOUR(over_time))) as fix from t3;");

    $result = $this->db->query("SELECT * FROM t4 ORDER BY overtime_date DESC");
    return $result->result();
  }


  function getUserOvertime($nip) {
    $query = "SELECT a.*, emp_fullname
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    WHERE a.master_nip = '$nip' AND overtime_flag_manager != 0
    ORDER BY a.overtime_date DESC";
    $result = $this->db->query($query);

    return $result->result();
  }

  function getOvertimeInfo($id) {
    $query = "SELECT emp_nip, emp_fullname, a.*, pairingTimeIn, pairingTimeOut, dept_division, dept_position
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN attendance_consolepairing c ON c.pairingNik = a.master_nip
    LEFT JOIN department d ON d.master_nip = b.emp_nip
    WHERE a.overtime_id = '$id' AND DATE(c.pairingDate) = DATE(a.overtime_date)";
    // echo $query; exit();
    $result = $this->db->query($query);
    return $result->row();
  }

  function getOvertimeInfoWithoutAbsence($id) {
    $query = "SELECT emp_nip, emp_fullname, a.*, dept_division, dept_position
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    WHERE a.overtime_id = '$id'";
    // echo $query; exit();
    $result = $this->db->query($query);
    return $result->row();
  }

  function getStaffOTHistory($startDate, $endDate, $manager_nip) {
    $query = "SELECT emp_nip, emp_fullname, a.*, dept_division, dept_position
    FROM attendance_overtime a
    LEFT JOIN employee b ON b.emp_nip = a.master_nip
    LEFT JOIN department c ON c.master_nip = b.emp_nip
    WHERE a.overtime_date BETWEEN '$startDate' AND '$endDate'
    AND a.overtime_manager_nip = $manager_nip ";
    // echo $query; exit();
    $result = $this->db->query($query);
    return $result->result();
  }

  function getStaffManager($nip) {
    $query = "SELECT dept_manager FROM department WHERE master_nip='$nip'";
    $result = $this->db->query($query);

    return $result->row();
  }

  function checkOTFlag($id) {
    $query = "SELECT overtime_date_flag FROM attendance_overtime WHERE overtime_id = '$id'";
    $check = $this->db->query($query);

    return $check->row();
  }

  function UpdateOvertimeFlag($data, $id) {
    $this->db->where('overtime_id', $id);
    $this->db->update('attendance_overtime', $data);
  }
}

?>
