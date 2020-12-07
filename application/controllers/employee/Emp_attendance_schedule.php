<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attendance_schedule extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_officeHour');

		if ($this->session->userdata('status') == '') {
			redirect('Authentication');
		}
  }

  function index($alert = "") {
		$manager_nip = $this->session->userdata('user_name');
    $getStaffSchedule = $this->m_officeHour->getStaffSchedule($manager_nip);
		// var_dump($getStaffSchedule); exit();
		foreach ($getStaffSchedule as $key => $value) {
			$data['row'][] = array(
				'emp_nip' 				=> $value->emp_nip,
				'emp_fullname' 	  => $value->emp_fullname,
				'emp_branch'			=> $value->emp_branch,
				'emp_office_hour' => $value->emp_office_hour,
				'hourTimeIn' 			=> $value->hourTimeIn,
				'hourTimeOut' 		=> $value->hourTimeOut,
				'hourOver' 				=> $value->hourOver
			);
		}
		
		if ($alert == 1) {
      $data["message"] = "Office Hour changed successfully!";
      $data["alert"] = $alert;
    } else {
      $data["alert"] = "";
    }
		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/schedule_manager', $data);
    $this->load->view('templates/footer');
  }

	function edit_schedule($emp_nip) {
		$getEmpInfo = $this->m_officeHour->getEmployeeInfo($emp_nip);
		$data = array(
			'emp_nip'				  => $getEmpInfo->emp_nip,
			'emp_fullname' 		=> $getEmpInfo->emp_fullname,
			'emp_office_hour' => $getEmpInfo->emp_office_hour
		);

		$allSchedule = $this->m_officeHour->getAllSchedule();
		foreach ($allSchedule as $key => $value) {
			$data["scheduleList"][] = array(
				'hourType' 		 => $value->hourType,
				'hourName' 		 => $value->hourName,
				'hourTimeIn' 	 => $value->hourTimeIn,
				'hourTimeOut'  => $value->hourTimeOut,
				'hourTimeOver' => $value->hourOver
			);
		}

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/schedule_manager_edit', $data);
    $this->load->view('templates/footer');
	}

	function update_empschedule() {
		$emp_nip	= $this->input->post('emp_nip');
		$hourType = $this->input->post('emp_office_hour');

		echo $emp_nip." ".$hourType;
		$updateEmpSchedule = array(
			'emp_office_hour' => $hourType,
		);
		$this->m_officeHour->updateEmpOfficeHour($emp_nip, $updateEmpSchedule);
		$alert = 1;
		redirect('employee/emp_attendance_schedule/index/'.$alert);
	}

}
?>
