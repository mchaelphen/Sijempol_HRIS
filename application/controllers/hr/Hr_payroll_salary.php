<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hr_payroll_salary extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_payroll');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }

	function index($alert="") {
		$result = $this->m_payroll->getEmployeesSalary();
		foreach ($result as $key => $value) {
			$data["row"][] = array(
				'emp_nip' 		  => $value->emp_nip,
				'emp_fullname'  => $value->emp_fullname,
				'emp_branch'    => $value->emp_branch,
				'dept_division' => $value->dept_division,
				'dept_position' => $value->dept_position,
				'dept_level'    => $value->dept_level,
				'salary_total'  => base64_decode($value->salary_total),
				'salary_basic'  => base64_decode($value->salary_basic),
				'salary_kpi'    => base64_decode($value->salary_kpi),
			);
		}

    $data["alert"] = $alert;
    if ($alert == 1) {
      $data["message"] = "Salary updated";
    }

    // var_dump($data["row"]); exit();
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/payroll/hr_payroll_salary_employee', $data);
		$this->load->view('templates/footer');
	}

	function edit_salary($id) {
    $emp_nip = base64_decode($id);
    $getEmpSalary = $this->m_payroll->getSalary($emp_nip);
    $data = array(
      'emp_nip' 		  => $getEmpSalary->emp_nip,
      'emp_fullname'  => $getEmpSalary->emp_fullname,
      'emp_branch'    => $getEmpSalary->emp_branch,
      'dept_division' => $getEmpSalary->dept_division,
      'dept_position' => $getEmpSalary->dept_position,
      'dept_level'    => $getEmpSalary->dept_level,
      'salary_total'  => base64_decode($getEmpSalary->salary_total),
      'salary_basic'  => base64_decode($getEmpSalary->salary_basic),
      'salary_kpi'    => base64_decode($getEmpSalary->salary_kpi),
    );

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/payroll/hr_payroll_salary_edit', $data);
    $this->load->view('templates/footer');
  }

  function update_salary() {
    $salary_basic = $this->input->post('salary_basic');
    $salary_kpi   = $this->input->post('salary_kpi');
    $master_nip   = $this->input->post('master_nip');
    $emp_branch   = $this->input->post('emp_branch');
    $year = DATE("Y");

    // echo $emp_branch; exit();
    $getMinimumWage = $this->m_payroll->getMinimumWage($year, $emp_branch);
    $minimumWage = $getMinimumWage->wage_amount;

    // Gaji Pokok (GP)
    if (($salary_basic * 0.75) < $minimumWage) {
      $salary_main =  $minimumWage;
    } else {
      $salary_main = $salary_basic * 0.75;
    }

    $salary_specialallowance = $salary_basic - $salary_main;
    $salary_total = $salary_basic + $salary_kpi;

    $updateSalary = array(
      'salary_total'            => base64_encode($salary_total),
      'salary_basic'            => base64_encode($salary_basic),
      'salary_main'             => base64_encode($salary_main),
      'salary_specialallowance' => base64_encode($salary_specialallowance),
      'salary_kpi'              => base64_encode($salary_kpi),
			'salary_stampuser' 				=> $this->session->userdata('user_fullname'),
			'salary_stampdate' 				=> DATE('Y-m-d h:i:s')
    );
    $this->m_payroll->updateSalary($updateSalary, $master_nip);

    $alert = 1;

    redirect('hr/hr_payroll_salary/index/'.$alert);
  }


}
?>
