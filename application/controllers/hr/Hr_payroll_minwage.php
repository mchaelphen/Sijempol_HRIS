<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_payroll_minwage extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_payroll');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function index($alert="") {
		$data = array();
    $year = date("Y");
		$data["year"] = $year;
    if ($alert == 0) {
      $data["message"] = "Duplicate entry!";
      $data["alert"] = $alert;
    } elseif ($alert == 1) {
      $data["message"] = "Minimum Wage successfully submitted.";
      $data["alert"] = $alert;
    } else {
      $data["alert"] = "";
    }

    $getMinWage = $this->m_payroll->getCurrentYearWage($year);
    // var_dump($getMinWage); exit();
    foreach ($getMinWage as $key => $value) {
  		$data["wageList"][] = array(
  			'wage_id' 			 => $value->wage_id,
	  		'wage_tlcreg' 	 => $value->wage_tlcreg,
  			'wage_year' 		 => $value->wage_year,
  			'wage_amount' 	 => $value->wage_amount,
  			'wage_stampuser' => $value->wage_stampuser,
  			'wage_stampdate' => $value->wage_stampdate
  		);
  	}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/payroll/hr_payroll_master_minwage', $data);
    $this->load->view('templates/footer');
  }

  function insert_minwage() {
    $wage_tlcreg = $this->input->post('wage_tlcreg');
    $wage_amount = $this->input->post('wage_amount');
    $year        = $this->input->post('year');
    // var_dump($holiday_year); exit();

    $where = " AND wage_tlcreg = '".$wage_tlcreg."'"; //check duplicate
    $checkDuplicate = $this->m_payroll->getCurrentYearWage($year, $where);
    // var_dump($checkDuplicate); exit();
    if (empty($checkDuplicate)) {
      $insertMinWage = array(
        'wage_tlcreg' 	 => $wage_tlcreg,
        'wage_amount' 	 => $wage_amount,
        'wage_year'      => $year,
        'wage_stampuser' => $this->session->userdata('user_fullname'),
        'wage_stampdate' => date('Y-m-d h:i:s'),
      );
      $this->m_payroll->InsertMinimumWage($insertMinWage);
      $alert = 1;
    } else {
      $alert = 0;
    }

    redirect('hr/hr_payroll_minwage/index/'.$alert);
  }

  function delete_minWage($id) {
    $this->m_payroll->DeleteMinWage($id);
    redirect('hr/hr_payroll_minwage');
  }



}
?>
