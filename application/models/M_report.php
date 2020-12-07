<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class M_report extends CI_Model {

  // attendance
  function getReportAll($startdate, $enddate, $designation, $emp_branch) {
    $tmp = "CREATE TEMPORARY TABLE t1
    SELECT pairingnik, pairingdate, pairingTimeOffice, d.emp_fullname, d.emp_absen_id, pairingmonth, pairingyear,
    pairingtimein, DATE(pairingtimein) AS actualdatein, TIME(pairingtimein) actualtimein, hourtimein, hourlate,
    pairingtimeout, pairingstatus, pairingcurday, c.permit_reason, c.permit_approved_flag, c.permit_approved_date,
    e.dept_division, e.dept_position
    FROM attendance_consolepairing a
    LEFT JOIN attendance_officehour b ON pairingtimeoffice = hourtype
    LEFT JOIN attendance_permit c ON c.permit_date = DATE(pairingdate) AND c.master_nip = a.pairingnik
    LEFT JOIN employee d ON d.emp_nip = a.pairingnik
    LEFT JOIN department e ON e.master_nip = a.pairingnik
    WHERE DATE(pairingdate) BETWEEN '$startdate' AND '$enddate'
    AND d.emp_designation = '$designation' AND d.emp_branch = '$emp_branch'";
    $this->db->query($tmp);
    $this->db->query("CREATE TEMPORARY TABLE t2 SELECT *, if(pairingstatus='no_working' and pairingcurday not in('saturday','sunday'),'no_working',if(pairingstatus='no_working' and pairingcurday in('sunday'),'sunday',if(pairingstatus='no_working' and pairingcurday in('saturday'),'saturday',if(pairingcurday='saturday','ontime',if(permit_reason ='Keperluan pekerjaan' and permit_approved_flag=2,'ontime',if(actualtimein>hourlate,'late','ontime')))))) as statusmasuk from t1");
    $this->db->query("CREATE TEMPORARY TABLE t3 SELECT *, if(statusmasuk='late',TIMEDIFF(actualtimein,hourlate),0) AS minute_telat from t2");
    $this->db->query("CREATE TEMPORARY TABLE t4 SELECT *, if(statusmasuk='late',TIME_TO_SEC(minute_telat),0) AS  minute_to_sec FROM t3");
    $this->db->query("CREATE TEMPORARY TABLE t5 SELECT * from t4");
    // echo $tmp;
    $query = "SELECT * FROM t5";
    $result = $this->db->query($query);
    return $result->result();
  }

  function getReportAll2() {
    $query = "SELECT pairingnik, emp_fullname, count(pairingnik) AS harikalender,
    sum(case when  DAY(pairingdate)=16 then minute_to_sec ELSE 0 END)/60 AS telat16,
    sum(case when  DAY(pairingdate)=17  then minute_to_sec ELSE 0 END)/60 AS telat17,
    sum(case when  DAY(pairingdate)=18  then minute_to_sec ELSE 0 END)/60 AS telat18,
    sum(case when  DAY(pairingdate)=19  then minute_to_sec ELSE 0 end)/60 AS telat19,
    sum(case when  DAY(pairingdate)=20  then minute_to_sec ELSE 0 end)/60 AS telat20,
    sum(case when  DAY(pairingdate)=21  then minute_to_sec ELSE 0 end)/60 AS telat21,
    sum(case when  DAY(pairingdate)=22  then minute_to_sec ELSE 0 end)/60 AS telat22,
    sum(case when  DAY(pairingdate)=23  then minute_to_sec ELSE 0 end)/60 AS telat23,
    sum(case when  DAY(pairingdate)=24  then minute_to_sec ELSE 0 end)/60 AS telat24,
    sum(case when  DAY(pairingdate)=25  then minute_to_sec ELSE 0 END)/60 AS telat25,
    sum(case when  DAY(pairingdate)=26  then minute_to_sec ELSE 0 end)/60 AS telat26,
    sum(case when  DAY(pairingdate)=27  then minute_to_sec ELSE 0 end)/60 AS telat27,
    sum(case when  DAY(pairingdate)=28  then minute_to_sec ELSE 0 end)/60 AS telat28,
    sum(case when  DAY(pairingdate)=29  then minute_to_sec ELSE 0 end)/60 AS telat29,
    sum(case when  DAY(pairingdate)=30  then minute_to_sec ELSE 0 end)/60 AS telat30,
    sum(case when  DAY(pairingdate)=31  then minute_to_sec ELSE 0 end)/60 AS telat31,
    sum(case when  DAY(pairingdate)=01  then minute_to_sec ELSE 0 end)/60 AS telat1,
    sum(case when  DAY(pairingdate)=02  then minute_to_sec ELSE 0 end)/60 AS telat2,
    sum(case when  DAY(pairingdate)=03  then minute_to_sec ELSE 0 end)/60 AS telat3,
    sum(case when  DAY(pairingdate)=04  then minute_to_sec ELSE 0 end)/60 AS telat4,
    sum(case when  DAY(pairingdate)=05  then minute_to_sec ELSE 0 end)/60 AS telat5,
    sum(case when  DAY(pairingdate)=06  then minute_to_sec ELSE 0 end)/60 AS telat6,
    sum(case when  DAY(pairingdate)=07  then minute_to_sec ELSE 0 end)/60 AS telat7,
    sum(case when  DAY(pairingdate)=08  then minute_to_sec ELSE 0 end)/60 AS telat8,
    sum(case when  DAY(pairingdate)=09  then minute_to_sec ELSE 0 end)/60 AS telat9,
    sum(case when  DAY(pairingdate)=10  then minute_to_sec ELSE 0 end)/60 AS telat10,
    sum(case when  DAY(pairingdate)=11  then minute_to_sec ELSE 0 end)/60 AS telat11,
    sum(case when  DAY(pairingdate)=12  then minute_to_sec ELSE 0 end)/60 AS telat12,
    sum(case when  DAY(pairingdate)=13  then minute_to_sec ELSE 0 end)/60 AS telat13,
    sum(case when  DAY(pairingdate)=14  then minute_to_sec ELSE 0 end)/60 AS telat14,
    sum(case when  DAY(pairingdate)=15  then minute_to_sec ELSE 0 end)/60 AS telat15
    FROM t5 GROUP BY pairingnik, emp_fullname;";

    $result = $this->db->query($query);

    return $result->result();
  }
  // attendance

  // overtime
  function getReportOvertime($startdate, $enddate) {
    $this->db->query("CREATE TEMPORARY TABLE tmplbr
    SELECT a.master_nip, b.emp_fullname, (a.overtime_date), (a.overtime_request_hour),
    (overtime_approved_hour), a.overtime_approved_date, a.overtime_flag_manager, a.overtime_flag_hrd
    FROM attendance_overtime a INNER JOIN employee b ON a.master_nip = b.emp_nip
    WHERE a.overtime_date BETWEEN '$startdate' AND '$enddate' AND a.overtime_flag_manager=2;
    #group by master_nip;");

    $query = "SELECT master_nip, emp_fullname, SUM(overtime_request_hour) AS requested_hour, SUM(overtime_approved_hour) AS approved_hour
    FROM tmplbr GROUP BY master_nip, emp_fullname ORDER BY master_nip";

    $result = $this->db->query($query);
    return $result->result();
  }
  // overtime

  // function InsertMedicalLeave($data) {
  //   $this->db->insert('attendance_medicleave', $data);
  // }
  //
  // function updateMedic($oldimage, $data, $medic_id) {

  //   unlink("assets/uploads/attendance_medicalleave/".$oldimage);
  //   $this->db->where('medic_id', $medic_id);
  //   $this->db->update('attendance_medicleave', $data);
  // }

// Contract
  function getLatestContractEnd() {
    $query = "SELECT a.master_nip, b.emp_branch, b.emp_fullname, c.dept_division, a.contract_signed_date, a.contract_end_date,
    DATEDIFF(contract_end_date,now()) AS expired_in
    FROM mastercontracts a
    LEFT JOIN employee b ON a.master_nip = b.emp_nip
    LEFT JOIN department c ON c.master_nip = a.master_nip
    WHERE DATEDIFF(contract_end_date,now()) <= 30";
    $result = $this->db->query($query);

    return $result->result();
  }
  // SELECT a.master_nip,b.emp_fullname,c.dept_division,a.contract_signed_date,a.contract_end_date,DATEDIFF(contract_end_date,now()) AS expired_in FROM mastercontracts a
  // LEFT JOIN employee  b ON a.master_nip=b.emp_nip
  // LEFT JOIN department c ON c.master_nip=a.master_nip WHERE DATEDIFF(contract_end_date,now()) <= 30

}
?>
