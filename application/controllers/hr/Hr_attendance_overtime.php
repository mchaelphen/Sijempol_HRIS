<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_attendance_overtime extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_overtime');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }
  // LEMBUR

  function overtime() {
		$data["title"] = "Overtime";
		$data["link"]  = "overtime";

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_periodsearch', $data);
    $this->load->view('templates/footer');
  }

	function overtimeResult($paramStartDate="", $paramEndDate="") {
		$startDate = $this->input->post('start_date');
		$endDate 	 = $this->input->post('end_date');

		if (!empty($paramStartDate) && !empty($paramEndDate)) {
			$startDate = $paramStartDate;
			$endDate 	 = $paramEndDate;
		}

		$data = array();
    $getEmpOT = $this->m_overtime->getAllOvertime($startDate, $endDate);
    // var_dump($getEmpOT); exit();
    foreach ($getEmpOT as $key => $value) {
  		$data["otlist"][] = array(
  			'overtime_id' 					 => $value->overtime_id,
	  		'emp_nip' 						 	 => $value->emp_nip,
  			'emp_fullname' 					 => $value->emp_fullname,
  			'emp_branch' 					 	 => $value->emp_branch,
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
  			'CurrentDay'	 		 			 => $value->pairingcurday,
  			'dept_division' 		 		 => $value->dept_division,
  			'dept_position' 		 		 => $value->dept_position,
  			'jam_kerja' 		 				 => $value->jam_kerja,
  			'fix' 		 		 					 => $value->fix,
  		);
  	}

		$data["paramStartDate"] = $startDate;
		$data["paramEndDate"] = $endDate;

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_overtime', $data);
    $this->load->view('templates/footer');
	}

  function insert_overtime() {
    $master_nip 						 = $this->input->post('master_nip');
    $overtime_date_raw 			 = $this->input->post('overtime_date_raw');
    $overtime_date_parameter = $this->input->post('overtime_date_parameter');
    $overtime_request_hour 	 = $this->input->post('overtime_request_hour');
    $overtime_remarks 			 = $this->input->post('overtime_remarks');
    $overtime_manager_nip 	 = $this->input->post('overtime_manager_nip');

		$manager = $this->m_overtime->getStaffManager($master_nip);

    // Process Overtime Request Date
    $date1 = str_replace('-', '/', $overtime_date_raw);
    if ($overtime_date_parameter == 1) {
      $overtime_date = date('Y-m-d', strtotime($date1 . "-1 days"));
    } elseif ($overtime_date_parameter == 2) {
      $overtime_date = date('Y-m-d', strtotime($date1 . "+0 days"));
    } elseif($overtime_date_parameter == 3) {
      $overtime_date = date('Y-m-d', strtotime($date1 . "+1 days"));
    }

    $insertOvertime = array(
      'master_nip' 						=> $master_nip,
      'overtime_date' 				=> $overtime_date,
      'overtime_request_hour' => $overtime_request_hour,
      'overtime_remarks' 			=> $overtime_remarks,
      'overtime_flag_manager' => 1,
      'overtime_flag_hrd' 		=> 1,
      'overtime_request_date' => $overtime_date_raw,
      'overtime_manager_nip'  => $manager->dept_manager,
    );
		// var_dump($insertOvertime); exit();
    $this->m_overtime->InsertOvertime($insertOvertime);
    redirect('hr/hr_attendance_overtime/overtime');
  }

  function approve_staffot($id, $paramStartDate="", $paramEndDate="") {
  	$data["overtime_id"] = $id;
		$check = $this->m_overtime->checkOTFlag($id);
		if ($check->overtime_date_flag == 3 ) {
			$result = $this->m_overtime->getOvertimeInfoWithoutAbsence($id);
			$data = array(
				'overtime_id' 					=> $id,
				'emp_fullname' 					=> $result->emp_fullname,
				'overtime_date' 				=> $result->overtime_date,
				'overtime_request_hour' => $result->overtime_request_hour,
				'overtime_approved_hour'=> $result->overtime_approved_hour,
				'overtime_hr_nip'				=> $result->overtime_hr_nip,
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
				'overtime_approved_hour'=> $result->overtime_approved_hour,
				'overtime_hr_nip'				=> $result->overtime_hr_nip,
				'overtime_remarks' 			=> $result->overtime_remarks,
				'pairingTimeIn' 				=> $result->pairingTimeIn,
				'pairingTimeOut' 				=> $result->pairingTimeOut,
				'dept_division' 				=> $result->dept_division,
				'dept_position' 				=> $result->dept_position,
			);
		}

		$data["paramStartDate"] = $paramStartDate;
		$data["paramEndDate"]   = $paramEndDate;

		$this->load->view('templates/header');
  	$this->load->view('templates/nav');
  	$this->load->view('hr/attendance/hr_overtime_approve', $data);
  	$this->load->view('templates/footer');
  }

  function decline_staffot($id, $paramStartDate="", $paramEndDate="") {
  	$data["overtime_id"] = $id;
		$check = $this->m_overtime->checkOTFlag($id);
		if ($check->overtime_date_flag == 3 ) {
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

		$data["paramStartDate"] = $paramStartDate;
		$data["paramEndDate"]   = $paramEndDate;

  	$this->load->view('templates/header');
  	$this->load->view('templates/nav');
  	$this->load->view('hr/attendance/hr_overtime_decline', $data);
  	$this->load->view('templates/footer');
  }

	function approveAsManager($id) {
		$data["overtime_id"] = $id;

		$check = $this->m_overtime->checkOTFlag($id);
		if ($check->overtime_date_flag == 3 ) {
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
		$this->load->view('hr/attendance/hr_overtime_approve_manager', $data);
		$this->load->view('templates/footer');
	}

  function UpdateOTFlag($type) {
		$paramStartDate = $this->input->post('paramStartDate');
		$paramEndDate 	= $this->input->post('paramEndDate');

  	if ($type == "approve") {
  		// approve OT by Manager
  		$overtime_id = $this->input->post('overtime_id');
  		$overtime_approved_hour = $this->input->post('overtime_approved_hour');
  		$updateOT = array(
  			'overtime_approved_hour'    => $overtime_approved_hour,
  			'overtime_flag_hrd'         => 2,
  			'overtime_approved_hr_date' => date("Y-m-d H:i:s"),
        'overtime_hr_nip'           => $this->session->userdata('user_name')
  		);
  		$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
  	} elseif ($type == "decline") {
  		// Decline OT by Manager
      $overtime_hr_remarks = $this->input->post('overtime_hr_remarks');
  		$overtime_id = $this->input->post('overtime_id');;
  		$updateOT = array(
  			'overtime_approved_hour' => 0,
  			'overtime_flag_hrd' 		 => 3,
        'overtime_hr_remarks' 	 => $overtime_hr_remarks,
				'overtime_hr_nip'				 => $this->session->userdata('user_name'),
	  		'overtime_approved_hr_date' => date("Y-m-d H:i:s"),
  		);
  		$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
  	} elseif ($type == "approveasmanager") {
			$overtime_id = $this->input->post('overtime_id');
  		$overtime_approved_hour = $this->input->post('overtime_approved_hour');
  		$updateOT = array(
				'overtime_approved_hour'		=> $overtime_approved_hour,
				'overtime_flag_manager'  		=> 2,
				'overtime_approved_date' 		=> date("Y-m-d H:i:s"),
  			'overtime_flag_hrd'         => 2,
  			'overtime_approved_hr_date' => date("Y-m-d H:i:s"),
        'overtime_hr_nip'           => $this->session->userdata('user_name')
  		);
  		$this->m_overtime->UpdateOvertimeFlag($updateOT, $overtime_id);
  	}
  	redirect('hr/hr_attendance_overtime/overtimeResult/'.$paramStartDate.'/'.$paramEndDate);
  }

	function approveMultiple() {
		$idSelected 	= $this->input->post('approveSelect[]');
		$paramStartDate = $this->input->post('paramStartDate');
		$paramEndDate 	= $this->input->post('paramEndDate');
		// var_dump($idSelected); exit();
		for ($i=0; $i < sizeof($idSelected); $i++) {
			$id = $idSelected[$i];
			$updateOT = array(
				'overtime_flag_hrd'         => 2,
				'overtime_approved_hr_date' => date("Y-m-d H:i:s"),
				'overtime_hr_nip'           => $this->session->userdata('user_name')
			);
			$this->m_overtime->UpdateOvertimeFlag($updateOT, $id);
		}
		redirect('hr/hr_attendance_overtime/overtimeResult/'.$paramStartDate.'/'.$paramEndDate);
	}


}
?>
