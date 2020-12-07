<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attendance_overtime extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_overtime');

		if ($this->session->userdata('status') == '') {
			redirect('Authentication');
		}
  }
  // LEMBUR

  function overtime() {
		$data = array();

    $getEmpOT = $this->m_overtime->getUserOvertime($this->session->userdata('user_name'));
    // var_dump($getEmpOT); exit();
    foreach ($getEmpOT as $key => $value) {
			$now  = time();
			$your_date = strtotime($value->overtime_date);
			$datediff  = $now - $your_date; //check if approved date > 2 days

      $data["otlist"][] = array(
				'emp_fullname' 					 => $value->emp_fullname,
        'overtime_date' 				 => $value->overtime_date,
        'overtime_request_hour'  => $value->overtime_request_hour,
        'overtime_approved_hour' => $value->overtime_approved_hour,
        'overtime_remarks' 			 => $value->overtime_remarks,
        'overtime_flag_manager'  => $value->overtime_flag_manager,
				'overtime_approved_date' => $value->overtime_approved_date,
        'overtime_flag_hrd' 		 => $value->overtime_flag_hrd,
				'overtime_approved_hr_date' => $value->overtime_approved_hr_date,
				'datediff' => round($datediff / (60 * 60 * 24))
      );
    }
		// echo $datediff; exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/overtime', $data);
    $this->load->view('templates/footer');
  }

  function insert_overtime() {
    $master_nip 						 = $this->input->post('master_nip');
    $overtime_date_raw 			 = $this->input->post('overtime_date_raw');
    $overtime_date_parameter = $this->input->post('overtime_date_parameter');
    $overtime_request_hour 	 = $this->input->post('overtime_request_hour');
    $overtime_remarks 			 = $this->input->post('overtime_remarks');
    $overtime_manager_nip 	 = $this->input->post('overtime_manager_nip');

		// get user IP
		$ip = $_SERVER['REMOTE_ADDR'];

    // Process Overtime Request Date
    $date1 = str_replace('-', '/', $overtime_date_raw);
    if ($overtime_date_parameter == 1) { // yesterday
      $overtime_date = date('Y-m-d', strtotime($date1 . "-1 days"));
    } elseif ($overtime_date_parameter == 2) { // today
      $overtime_date = date('Y-m-d', strtotime($date1 . "+0 days"));
    } elseif($overtime_date_parameter == 3) { // tomorrow
      $overtime_date = date('Y-m-d', strtotime($date1 . "+1 days"));
    }

    $insertOvertime = array(
      'master_nip' 						=> $master_nip,
      'overtime_date' 				=> $overtime_date,
      'overtime_date_flag' 		=> $overtime_date_parameter,
      'overtime_request_hour' => $overtime_request_hour,
      'overtime_remarks' 			=> $overtime_remarks,
      'overtime_flag_manager' => 1,
      'overtime_flag_hrd' 		=> 1,
      'overtime_request_date' => $overtime_date_raw,
      'overtime_manager_nip'  => $overtime_manager_nip,
      'overtime_user_ip'  		=> $ip,
    );
    $this->m_overtime->InsertOvertime($insertOvertime);
    redirect('employee/emp_attendance_overtime/overtime');
  }

	// dept level: manager
	function overtime_manager() {
		$data = array();

		$getEmpOT = $this->m_overtime->getStaffOvertime($this->session->userdata('user_name'));
		// var_dump($getEmpOT); exit();
		foreach ($getEmpOT as $key => $value) {
			$now = time();
			$your_date = strtotime($value->overtime_date);
			$datediff  = $now - $your_date; //check if approved date > 2 days

			$data["otlist"][] = array(
				'overtime_id' 					 => $value->overtime_id,
				'emp_fullname' 					 => $value->emp_fullname,
				'emp_nip' 							 => $value->master_nip,
				'overtime_date' 				 => $value->overtime_date,
				'overtime_request_hour'  => $value->overtime_request_hour,
				'overtime_approved_hour' => $value->overtime_approved_hour,
				'overtime_remarks' 			 => $value->overtime_remarks,
				'overtime_flag_manager'  => $value->overtime_flag_manager,
				'overtime_approved_date' => $value->overtime_approved_date,
				'overtime_flag_hrd' 		 => $value->overtime_flag_hrd,
				'overtime_approved_hr_date' => $value->overtime_approved_hr_date,
				'TimeIn' 		 		 				 => $value->pairingTimeIn,
				'TimeOut' 		 		 			 => $value->pairingTimeOut,
				'datediff' 		 		 			 => round($datediff / (60 * 60 * 24)),
				'jam_kerja' 		 				 => $value->jam_kerja,
  			'fix' 		 		 					 => $value->fix,
			);
		}
		// var_dump($data); exit();
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/overtime_manager', $data);
		$this->load->view('templates/footer');
	}

	function approve_staffot($id) {
		$data["overtime_id"] = $id;

		$check = $this->m_overtime->checkOTFlag($id);
		if ($check->overtime_date_flag == 3 || $check->overtime_date_flag == 2 ) {
			$result = $this->m_overtime->getOvertimeInfoWithoutAbsence($id);
			// echo $id;
			// var_dump($result); exit();
			$data = array(
				'overtime_id' 					=> $id,
				'emp_fullname' 					=> $result->emp_fullname,
				'overtime_date' 				=> $result->overtime_date,
				'overtime_request_hour' => $result->overtime_request_hour,
				'overtime_remarks' 			=> $result->overtime_remarks,
				'pairingTimeIn' 				=> !empty($result->pairingTimeIn)?$result->pairingTimeIn:'',
				'pairingTimeOut' 				=> !empty($result->pairingTimeOut)?$result->pairingTimeOut:'',
				'dept_division' 				=> $result->dept_division,
				'dept_position' 				=> $result->dept_position,
			);
		} else {
			$result = $this->m_overtime->getOvertimeInfo($id);
			$data = array(
				'overtime_id' 					=> $id,
				'emp_fullname' 					=> $result->emp_fullname,
				'overtime_date' 				=> $result->overtime_date,
				'overtime_request_hour' => $result->overtime_request_hour,
				'overtime_remarks' 			=> $result->overtime_remarks,
				'pairingTimeIn' 				=> $result->pairingTimeIn,
				'pairingTimeOut' 				=> $result->pairingTimeOut,
				'dept_division' 				=> $result->dept_division,
				'dept_position' 				=> $result->dept_position,
			);
		}

		// var_dump($result); exit();
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/overtime_manager_approve', $data);
		$this->load->view('templates/footer');
	}

	function voidOT($id) {
		$data["overtime_id"] = $id;

		$check = $this->m_overtime->checkOTFlag($id);
		if ($check->overtime_date_flag == 3 || $check->overtime_date_flag == 2  ) {
			$result = $this->m_overtime->getOvertimeInfoWithoutAbsence($id);
			$data = array(
				'overtime_id' 					=> $id,
				'emp_fullname' 					=> $result->emp_fullname,
				'overtime_date' 				=> $result->overtime_date,
				'overtime_request_hour' => $result->overtime_request_hour,
				'overtime_remarks' 			=> $result->overtime_remarks,
				'pairingTimeIn' 				=> '',
				'pairingTimeOut' 				=> '',
				'dept_division' 				=> $result->dept_division,
				'dept_position' 				=> $result->dept_position,
			);
		} else {
			$result = $this->m_overtime->getOvertimeInfo($id);
			$data = array(
				'overtime_id' 					=> $id,
				'emp_fullname' 					=> $result->emp_fullname,
				'overtime_date' 				=> $result->overtime_date,
				'overtime_request_hour' => $result->overtime_request_hour,
				'overtime_remarks' 			=> $result->overtime_remarks,
				'pairingTimeIn' 				=> $result->pairingTimeIn,
				'pairingTimeOut' 				=> $result->pairingTimeOut,
				'dept_division' 				=> $result->dept_division,
				'dept_position' 				=> $result->dept_position,
			);
		}

		// var_dump($result); exit();
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/overtime_manager_void', $data);
		$this->load->view('templates/footer');
	}

	function UpdateOTFlag($type, $id="") {
		if ($type == "approve") {
			// approve OT by Manager
			$overtime_id = $this->input->post('overtime_id');
			$overtime_approved_hour = $this->input->post('overtime_approved_hour');
			$updateOT = array(
				'overtime_approved_hour' => $overtime_approved_hour,
				'overtime_flag_manager'  => 2,
				'overtime_approved_date' => date("Y-m-d H:i:s"),
			);
			$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
		} elseif ($type == "decline") {
			// Decline OT by Manager
			$overtime_id = $id;
			$updateOT = array(
				'overtime_approved_hour' => 0,
				'overtime_flag_manager'  => 3,
				'overtime_approved_date' => date("Y-m-d H:i:s"),
			);
			$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
		} elseif ($type == "void") {
			// Decline OT by Manager

			$overtime_void_remarks = $this->input->post('overtime_void_remarks');

			// $overtime_id = $id;
			$overtime_id = $this->input->post('overtime_id');
			$updateOT = array(
				'overtime_approved_hour' 		=> 0,
				'overtime_flag_manager'  		=> 0,
				'overtime_approved_date'	  => date("Y-m-d H:i:s"),
				'overtime_flag_hrd'  				=> 0,
				'overtime_approved_hr_date' => date("Y-m-d H:i:s"),
				'overtime_void_remarks'			=> $overtime_void_remarks
			);
			$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
		}

		redirect('employee/emp_attendance_overtime/overtime_manager/');
	}

	function overtime_history() {
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/overtime_history_form');
		$this->load->view('templates/footer');
	}

	function get_overtime_history() {
		$start_date  = $this->input->post('start_date');
		$end_date 	 = $this->input->post('end_date');
		$manager_nip = $this->session->userdata('user_name');

		$getOTHistory = $this->m_overtime->getStaffOTHistory($start_date, $end_date, $manager_nip);
		foreach ($getOTHistory as $key => $value) {
			$data["OvertimeList"][] = array(
				'emp_nip' 									=> $value->emp_nip,
				'emp_fullname' 							=> $value->emp_fullname,
				'dept_division' 						=> $value->dept_division,
				'dept_position' 					  => $value->dept_position,
				'overtime_date' 						=> $value->overtime_date,
				'overtime_request_hour' 		=> $value->overtime_request_hour,
				'overtime_approved_hour'	  => $value->overtime_approved_hour,
				'overtime_remarks' 					=> $value->overtime_remarks,
				'overtime_flag_manager' 		=> $value->overtime_flag_manager,
				'overtime_flag_hrd'					=> $value->overtime_flag_hrd,
				'overtime_request_date' 		=> $value->overtime_request_date,
				'overtime_approved_date' 		=> $value->overtime_approved_date,
				'overtime_approved_hr_date' => $value->overtime_approved_hr_date,
				'overtime_hr_nip' 					=> $value->overtime_hr_nip,
				'overtime_hr_remarks' 			=> $value->overtime_hr_remarks,
				'overtime_void_remarks' 		=> $value->overtime_void_remarks,
			);
		}
		// var_dump($data["OvertimeList"]); exit();

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/attendance/overtime_history_result', $data);
		$this->load->view('templates/footer');
	}

}
?>
