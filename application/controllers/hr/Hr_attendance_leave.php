<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_attendance_leave extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_leave');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }


  function leave() {
		$data["title"] = "Leave";
		$data["link"]  = "leave";

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_periodsearch', $data);
    $this->load->view('templates/footer');
  }

	function leaveResult() {
		$startDate = $this->input->post('start_date');
		$endDate 	 = $this->input->post('end_date');

		$data = array();
		// $user_nip = $this->session->userdata('user_name');
		$getEmpLeaveList = $this->m_leave->getAllStaffLeave($startDate, $endDate);
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
				'dept_division'          => $value->dept_division,
				'dept_position'          => $value->dept_position,
			);
		}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_leave', $data);
    $this->load->view('templates/footer');
	}

  function updateLeaveFlag($action="", $leave_id) {
		if ($action == 'approve') {
			$updateFlag = array(
				'leave_hr_flag' => 2,
				'leave_hr_nip'  => $this->session->userdata('user_name'),
				'leave_hr_approved_date' => DATE('Y-m-d h:i:s'),
			);
			$this->m_leave->updateLeave($leave_id, $updateFlag);
		} elseif ($action == 'decline') {
			$updateFlag = array(
				'leave_hr_flag' => 3,
				'leave_hr_nip'  => $this->session->userdata('user_name'),
				'leave_hr_approved_date' => DATE('Y-m-d h:i:s'),
			);
			$this->m_leave->updateLeave($leave_id, $updateFlag);
		}
		redirect('hr/hr_attendance_leave/leave');
	}

}
?>
