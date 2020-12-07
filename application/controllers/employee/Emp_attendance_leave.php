<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attendance_leave extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_leave');

		if ($this->session->userdata('status') == '') {
			redirect('Authentication');
		}
  }

  function leave() {
		$data 		= array();
    $user_nip = $this->session->userdata('user_name');
    $year 		= DATE("Y");

    //Jumlah Cuti Bersama dari Table Holiday
    $countCutiBersama = $this->m_leave->getCountCutiBersama($year);

    // tanggal masuk dan data cuti employee
    $infocuti = $this->m_leave->getEmpCuti($user_nip);

		$date = date("Y-m-d");
		$d1 	= strtotime($date);
		$d2 	= strtotime($infocuti->emp_date_entry);
		$totalSecondsDiff = abs($d1-$d2);
		// $totalMinutesDiff = $totalSecondsDiff/60;
		// $totalHoursDiff   = $totalSecondsDiff/60/60;
		// $totalDaysDiff    = $totalSecondsDiff/60/60/24;
		$totalMonthsDiff  = floor($totalSecondsDiff/60/60/24/30);
		$totalYearsDiff   = floor($totalSecondsDiff/60/60/24/365);

    // Hak Cuti Setahun
    if ($totalMonthsDiff >= 12) {
      $cuti = $infocuti->emp_paid_leave_default - $countCutiBersama->cutibersama;
    } else {
      $cuti = 0;
    }

    // Rumus untuk karyawan Prorate
    if($cuti == 0) {
      $prorate = 0;
    } else {
      if($totalYearsDiff == 1) {
				$prorate = 24 - $totalMonthsDiff;
      } else {
				$prorate = 0;
      }
    }

    $countAmbilCuti = $this->m_leave->getCountAmbilCuti($user_nip, $year);
		if ($cuti == 0) {
			$sisaCuti = 0;
		} else {
			$sisaCuti = abs($cuti - $prorate) - $countAmbilCuti->cutiterambil;
		}
		$updateCuti = array(
      'emp_paid_leave' => $sisaCuti,
    );
    $this->m_leave->updateEmpPaidLeave($user_nip, $updateCuti);

		// echo '$totalMonthsDiff'.$totalMonthsDiff."<br>";
		// echo '$totalYearsDiff'.$totalYearsDiff."<br>";
		// echo '$cuti'.$cuti."<br>";
		// echo '$prorate'.$prorate."<br>";
		// echo '$countAmbilCuti->cutiterambil'.$countAmbilCuti->cutiterambil."<br>";
		// echo '$sisaCuti'.$sisaCuti."<br>";
		// echo  8 - 1 - 2;
		// exit();

		// Get Emp Actual Paid Leave Remaining
    $getEmpCuti = $this->m_leave->getEmpCuti($user_nip); //result use row()
    $data = array(
			'emp_paid_leave' => $getEmpCuti->emp_paid_leave
    );

		// Emp Leave Remaining Statistics
		$data = array(
			'annualleave' 	 => $infocuti->emp_paid_leave_default,
			'massleave' 		 => $countCutiBersama->cutibersama,
			'takenleave'  	 => !empty($countAmbilCuti->cutiterambil)?$countAmbilCuti->cutiterambil:0,
			'remainingleave' => $sisaCuti,
		);

		$getEmpLeaveList = $this->m_leave->getEmpLeaveList($user_nip);
		foreach ($getEmpLeaveList as $key => $value) {
			$data["row"][] = array(
				'leave_id' 							 => $value->leave_id,
				'leave_type'						 => $value->leave_type,
				'leave_from'						 => $value->leave_from,
				'leave_to' 							 => $value->leave_to,
				'leave_days' 						 => $value->leave_days,
				'leave_reason' 				 	 => $value->leave_reason,
				'leave_manager_flag' 		 => $value->leave_manager_flag,
				'leave_manager_nip' 		 => $value->leave_manager_nip,
				'leave_approved_date' 	 => $value->leave_approved_date,
				'leave_hr_flag' 			   => $value->leave_hr_flag,
				'leave_hr_nip' 					 => $value->leave_hr_nip,
				'leave_hr_approved_date' => $value->leave_hr_approved_date,
			);
		}
		// var_dump($data); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/leave', $data);
    $this->load->view('templates/footer');
  }

  function insert_leave() {
    $master_nip 	= $this->session->userdata('user_name');
    $leave_type 	= $this->input->post('leave_type');
    $leave_from 	= $this->input->post('leave_from');
    $leave_to 	 	= $this->input->post('leave_to');
    $leave_reason = $this->input->post('leave_reason');
    $leave_remaining = $this->input->post('leave_remaining');
		// echo $master_nip." ".$leave_type." ".$leave_from." ".$leave_to." ".$leave_reason." ".$leave_remaining; exit();
		if ($leave_remaining > 0) {
			$datetime1  = new DateTime($leave_from);
			$datetime2  = new DateTime($leave_to);
			$interval   = $datetime1->diff($datetime2);
			$woweekends = 0;

			for($i = 0; $i <= $interval->d; $i++) {
		    $weekday = $datetime1->format('w');

		    if($weekday !== "0" && $weekday !== "6") { // 0 for Sunday and 6 for Saturday
	        $woweekends++;
		    }
				$datetime1->modify('+1 day');
			}
			$holidaybetween = $this->m_leave->getMassLeaveBetweenDates($leave_from, $leave_to);
			// echo $woweekends; exit();
			if ($this->session->userdata('dept_name') == "Operation") { // if operasional, allow saturday
				if ($woweekends == 0) {
					$woweekends += 1;
				}
			}
			$leave_days = $woweekends - $holidaybetween->massleave;
			// echo $interval." ".$woweekends; exit();
			if ($leave_days <= $leave_remaining) {
				// echo "masuk"; exit();
				// Jumlah cuti mencukupi
				$insertLeave = array (
					'master_nip' 				 => $master_nip,
					'leave_type' 				 => $leave_type,
					'leave_month' 			 => DATE("m",strtotime($leave_from)),
					'leave_year' 				 => DATE("Y",strtotime($leave_from)),
					'leave_from'				 => $leave_from,
					'leave_to' 					 => $leave_to,
					'leave_days' 				 => $leave_days,
					'leave_reason' 			 => $leave_reason,
					'leave_hr_flag' 		 => 1,
					'leave_manager_flag' => 1,
					'leave_manager_nip'  => $this->session->userdata('dept_manager'),
					'leave_request_date' => DATE('Y-m-d h:i:s')
				);
				$this->m_leave->InsertLeave($insertLeave);
				redirect('employee/emp_attendance_leave/leave');
			} else {
				// Jumlah sisa cuti tidak cukup
				redirect('employee/emp_attendance_leave/leave');
			}
		} else {
			redirect('employee/emp_attendance_leave/leave');
		}
  }

	// Modul Cuti u/ Manager
	function leave_manager() {
		$data = array();
		$user_nip = $this->session->userdata('user_name');
		$getEmpLeaveList = $this->m_leave->getStaffLeave($user_nip);
		// var_dump($getEmpLeaveList); exit();
		foreach ($getEmpLeaveList as $key => $value) {
			$data["row"][] = array(
				'emp_fullname' 					 => $value->emp_fullname,
				'master_nip' 						 => $value->master_nip,
				'leave_id' 							 => $value->leave_id,
				'leave_type'						 => $value->leave_type,
				'leave_from'						 => $value->leave_from,
				'leave_to' 							 => $value->leave_to,
				'leave_days' 						 => $value->leave_days,
				'leave_reason' 				 	 => $value->leave_reason,
				'leave_manager_flag' 		 => $value->leave_manager_flag,
				'leave_manager_nip' 		 => $value->leave_manager_nip,
				'leave_approved_date' 	 => $value->leave_approved_date,
				'leave_hr_flag' 			   => $value->leave_hr_flag,
				'leave_hr_nip' 					 => $value->leave_hr_nip,
				'leave_hr_approved_date' => $value->leave_hr_approved_date,
			);
		}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/leave_manager', $data);
    $this->load->view('templates/footer');
	}


	function updateLeaveFlag($action="", $leave_id) {
		if ($action == 'approve') {
			$updateFlag = array(
				'leave_manager_flag' => 2,
				'leave_approved_date' => DATE('Y-m-d h:i:s'),
			);
			$this->m_leave->updateLeave($leave_id, $updateFlag);
		} elseif ($action == 'decline') {
			$updateFlag = array(
				'leave_manager_flag' => 3,
				'leave_approved_date' => DATE('Y-m-d h:i:s'),
			);
			$this->m_leave->updateLeave($leave_id, $updateFlag);
		}
		redirect('employee/emp_attendance_leave/leave_manager');
	}
}
?>
