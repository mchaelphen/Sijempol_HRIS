<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_payroll_loan extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_loan');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function index() {
		$data = array();
    $getEmployee = $this->m_loan->getEmployeeList();
    foreach ($getEmployee as $key => $value) {
  		$data["EmployeeList"][] = array(
  			'emp_nip' 		 => $value->emp_nip,
  			'emp_fullname' => $value->emp_fullname,
  		);
  	}
    // var_dump($getEmployee); exit();
    $getLoanMaster = $this->m_loan->getLoanMaster();
    // var_dump($getLoanMaster); exit();
    foreach ($getLoanMaster as $key => $value) {
  		$data["LoanMasterList"][] = array(
  			'loan_id' 			 => $value->loan_id,
  			'emp_fullname'   => $value->emp_fullname,
  			'master_nip' 		 => $value->master_nip,
  			'loan_amount' 	 => $value->loan_amount,
  			'loan_reason' 	 => $value->loan_reason,
  			'loan_startDate' => $value->loan_startDate,
  			'loan_endDate'   => $value->loan_endDate,
	      'loan_status'		 => $value->loan_status,
  			'loan_remark'    => $value->loan_remark,
  			'emp_branch'     => $value->emp_branch,
  			'dept_position'  => $value->dept_position,
  		);
  	}

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/payroll/hr_loan_master', $data);
    $this->load->view('templates/footer');
  }

  function insert_loan_master() {
    $master_nip 		= $this->input->post('master_nip');
    $loan_amount 	  = $this->input->post('loan_amount');
    $loan_startDate   = $this->input->post('loan_startDate');
    $loan_endDate	= $this->input->post('loan_endDate');
    $loan_reason  		= $this->input->post('loan_reason');

    // var_dump($holiday_year); exit();
    $insertLoanMaster = array(
      'master_nip' 	  => $master_nip,
      'loan_amount' 	=> $loan_amount,
      'loan_startDate'=> $loan_startDate,
      'loan_endDate'	=> $loan_endDate,
      'loan_reason'		=> $loan_reason,
      'loan_StampUser' => $this->session->userdata('user_fullname'),
      'loan_StampDate' => date('Y-m-d h:i:s'),
    );
		// var_dump($insertSchedule); exit();
    $this->m_loan->InsertLoanMaster($insertLoanMaster);
    redirect('hr/Hr_payroll_loan');
  }

	function edit_loan_master($id) {
    $getLoanMaster = $this->m_loan->getLoanmasterById($id);
    // var_dump($getLoanMaster); exit();
		$data = array(
			'loan_id' 			 => $getLoanMaster->loan_id,
      'emp_fullname'   => $getLoanMaster->emp_fullname,
			'master_nip' 		 => $getLoanMaster->master_nip,
			'loan_amount' 	 => $getLoanMaster->loan_amount,
			'loan_reason' 	 => $getLoanMaster->loan_reason,
			'loan_startDate' => $getLoanMaster->loan_startDate,
			'loan_endDate'   => $getLoanMaster->loan_endDate,
      'loan_status'		 => $getLoanMaster->loan_status,
			'loan_remark'    => $getLoanMaster->loan_remark,
			'emp_branch'     => $getLoanMaster->emp_branch,
			'dept_position'  => $getLoanMaster->dept_position,
		);

		// var_dump($data); exit();
		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/payroll/hr_loan_master_edit', $data);
    $this->load->view('templates/footer');
	}

  function update_loan_master() {
		$loan_id 		    = $this->input->post('loan_id');
		$loan_amount 	  = $this->input->post('loan_amount');
		$loan_startDate = $this->input->post('loan_startDate');
		$loan_endDate   = $this->input->post('loan_endDate');
		$loan_reason 	  = $this->input->post('loan_reason');
		$loan_remark 	  = $this->input->post('loan_remark');

		$updateMasterLoan = array(
			'loan_amount' 	 => $loan_amount,
			'loan_startDate' => $loan_startDate,
			'loan_endDate'   => $loan_endDate,
			'loan_reason' 	 => $loan_reason,
			'loan_remark' 	 => $loan_remark,
			'loan_StampUser' => $this->session->userdata('user_fullname'),
			'loan_StampDate' => date('Y-m-d h:i:s'),
		);
    $this->m_loan->updateLoanMaster($loan_id, $updateMasterLoan);
    redirect('hr/Hr_payroll_loan');
  }

  function update_loan_status_paid($id) {
    $loan_id = $id;
    $updateMasterLoanStatus = array(
			'loan_status' 	 => 1,
			'loan_StampUser' => $this->session->userdata('user_fullname'),
			'loan_StampDate' => date('Y-m-d h:i:s'),
		);
    $this->m_loan->updateLoanMaster($loan_id, $updateMasterLoanStatus);
    redirect('hr/Hr_payroll_loan');
  }

  // Start Loan Detail
  function loan_detail_index($id) {
    $getLoanMaster = $this->m_loan->getLoanmasterById($id);
    // var_dump($getLoanMaster); exit();
    $data = array(
      'loan_id' 			 => $getLoanMaster->loan_id,
      'emp_fullname'   => $getLoanMaster->emp_fullname,
      'master_nip' 		 => $getLoanMaster->master_nip,
      'loan_amount' 	 => $getLoanMaster->loan_amount,
      'loan_reason' 	 => $getLoanMaster->loan_reason,
      'loan_startDate' => $getLoanMaster->loan_startDate,
      'loan_endDate'   => $getLoanMaster->loan_endDate,
      'loan_status'		 => $getLoanMaster->loan_status,
      'loan_remark'    => $getLoanMaster->loan_remark,
      'emp_branch'     => $getLoanMaster->emp_branch,
      'dept_position'  => $getLoanMaster->dept_position,
    );

    $getLoanDetail = $this->m_loan->getLoanDetail($id);
    $totalDebtPaid = 0;
    foreach ($getLoanDetail as $key => $value) {
      $totalDebtPaid += $value->loandet_debtPaid;
  		$data["LoanDetailList"][] = array(
  			'loandet_id' 			  => $value->loandet_id,
  			'loandet_masterId'  => $value->loandet_masterId,
  			'master_nip' 		    => $value->master_nip,
  			'loandet_datePaid' 	=> $value->loandet_datePaid,
  			'loandet_datePaid' 	=> $value->loandet_datePaid,
  			'loandet_debtPaid' 	=> $value->loandet_debtPaid,
  			'loandet_stampUser' => $value->loandet_stampUser,
  			'loandet_stampDate' => $value->loandet_stampDate,
        'loandet_month'     => date('m'),
        'loandet_year'      => date('Y'),
  		);
  	}
    $data["totalDebtPaid"] = $totalDebtPaid;
    
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/payroll/hr_loan_detail', $data);
    $this->load->view('templates/footer');
  }

  function insert_loan_detail() {
    $master_nip       = $this->input->post('master_nip');
    $loandet_masterId = $this->input->post('loandet_masterId');
		$loandet_debtPaid = $this->input->post('loandet_debtPaid');

    $data = array(
      'loandet_masterId'  => $loandet_masterId,
      'master_nip' 		    => $master_nip,
      'loandet_datePaid' 	=> DATE("Y-m-d h:i:s"),
      'loandet_debtPaid' 	=> $loandet_debtPaid,
      'loandet_stampUser' => $this->session->userdata('user_fullname'),
      'loandet_stampDate' => date('Y-m-d h:i:s'),
      'loandet_month'     => date('m'),
      'loandet_year'      => date('Y'),
    );

    $this->m_loan->InsertLoanDetail($data);

    redirect('hr/Hr_payroll_loan/loan_detail_index/'.$loandet_masterId);
  }


}
?>
