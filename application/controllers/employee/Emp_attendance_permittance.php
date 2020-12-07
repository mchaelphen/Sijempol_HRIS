<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attendance_permittance extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_attendance');

			if ($this->session->userdata('status') == '') {
				redirect('Authentication');
			}
  }
	// IZIN
  function permittance($alert = "") {
		$data = array();
		if ($alert == "success") {
			$data["status_alert"] = 'success';
			$data["alert"] = "Permit request submitted.";
		} elseif ($alert == "failed") {
			$data["status_alert"] = 'danger';
			$data["alert"] = "Permit can only be inserted per day.";
		}

		$permitList = $this->m_attendance->getUserPermit($this->session->userdata('user_name'));
		foreach ($permitList as $key => $value) {
			$data["userPermit"][] = array(
				'permit_id'						 => $value->permit_id,
				'user_nip'						 => $value->master_nip,
				'user_fullname'				 => $value->emp_fullname,
				'permit_reason' 			 => $value->permit_reason,
				'permit_from' 				 => $value->permit_from,
				'permit_to' 					 => $value->permit_to,
				'permit_days' 				 => $value->permit_days,
				'permit_hours' 				 => $value->permit_hours,
				'permit_minutes' 			 => $value->permit_minutes,
				'permit_cause' 				 => $value->permit_cause,
				'permit_approved_flag' => $value->permit_approved_flag,
				'permit_approved_date' => $value->permit_approved_date,
				'permit_manager_nip' 	 => $value->permit_manager_nip,
				'permit_request_date'  => $value->permit_request_date
			);
		};

		// var_dump($data); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/permittance', $data);
    $this->load->view('templates/footer');
  }

	function insert_izin() {
		$master_nip 			  = $this->input->post('master_nip');
		$permit_manager_nip = $this->input->post('leave_manager_nip');
		$permit_reason 		  = $this->input->post('leave_reason');
		$permit_from 			  = $this->input->post('leave_from');
		$permit_to 				  = $this->input->post('leave_to');
		// $permit_days 			  = $this->input->post('leave_days');
		$permit_cause 			= $this->input->post('leave_cause');

		if ($permit_reason == "Keperluan pribadi") {
			$paycut = 1;
		} else {
			$paycut = 0;
		}

		$go = $this->biss_hours($permit_from, $permit_to);
		// echo $go["minute"]; exit();

		$d1 	= strtotime($permit_from);
		$d2 	= strtotime($permit_to);
		$totalSecondsDiff = abs($d1-$d2);
		$totalMinutesDiff = $totalSecondsDiff/60;
		$totalHoursDiff   = floor($totalSecondsDiff/60/60);
		$totalDaysDiff    = floor($totalSecondsDiff/60/60/24);
		// $totalMonthsDiff  = floor($totalSecondsDiff/60/60/24/30);
		// $totalYearsDiff   = floor($totalSecondsDiff/60/60/24/365);

		// $permitdays = (int)$totalDaysDiff;
		// echo $totalMinutesDiff; exit();
		if ($totalDaysDiff == 0) {
			$permit_day = date_create($permit_from); // for converting datetime to date
			$insertPermit = array(
				'master_nip' 				 => $master_nip,
				'permit_reason' 		 => $permit_reason,
				'permit_from' 			 => $permit_from,
				'permit_to'				   => $permit_to,
				// 'permit_days' 			 => $permit_days,
				'permit_hours' 			 => $totalHoursDiff,
				'permit_minutes'		 => $go["minute"],
				'permit_cause' 			 => $permit_cause,
				'permit_manager_nip' => $permit_manager_nip,
				'permit_paycut_flag' => $paycut,
				'permit_date' 			 => date_format($permit_day, "Y-m-d"),
				'permit_request_date'=> DATE("Y-m-d")
			);
			// var_dump($insertPermit); exit();
			$this->m_attendance->InsertPermit($insertPermit);
			$alert = "success";
			redirect('employee/emp_attendance_permittance/permittance/'.$alert);
		} else {
			$alert = "failed";
			redirect('employee/emp_attendance_permittance/permittance/'.$alert);
		}
	}

	function permittance_manager() {
		$data = array();
		$dept_level = $this->session->userdata('dept_level');
		if ($dept_level = "Manager" || $dept_level == "Leader" || $dept_level == "Coordinator") {
			$staffPermit = $this->m_attendance->getStaffPermit($this->session->userdata('user_name'));
			foreach ($staffPermit as $key => $value) {
				$data["staffPermit"][] = array(
					'permit_id'						 => $value->permit_id,
					'staff_nip'						 => $value->master_nip,
					'staff_fullname'			 => $value->emp_fullname,
					'permit_reason' 			 => $value->permit_reason,
					'permit_from' 				 => $value->permit_from,
					'permit_to' 					 => $value->permit_to,
					'permit_days' 				 => $value->permit_days,
					'permit_hours' 				 => $value->permit_hours,
					'permit_minutes' 			 => $value->permit_minutes,
					'permit_cause' 				 => $value->permit_cause,
					'permit_approved_flag' => $value->permit_approved_flag,
					'permit_approved_date' => $value->permit_approved_date,
					'permit_manager_nip' 	 => $value->permit_manager_nip,
					'permit_paycut_flag' 	 => $value->permit_paycut_flag,
					'permit_request_date'  => $value->permit_request_date,
					'permit_paycut_reason' => $value->permit_paycut_reason,
					'permit_paycut_approved_date' => $value->permit_paycut_approved_date
				);
			}
		}

		// var_dump($data); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/permittance_manager', $data);
    $this->load->view('templates/footer');
	}

	function approve_permit($id) {
		$approvePermit = array(
			'permit_approved_flag' => 2,
			'permit_approved_date' => DATE('Y-m-d H:i:s'),
		);
		$this->m_attendance->updatePermitFlag($approvePermit, $id);
		redirect('employee/emp_attendance_permittance/permittance_manager/');
	}

	function decline_permit($id) {
		$declinePermit = array(
			'permit_approved_flag' => 3,
			'permit_approved_date' => DATE('Y-m-d H:i:s'),
		);
		$this->m_attendance->updatePermitFlag($declinePermit, $id);
		redirect('employee/emp_attendance_permittance/permittance_manager/');
	}

	function dispensation_permit($id) {
		$data["permit_id"] = $id;
		$getPermit = $this->m_attendance->getPermitInfo($id);
		// var_dump($getPermit); exit();
		$data["master_nip"] 	  = $getPermit->master_nip;
		$data["emp_fullname"]   = $getPermit->emp_fullname;
		$data["permit_reason"]  = $getPermit->permit_reason;
		$data["permit_from"] 	  = $getPermit->permit_from;
		$data["permit_to"] 		  = $getPermit->permit_to;
		$data["permit_hours"]   = $getPermit->permit_hours;
		$data["permit_minutes"] = $getPermit->permit_minutes;
		$data["permit_cause"] 	= $getPermit->permit_cause;
		$data["permit_request_date"] = $getPermit->permit_request_date;

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/permittance_manager_dispensation', $data);
		$this->load->view('templates/footer');
	}

	function dispensation_approve() {
		$id = $this->input->post('permit_id');
		$paycut_reason = $this->input->post('permit_paycut_reason');

		$dispensationPermit = array(
			'permit_paycut_flag'   => 0,
			'permit_paycut_reason' => $paycut_reason,
			'permit_paycut_approved_date' => DATE('Y-m-d H:i:s'),
		);
		$this->m_attendance->updatePermitFlag($dispensationPermit, $id);
		redirect('employee/emp_attendance_permittance/permittance_manager/');
	}

	function biss_hours($start, $end) {
		$startDate = new DateTime($start);
    $endDate 	 = new DateTime($end);
    $periodInterval = new DateInterval( "PT1H" );

    $period = new DatePeriod( $startDate, $periodInterval, $endDate );
    $count  = 0;

    foreach($period as $date) {
	    $startofday = clone $date;
	    $startofday->setTime(8,00);
	    $endofday = clone $date;
	    $endofday->setTime(17,00);
      if($date > $startofday && $date <= $endofday && !in_array($date->format('l'), array('Sunday','Saturday'))) {
        $count++;
      }
    }
		//Get seconds of Start time
		$start_d 				 = date("Y-m-d H:00:00", strtotime($start));
		$start_d_seconds = strtotime($start_d);
		$start_t_seconds = strtotime($start);
		$start_seconds   = $start_t_seconds - $start_d_seconds;

		//Get seconds of End time
		$end_d 				 = date("Y-m-d H:00:00", strtotime($end));
		$end_d_seconds = strtotime($end_d);
		$end_t_seconds = strtotime($end);
		$end_seconds 	 = $end_t_seconds - $end_d_seconds;

		$diff = $end_seconds-$start_seconds;

		if($diff != 0):
			$count--;
		endif;

		// $total_min_sec = date('i:s',$diff);
		// return $count .":".$total_min_sec;
		$leavetime = array(
			'hour'	 => $count,
			'minute' => $total_min_sec = date('i', $diff),
		);
		// var_dump($leavetime); exit();
		return $leavetime;
	}

}
?>
