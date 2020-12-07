<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_report_attendance extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_report');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }



  function showFormReportAttendanceAll() {
		$data = array();

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/reporting/hr_report_attendance_all', $data);
    $this->load->view('templates/footer');
  }

  function getResultAttendanceAll() {
    $startDate 		= $this->input->post('start_date');
    $endDate   		= $this->input->post('end_date');
    $designation	= $this->input->post('emp_designation');
    $emp_branch		= $this->input->post('emp_branch');

		$data["startDate"] = $startDate;
		$data["endDate"] = $endDate;

		$result  = $this->m_report->getReportAll($startDate, $endDate, $designation, $emp_branch); // employee attendance per day detail

		$result2 = $this->m_report->getReportAll2(); // summary per month

    // var_dump($result); exit();

    foreach ($result as $key => $value) {
			if($value->minute_to_sec != 0) {
				$lateMinutes = round($value->minute_to_sec/60);
			} else {
				$lateMinutes = $value->minute_to_sec;
			}

      $data["row"][] = array(
        'pairingnik'     => $value->pairingnik,
        'pairingdate'    => date('Y-m-d', strtotime($value->pairingdate)),
				'pairingTimeOffice' => $value->pairingTimeOffice,
        'emp_fullname'   => $value->emp_fullname,
        'emp_absen_id'   => $value->emp_absen_id,
        'pairingmonth'   => $value->pairingmonth,
        'pairingyear'    => $value->pairingyear,
        'pairingtimein'  => !empty($value->pairingtimein)?date('H:i:s', strtotime($value->pairingtimein)):'',
        'actualdatein'   => $value->actualdatein,
        'actualtimein'   => $value->actualtimein,
        'hourtimein'     => $value->hourtimein,
        'hourlate'       => $value->hourlate,
        'pairingtimeout' => !empty($value->pairingtimeout)?date('H:i:s', strtotime($value->pairingtimeout)):'',
        'pairingstatus'  => $value->pairingstatus,
				'pairingcurday'  => $value->pairingcurday,
        'permit_reason'  => $value->permit_reason,
        'permit_approved_flag'  => $value->permit_approved_flag,
        'permit_approved_date'  => $value->permit_approved_date,
        'status_masuk'   => $value->statusmasuk,
        'minute_telat'   => $lateMinutes,
				'dept_division'	 => $value->dept_division,
				'dept_position'	 => $value->dept_position
      );
    }

		foreach ($result2 as $key => $value) {
			$data["row2"][] = array(
				'pairingnik'   => $value->pairingnik,
				'emp_fullname' => $value->emp_fullname,
				'harikalender' => $value->harikalender,
				'telat16' => round($value->telat16),
				'telat17' => round($value->telat17),
				'telat18' => round($value->telat18),
				'telat19' => round($value->telat19),
				'telat20' => round($value->telat20),
				'telat21' => round($value->telat21),
				'telat22' => round($value->telat22),
				'telat23' => round($value->telat23),
				'telat24' => round($value->telat24),
				'telat25' => round($value->telat25),
				'telat26' => round($value->telat26),
				'telat27' => round($value->telat27),
				'telat28' => round($value->telat28),
				'telat29' => round($value->telat29),
				'telat30' => round($value->telat30),
				'telat31' => round($value->telat31),
				'telat1'  => round($value->telat1),
				'telat2'  => round($value->telat2),
				'telat3'  => round($value->telat3),
				'telat4'  => round($value->telat4),
				'telat5'  => round($value->telat5),
				'telat6'  => round($value->telat6),
				'telat7'  => round($value->telat7),
				'telat8'  => round($value->telat8),
				'telat9'  => round($value->telat9),
				'telat10' => round($value->telat10),
				'telat11' => round($value->telat11),
				'telat12' => round($value->telat12),
				'telat13' => round($value->telat13),
				'telat14' => round($value->telat14),
				'telat15' => round($value->telat15)
			);
		}

    // var_dump($data["row2"]); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/reporting/hr_report_attendance_result', $data);
    $this->load->view('templates/footer');
  }

	function minutes($time) {
		$time = explode(':', $time);
		return ($time[0]*60) + ($time[1]) + ($time[2]/60);
	}

}
?>
