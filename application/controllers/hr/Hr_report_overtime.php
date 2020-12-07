<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_report_overtime extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_report');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }

  function showFormReportOvertime() {
		$data = array();

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/reporting/hr_report_overtime_form', $data);
    $this->load->view('templates/footer');
  }

  function getResultOvertimeAll() {
    $startDate = $this->input->post('start_date');
    $endDate   = $this->input->post('end_date');

		$data["startDate"] = $startDate;
		$data["endDate"]   = $endDate;

    $result = $this->m_report->getReportOvertime($startDate, $endDate);
    echo "<br>";
    // var_dump($result); exit();

    foreach ($result as $key => $value) {
      $data["row"][] = array(
        'master_nip'     => $value->master_nip,
        'emp_fullname'   => $value->emp_fullname,
        'requested_hour' => $value->requested_hour,
        'approved_hour'  => $value->approved_hour,

      );
    }
    // var_dump($data["row"]); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/reporting/hr_report_overtime_result', $data);
    $this->load->view('templates/footer');
  }

}
?>
