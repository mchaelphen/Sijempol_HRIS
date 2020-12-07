<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_employee extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_hr');
			$this->load->model('m_profile');
			$this->load->model('m_officeHour');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }

	function index() {
		$result = $this->m_hr->getAllEmployees();
		foreach ($result as $key => $value) {
			$data["row"][] = array(
				'emp_nip' 		   => $value->emp_nip,
				'emp_fullname'   => $value->emp_fullname,
				'emp_branch'   	 => $value->emp_branch,
				'dept_division'  => $value->dept_division,
				'dept_position'  => $value->dept_position,
				'emp_date_entry' => $value->emp_date_entry,
				'user_active'    => $value->user_active,
				'user_flag_editprofile' => $value->user_flag_editprofile
			);
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_list_all_employee', $data);
		$this->load->view('templates/footer');
	}

	// Add New Employee
	function form_add_employee($alert = "") {
		$message = "";
		if ($alert == 1) {
			$message = "NIP Sudah Terdaftar.";
		}

		$getSchedule = $this->m_officeHour->getAllSchedule();
		foreach ($getSchedule as $key => $value) {
			$data["scheduleList"][] = array(
				'hourType' 		=> $value->hourType,
				'hourName' 		=> $value->hourName,
				'hourTimeIn' 	=> $value->hourTimeIn,
				'hourTimeOut' => $value->hourTimeOut,
			);
		}

		$getManager = $this->m_hr->getAllManager();
		foreach ($getManager as $key => $value) {
			$data["managerList"][] = array(
				'emp_nip' 			=> $value->emp_nip,
				'emp_fullname' 	=> $value->emp_fullname,
				'dept_position' => $value->dept_position,
			);
		}

		$data["alert"] 	 = $alert;
		$data["message"] = $message;
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_form_add_employee', $data);
		$this->load->view('templates/footer');
	}

	function save_add_employee() {
		$user_role					= $this->input->post('user_role');
		$user_pass					= $this->input->post('user_pass');

		$emp_fullname 			= $this->input->post('emp_fullname');
		$emp_nip						= $this->input->post('emp_nip');
		$emp_gender					= $this->input->post('emp_gender');
		$emp_birthplace			= $this->input->post('emp_birthplace');
		$emp_birthdate			= $this->input->post('emp_birthdate');
		$emp_religion				= $this->input->post('emp_religion');
		$emp_address				= $this->input->post('emp_address');
		$emp_phone					= $this->input->post('emp_phone');
		$emp_email					= $this->input->post('emp_email');
		$emp_last_edu_grade = $this->input->post('emp_last_edu_grade');
		$emp_marital_status = $this->input->post('emp_marital_status');
		$emp_designation		= $this->input->post('emp_designation');
		$emp_contract				= $this->input->post('emp_contract');
		$emp_date_entry			= $this->input->post('emp_date_entry');
		$emp_bank_acc				= $this->input->post('emp_bank_acc');
		$emp_bank_accname		= $this->input->post('emp_bank_accname');
		$emp_absen_id				= $this->input->post('emp_absen_id');
		$emp_branch					= $this->input->post('emp_branch');
		$emp_office_hour		= $this->input->post('emp_office_hour');

		$dept_division			= $this->input->post('dept_division');
		$dept_name					= $this->input->post('dept_name');
		$dept_subname				= $this->input->post('dept_subname');
		$dept_position			= $this->input->post('dept_position');
		$dept_project				= $this->input->post('dept_project');
		$dept_level					= $this->input->post('dept_level');
		$dept_manager				= $this->input->post('dept_manager');

		// check if there are duplicate entries of NIP
		$checkDuplicateNIP = $this->m_profile->getEmployeeProfile($emp_nip);
		if (!empty($checkDuplicateNIP)) {
			$alert = 1;
			redirect('hr/hr_employee/form_add_employee/'.$alert);
		} else { // Continue Insert
			$data["user"] = array(
				'user_name' 		=> $emp_nip,
				'user_pass'			=> md5($user_pass),
				'user_fullname' => $emp_fullname,
				'user_role'			=> $user_role
			);
			$this->m_hr->InsertNewUser($data["user"]);

			$data["employee"] = array(
				'emp_nip' 					 => $emp_nip,
				'emp_fullname' 			 => $emp_fullname,
				'emp_gender' 				 => $emp_gender,
				'emp_birthplace' 		 => $emp_birthplace,
				'emp_birthdate' 		 => $emp_birthdate,
				'emp_religion' 			 => $emp_religion,
				'emp_address' 			 => $emp_address,
				'emp_phone' 				 => $emp_phone,
				'emp_email' 				 => $emp_email,
				'emp_last_edu_grade' => $emp_last_edu_grade,
				'emp_marital_status' => $emp_marital_status,
				'emp_designation' 	 => $emp_designation,
				'emp_contract' 			 => $emp_contract,
				'emp_bank_acc' 			 => $emp_bank_acc,
				'emp_bank_accname'	 => $emp_bank_accname,
				'emp_date_entry'	 	 => $emp_date_entry,
				'emp_absen_id'			 => $emp_absen_id,
				'emp_branch'			 	 => $emp_branch,
				'emp_office_hour'		 => $emp_office_hour
			);
			$this->m_hr->InsertNewEmployee($data["employee"]);

			$data["department"] = array(
				'master_nip' 		=> $emp_nip,
				'dept_division' => $dept_division,
				'dept_name' 		=> $dept_name,
				'dept_subname'  => $dept_subname,
				'dept_position' => $dept_position,
				'dept_project'  => $dept_project,
				'dept_level'  	=> $dept_level,
				'dept_manager'	=>$dept_manager
			);
			$this->m_hr->InsertNewDepartment($data["department"]);

			$data["salary"] = array(
				'master_nip' 	=> $emp_nip,
			);
			$this->m_hr->InsertNewSalary($data["salary"]);

			redirect('employee/emp_profile/index/'.base64_encode($emp_nip));
		}
	}

	function edit_profile($nip) {
		$nip = base64_decode($nip);
		$getEmpProfile 	  = $this->m_profile->getEmployeeProfile($nip);
		$getEmpDepartment = $this->m_profile->getEmployeeDepartment($nip);

		$data = array(
			'emp_id'     				=> $getEmpProfile->emp_id,
			'emp_absen_id'     	=> $getEmpProfile->emp_absen_id,
			'emp_nip'     			=> $getEmpProfile->emp_nip,
			'emp_fullname'     	=> $getEmpProfile->emp_fullname,
			'emp_gender' 				=> $getEmpProfile->emp_gender,
			'emp_birthplace' 		=> $getEmpProfile->emp_birthplace,
			'emp_birthdate' 		=> $getEmpProfile->emp_birthdate,
			'emp_religion' 			=> $getEmpProfile->emp_religion,
			'emp_address' 			=> $getEmpProfile->emp_address,
			'emp_phone' 			  => $getEmpProfile->emp_phone,
			'emp_email' 			  => $getEmpProfile->emp_email,
			'emp_last_edu_grade'=> $getEmpProfile->emp_last_edu_grade,
			'emp_marital_status'=> $getEmpProfile->emp_marital_status,
			'emp_designation' 	=> $getEmpProfile->emp_designation,
			'emp_contract' 			=> $getEmpProfile->emp_contract,
			'emp_bank_acc' 			=> $getEmpProfile->emp_bank_acc,
			'emp_bank_accname' 	=> $getEmpProfile->emp_bank_accname,
			'emp_date_entry' 		=> $getEmpProfile->emp_date_entry,
			'emp_office_hour'   => $getEmpProfile->emp_office_hour,
			'dept_division' 		=> $getEmpDepartment->dept_division,
			'dept_name' 				=> $getEmpDepartment->dept_name,
			'dept_subname' 			=> $getEmpDepartment->dept_subname,
			'dept_position' 		=> $getEmpDepartment->dept_position,
			'dept_project' 			=> $getEmpDepartment->dept_project,
			'dept_manager'			=> $getEmpDepartment->dept_manager
		);
		// var_dump($data); exit();

		// select2 schedule
		$getSchedule = $this->m_officeHour->getAllSchedule();
		foreach ($getSchedule as $key => $value) {
			$data["scheduleList"][] = array(
				'hourType' 		=> $value->hourType,
				'hourName' 		=> $value->hourName,
				'hourTimeIn' 	=> $value->hourTimeIn,
				'hourTimeOut' => $value->hourTimeOut,
			);
		}

		// select2 manager
		$getManager = $this->m_hr->getAllManager();
		foreach ($getManager as $key => $value) {
			$data["managerList"][] = array(
				'emp_nip' 			=> $value->emp_nip,
				'emp_fullname' 	=> $value->emp_fullname,
				'dept_position' => $value->dept_position,
			);
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_form_edit_employee', $data);
		$this->load->view('templates/footer');
	}

	function save_edit_employee() {
		$emp_fullname 			= $this->input->post('emp_fullname');
		$emp_nip						= $this->input->post('emp_nip');
		$emp_gender					= $this->input->post('emp_gender');
		$emp_birthplace			= $this->input->post('emp_birthplace');
		$emp_birthdate			= $this->input->post('emp_birthdate');
		$emp_religion				= $this->input->post('emp_religion');
		$emp_address				= $this->input->post('emp_address');
		$emp_phone					= $this->input->post('emp_phone');
		$emp_email					= $this->input->post('emp_email');
		$emp_last_edu_grade = $this->input->post('emp_last_edu_grade');
		$emp_marital_status = $this->input->post('emp_marital_status');
		$emp_designation		= $this->input->post('emp_designation');
		$emp_contract				= $this->input->post('emp_contract');
		$emp_date_entry			= $this->input->post('emp_date_entry');
		$emp_bank_acc				= $this->input->post('emp_bank_acc');
		$emp_bank_accname		= $this->input->post('emp_bank_accname');
		$emp_absen_id				= $this->input->post('emp_absen_id');
		$emp_office_hour		= $this->input->post('emp_office_hour');

		$dept_division			= $this->input->post('dept_division');
		$dept_name					= $this->input->post('dept_name');
		$dept_subname				= $this->input->post('dept_subname');
		$dept_position			= $this->input->post('dept_position');
		$dept_project				= $this->input->post('dept_project');
		$dept_manager				= $this->input->post('dept_manager');

		$data["employee"] = array(
			'emp_nip' 					 => $emp_nip,
			'emp_fullname' 			 => $emp_fullname,
			'emp_gender' 				 => $emp_gender,
			'emp_birthplace' 		 => $emp_birthplace,
			'emp_birthdate' 		 => $emp_birthdate,
			'emp_religion' 			 => $emp_religion,
			'emp_address' 			 => $emp_address,
			'emp_phone' 				 => $emp_phone,
			'emp_email' 				 => $emp_email,
			'emp_last_edu_grade' => $emp_last_edu_grade,
			'emp_marital_status' => $emp_marital_status,
			'emp_designation' 	 => $emp_designation,
			'emp_contract' 			 => $emp_contract,
			'emp_bank_acc' 			 => $emp_bank_acc,
			'emp_bank_accname'	 => $emp_bank_accname,
			'emp_date_entry'	 	 => $emp_date_entry,
			'emp_absen_id'			 => $emp_absen_id,
			'emp_office_hour'		 => $emp_office_hour
		);
		$this->m_hr->UpdateEmployee($data["employee"], $emp_nip);

		$data["department"] = array(
			'master_nip' 		=> $emp_nip,
			'dept_division' => $dept_division,
			'dept_name' 		=> $dept_name,
			'dept_subname'  => $dept_subname,
			'dept_position' => $dept_position,
			'dept_project'  => $dept_project,
			'dept_manager'	=> $dept_manager
		);
		$this->m_hr->UpdateDepartment($data["department"], $emp_nip);

		redirect('employee/emp_profile/index/'.base64_encode($emp_nip));
	}

	function deactivateFormEmployee($nip) {
		$data["emp_nip"] = base64_decode($nip);
		$getEmpProfile = $this->m_profile->getEmployeeProfile($data["emp_nip"]);
		$data = array(
			'emp_nip'			 => $getEmpProfile->emp_nip,
			'emp_fullname' => $getEmpProfile->emp_fullname,
		);
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_form_deactivate_employee', $data);
		$this->load->view('templates/footer');
	}

	function deactivateEmployee() {
		$emp_nip 					 = $this->input->post('emp_nip');
		$emp_date_resign 	 = $this->input->post('emp_date_resign');
		$emp_resign_reason = $this->input->post('emp_resign_reason');

		$updateEmployee = array(
			'emp_date_resign' 	=> $emp_date_resign,
			'emp_resign_reason' => $emp_resign_reason
		);
		$this->m_hr->UpdateEmployee($updateEmployee, $emp_nip);

		$updateUser = array(
			'user_active' 					=> 0,
			'user_flag_editprofile' => 0
		);
		$this->m_hr->UpdateUser($updateUser, $emp_nip);

		redirect('hr/hr_employee/index/');
	}

	function updateEditFlag($nip, $editFlag) {
		$nip = base64_decode($nip);
		$updateFlag = array('user_flag_editprofile' => $editFlag,);
		$this->m_hr->UpdateUser($updateFlag, $nip);
		redirect('hr/hr_employee/index/');
	}

	function activeEmployeeList() {
		$active_status = 1;
		$result = $this->m_hr->getEmployees($active_status);
		foreach ($result as $key => $value) {
			$data["row"][] = array(
				'emp_nip' 		   => $value->emp_nip,
				'emp_fullname'   => $value->emp_fullname,
				'emp_branch'   	 => $value->emp_branch,
				'dept_division'  => $value->dept_division,
				'dept_position'  => $value->dept_position,
				'emp_date_entry' => $value->emp_date_entry,
				'user_active'    => $value->user_active,
				'user_flag_editprofile' => $value->user_flag_editprofile
			);
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_list_all_employee', $data);
		$this->load->view('templates/footer');
	}

	function nonactiveEmployeeList() {
		$data = array();
		$active_status = 0;
		$result = $this->m_hr->getEmployees($active_status);
		foreach ($result as $key => $value) {
			$data["row"][] = array(
				'emp_nip' 		   => $value->emp_nip,
				'emp_fullname'   => $value->emp_fullname,
				'emp_branch'   	 => $value->emp_branch,
				'dept_division'  => $value->dept_division,
				'dept_position'  => $value->dept_position,
				'emp_date_entry' => $value->emp_date_entry,
				'user_active'    => $value->user_active
			);
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/hr_list_all_employee', $data);
		$this->load->view('templates/footer');
	}

}
?>
