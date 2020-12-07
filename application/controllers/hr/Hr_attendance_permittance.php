<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_attendance_permittance extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_attendance');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }

  function permittance() {
		$data["title"] = "Permittance";
		$data["link"] = "permittance";

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_periodsearch', $data);
    $this->load->view('templates/footer');
  }

	function permittanceResult() {
		$startDate = $this->input->post('start_date');
		$endDate 	 = $this->input->post('end_date');

		$data = array();
		$permitList = $this->m_attendance->getAllPermit($startDate, $endDate);
		foreach ($permitList as $key => $value) {
			$managerName = $this->m_attendance->getManagerName($value->permit_manager_nip);
			// var_dump($value->permit_manager_nip); exit();
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
				'permit_manager_nip' 	 => !empty($managerName->emp_fullname)?$managerName->emp_fullname:"",
				'permit_paycut_flag' 	 => $value->permit_paycut_flag,
				'permit_request_date'  => $value->permit_request_date,
				'permit_paycut_reason' => $value->permit_paycut_reason,
				'permit_paycut_approved_date' => $value->permit_paycut_approved_date
			);
		};

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_izin', $data);
    $this->load->view('templates/footer');
	}
}
?>
