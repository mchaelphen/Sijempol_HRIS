<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_report_contract extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_report');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function showFormReportContract() {
		$data = array();
		$getContractReport = $this->m_report->getLatestContractEnd();

		foreach ($getContractReport as $key => $value) {
			$data["row"][] = array(
				'master_nip' 					 => $value->master_nip,
				'emp_branch' 					 => $value->emp_branch,
				'emp_fullname' 				 => $value->emp_fullname,
				'dept_division' 			 => $value->dept_division,
				'contract_signed_date' => $value->contract_signed_date,
				'contract_end_date' 	 => $value->contract_end_date,
				'expired_in' 					 => $value->expired_in,
			);
		}

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/reporting/hr_report_end_contract', $data);
    $this->load->view('templates/footer');
  }

}
?>
