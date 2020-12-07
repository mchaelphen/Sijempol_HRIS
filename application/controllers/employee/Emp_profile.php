<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_profile extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_profile');
		$this->load->model('m_hr');

		if ($this->session->userdata('status') == '') {
			redirect('Authentication');
		}
  }

	function index($nip) {
		$nip  = base64_decode($nip);
		$getEmpProfile 	  = $this->m_profile->getEmployeeProfile($nip);
		$getEmpDepartment = $this->m_profile->getEmployeeDepartment($nip);
		$getEmpEducation  = $this->m_profile->getEmployeeEducation($nip);
		$getEmpFamily     = $this->m_profile->getEmployeeFamily($nip);
		// var_dump($getEmpFamily); exit();

		$getManager = $this->m_profile->getManagerInfo($getEmpDepartment->dept_manager);

		$data = array(
			'emp_id'     				=> $getEmpProfile->emp_id,
			'emp_nip'     			=> $getEmpProfile->emp_nip,
			'emp_fullname'     	=> $getEmpProfile->emp_fullname,
			'emp_gender' 				=> $getEmpProfile->emp_gender,
			'emp_birthplace' 		=> $getEmpProfile->emp_birthplace,
			'emp_birthdate' 		=> $getEmpProfile->emp_birthdate,
			'emp_religion' 			=> $getEmpProfile->emp_religion,
			'emp_address' 			=> $getEmpProfile->emp_address,
			'emp_phone' 			  => !empty($getEmpProfile->emp_phone)?"$getEmpProfile->emp_phone":"-",
			'emp_email' 			  => !empty($getEmpProfile->emp_email)?"$getEmpProfile->emp_email":"-",
			'emp_last_edu_grade'=> $getEmpProfile->emp_last_edu_grade,
			'emp_marital_status'=> $getEmpProfile->emp_marital_status,
			'emp_designation' 	=> $getEmpProfile->emp_designation,
			'emp_contract' 			=> $getEmpProfile->emp_contract,
			'emp_bank_acc' 			=> $getEmpProfile->emp_bank_acc,
			'emp_bank_accname' 	=> $getEmpProfile->emp_bank_accname,
			'emp_date_entry' 		=> $getEmpProfile->emp_date_entry,
			'emp_date_resign' 	=> $getEmpProfile->emp_date_resign,
			'emp_resign_reason' => $getEmpProfile->emp_resign_reason,
			'emp_ktp_num'				=> !empty($getEmpProfile->emp_ktp_num)?"$getEmpProfile->emp_ktp_num":"-",
			'emp_ktp_img' 			=> $getEmpProfile->emp_ktp_img,
			'emp_kk_num'				=> !empty($getEmpProfile->emp_kk_num)?"$getEmpProfile->emp_kk_num":"-",
			'emp_kk_img' 				=> $getEmpProfile->emp_kk_img,
			'emp_npwp_num'			=> !empty($getEmpProfile->emp_npwp_num)?"$getEmpProfile->emp_npwp_num":"-",
			'emp_npwp_img' 			=> $getEmpProfile->emp_npwp_img,
			'emp_bpjsKes_num'		=> !empty($getEmpProfile->emp_bpjsKes_num)?"$getEmpProfile->emp_bpjsKes_num":"-",
			'emp_bpjsKes_img' 	=> $getEmpProfile->emp_bpjsKes_img,
			'emp_bpjsTkj_num'		=> !empty($getEmpProfile->emp_bpjsTkj_num)?"$getEmpProfile->emp_bpjsTkj_num":"-",
			'emp_bpjsTkj_img' 	=> $getEmpProfile->emp_bpjsTkj_img,
			'emp_simA_num'			=> !empty($getEmpProfile->emp_simA_num)?"$getEmpProfile->emp_simA_num":"-",
			'emp_simA_img' 			=> $getEmpProfile->emp_simA_img,
			'emp_simB_num'			=> !empty($getEmpProfile->emp_simB_num)?"$getEmpProfile->emp_simB_num":"-",
			'emp_simB_img' 			=> $getEmpProfile->emp_simB_img,
			'emp_simC_num'			=> !empty($getEmpProfile->emp_simC_num)?"$getEmpProfile->emp_simC_num":"-",
			'emp_simC_img' 			=> $getEmpProfile->emp_simC_img,
			'emp_ijazah_num'		=> !empty($getEmpProfile->emp_ijazah_num)?"$getEmpProfile->emp_ijazah_num":"-",
			'emp_ijazah_img' 		=> $getEmpProfile->emp_ijazah_img,
			'emp_profile_pic' 	=> $getEmpProfile->emp_profile_pic,
			'dept_division' 		=> !empty($getEmpDepartment->dept_division)?"$getEmpDepartment->dept_division":"-",
			'dept_name' 				=> !empty($getEmpDepartment->dept_name)?"$getEmpDepartment->dept_name":"-",
			'dept_subname' 			=> !empty($getEmpDepartment->dept_subname)?"$getEmpDepartment->dept_subname":"-",
			'dept_position' 		=> !empty($getEmpDepartment->dept_position)?"$getEmpDepartment->dept_position":"-",
			'dept_project' 			=> !empty($getEmpDepartment->dept_project)?"$getEmpDepartment->dept_project":"-",
			'dept_manager' 			=> !empty($getManager->emp_fullname)?"$getManager->emp_fullname":"-",
			'dept_manager_pic' 	=> !empty($getManager->emp_profile_pic)?"$getManager->emp_profile_pic":"-"
		);
		// echo $data["dept_manager_pic"]; exit();

		foreach ($getEmpEducation as $key => $value) {
			$data["education"][] = array (
				'edu_id'				 => $value->edu_id,
				'edu_grade' 		 => $value->edu_grade,
				'edu_grade_point'=> $value->edu_grade_point,
				'edu_major' 		 => $value->edu_major,
				'edu_schoolname' => $value->edu_schoolname,
				'edu_startyear'  => $value->edu_startyear,
				'edu_endyear' 	 => !empty($value->edu_endyear)?"$value->edu_endyear":"-"
			);
		}

		foreach ($getEmpFamily as $key => $value) {
			$data["family"][] = array (
				'fam_id'					 => $value->fam_id,
				'fam_fullname' 		 => $value->fam_fullname,
				'fam_relationship' => $value->fam_relationship,
				'fam_ktp_num' 		 => $value->fam_ktp_num,
				'fam_phone_num'		 => $value->fam_phone_num
			);
		}

		// var_dump($data["family"]); exit();
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/employee_profile', $data);
    $this->load->view('templates/footer');
	}

	function update_profile_contact() {
		$emp_nip		 = $this->session->userdata('user_name');
		$emp_email	 = $this->input->post('emp_email');
		$emp_phone	 = $this->input->post('emp_phone');
		$emp_address = $this->input->post('emp_address');

		$updateInfo = array(
			'emp_email' 	=> $emp_email,
			'emp_phone' 	=> $emp_phone,
			'emp_address' => $emp_address
		);
		// var_dump($updateInfo); exit();
		$this->m_profile->updateEmployee($updateInfo, $emp_nip);

		redirect('employee/emp_profile/index/'.base64_encode($emp_nip));
	}

	function update_personal_identification() {
		$nip = $this->input->post('emp_nip');
		$emp_ktp_num			= $this->input->post('emp_ktp_num');
		$emp_kk_num				= $this->input->post('emp_kk_num');
		$emp_npwp_num			= $this->input->post('emp_npwp_num');
		$emp_bpjsKes_num	= $this->input->post('emp_bpjsKes_num');
		$emp_bpjsTkj_num	= $this->input->post('emp_bpjsTkj_num');
		$emp_simA_num			= $this->input->post('emp_simA_num');
		$emp_simB_num			= $this->input->post('emp_simB_num');
		$emp_simC_num			= $this->input->post('emp_simC_num');
		$emp_ijazah_num			= $this->input->post('emp_ijazah_num');

		$data = array(
			'emp_ktp_num' 		=> $emp_ktp_num,
			'emp_kk_num' 			=> $emp_kk_num,
			'emp_npwp_num' 		=> $emp_npwp_num,
			'emp_bpjsKes_num' => $emp_bpjsKes_num,
			'emp_bpjsTkj_num' => $emp_bpjsTkj_num,
			'emp_simA_num' 		=> $emp_simA_num,
			'emp_simB_num' 		=> $emp_simB_num,
			'emp_simC_num' 		=> $emp_simC_num,
			'emp_ijazah_num' 	=> $emp_ijazah_num
		);
		$this->m_profile->updateEmployee($data, $nip);

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function upload_document($type) {
		$nip = $this->input->post('emp_nip');
		$documentType = $type;
		//Upload Image
		$config['upload_path']   = './assets/uploads/emp_'.$documentType;
		$config['allowed_types'] = 'jpg|jpeg|pdf|png';
		$config['max_size']      = 5000;
		$config['max_width']     = 5000;
		$config['max_height']    = 5000;
		$config['file_name'] 		 = $nip.'_'.$documentType; // ex: 12345678_ktp / 12345678_npwp
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('emp_'.$documentType.'_img')) {
			//$msg['error'] = true;
			$msg['type']  = 'error';
			$msg['notif'] = $this->upload->display_errors();
			// echo 'emp_'.$documentType.'_img'; exit();
		} else {
			// $data_foto   = $this->upload->data();
			// echo $this->upload->data('file_ext'); exit();
			$emp_doc_img = $nip.'_'.$documentType.$this->upload->data('file_ext');
			$data        = array('emp_'.$documentType.'_img' => $emp_doc_img);
			$this->m_profile->updateEmployee($data, $nip);
			$msg['success'] = true;
			$msg['type'] = 'add';
			// echo "berhasil upload"; exit();
		}

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function unlinkFile($type, $file_name, $nip) {
		// echo "asd"; exit();
		$this->m_profile->removeFile($type, $file_name, $nip);
		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function save_add_education() {
		$nip 						 = $this->input->post('emp_nip');
		$edu_grade			 = $this->input->post('edu_grade');
		$edu_grade_point = $this->input->post('edu_grade_point');
		$edu_major			 = $this->input->post('edu_major');
		$edu_schoolname  = $this->input->post('edu_schoolname');
		$edu_startyear	 = $this->input->post('edu_startyear');
		$edu_endyear		 = $this->input->post('edu_endyear');

		$addEducation = array(
			'master_nip' 			=> $nip,
			'edu_grade' 			=> $edu_grade,
			'edu_grade_point' => $edu_grade_point,
			'edu_major' 			=> $edu_major,
			'edu_schoolname' 	=> $edu_schoolname,
			'edu_startyear' 	=> $edu_startyear,
			'edu_endyear' 		=> $edu_endyear
		);
		// var_dump($addEducation); exit();
		$this->m_profile->insertEducation($addEducation);

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function form_edit_education($id, $nip) {
		if ($this->session->userdata('user_flag_editprofile') == 0) {
			// not allowed to update, redirect to profile
			redirect('employee/emp_profile/index/'.$nip);
		} else { //open form update
			$getEmpEducation = $this->m_profile->getEmployeeEducationDetail($id);
			// var_dump($getEmpEducation); exit();
			foreach ($getEmpEducation as $key => $value) {
				$data = array (
					'edu_id'				 => $value->edu_id,
					'edu_grade' 		 => $value->edu_grade,
					'edu_grade_point'=> $value->edu_grade_point,
					'edu_major' 		 => $value->edu_major,
					'edu_schoolname' => $value->edu_schoolname,
					'edu_startyear'  => $value->edu_startyear,
					'edu_endyear' 	 => !empty($value->edu_endyear)?"$value->edu_endyear":"-"
				);
			}
			$data["emp_nip"] = base64_decode($nip);

			$this->load->view('templates/header');
			$this->load->view('templates/nav');
			$this->load->view('employees/emp_form_edit_education', $data);
			$this->load->view('templates/footer');
		}
	}

	function save_edit_education() {
		$nip 						 = $this->input->post('emp_nip');
		$edu_id 				 = $this->input->post('edu_id');
		$edu_grade			 = $this->input->post('edu_grade');
		$edu_grade_point = $this->input->post('edu_grade_point');
		$edu_major			 = $this->input->post('edu_major');
		$edu_schoolname  = $this->input->post('edu_schoolname');
		$edu_startyear	 = $this->input->post('edu_startyear');
		$edu_endyear		 = $this->input->post('edu_endyear');

		$updateEducation = array(
			'edu_grade' 			=> $edu_grade,
			'edu_grade_point' => $edu_grade_point,
			'edu_major' 			=> $edu_major,
			'edu_schoolname' 	=> $edu_schoolname,
			'edu_startyear' 	=> $edu_startyear,
			'edu_endyear' 		=> $edu_endyear
		);
		// var_dump($addEducation); exit();
		$this->m_profile->updateEducation($updateEducation, $edu_id);

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function save_add_family() {
		$nip 						  = $this->input->post('emp_nip');
		$fam_fullname			= $this->input->post('fam_fullname');
		$fam_relationship = $this->input->post('fam_relationship');
		$fam_ktp_num			= $this->input->post('fam_ktp_num');
		$fam_phone_num  	= $this->input->post('fam_phone_num');

		$addFamily = array(
			'master_nip' 			 => $nip,
			'fam_fullname' 		 => $fam_fullname,
			'fam_relationship' => $fam_relationship,
			'fam_ktp_num' 		 => $fam_ktp_num,
			'fam_phone_num' 	 => $fam_phone_num
		);
		// var_dump($addFamily); exit();
		$this->m_profile->insertFamily($addFamily);

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function form_edit_family($id, $nip) {
		if ($this->session->userdata('user_flag_editprofile') == 0) {
			// not allowed to update, redirect to profile
			redirect('Employee/emp_profile/index/'.$nip);
		} else { //open form update
			$getEmpFamily = $this->m_profile->getEmployeeFamilyDetail($id);
			// var_dump($getEmpEducation); exit();
			foreach ($getEmpFamily as $key => $value) {
				$data = array (
					'fam_id'					 => $value->fam_id,
					'fam_fullname' 		 => $value->fam_fullname,
					'fam_relationship' => $value->fam_relationship,
					'fam_ktp_num' 		 => $value->fam_ktp_num,
					'fam_phone_num'		 => $value->fam_phone_num
				);
			}
			$data["emp_nip"] = base64_decode($nip);
			$this->load->view('templates/header');
			$this->load->view('templates/nav');
			$this->load->view('employees/emp_form_edit_family', $data);
			$this->load->view('templates/footer');
		}
	}

	function save_edit_family() {
		$nip 						  = $this->input->post('emp_nip');
		$fam_id 				  = $this->input->post('fam_id');
		$fam_fullname			= $this->input->post('fam_fullname');
		$fam_relationship = $this->input->post('fam_relationship');
		$fam_ktp_num			= $this->input->post('fam_ktp_num');
		$fam_phone_num  	= $this->input->post('fam_phone_num');

		$updateFamily = array(
			'fam_fullname' 		 => $fam_fullname,
			'fam_relationship' => $fam_relationship,
			'fam_ktp_num' 		 => $fam_ktp_num,
			'fam_phone_num' 	 => $fam_phone_num
		);
		// var_dump($addFamily); exit();
		// var_dump($updateFamily); exit();
		$this->m_profile->updateFamily($updateFamily, $fam_id);

		redirect('employee/emp_profile/index/'.base64_encode($nip));
	}

	function settings($nip="", $alert="") {
		// echo $nip; exit();
		if (!empty($nip)) {
			$nip = base64_decode($nip);
		}
		switch ($alert) {
			case '0':
				$data["notif"] = "Upload Gagal!";
				break;
			case '1':
				$data["notif"] = "Upload Berhasil!";
				break;
			case '2':
				$data["notif"] = "Password salah";
				break;
			case '3':
				$data["notif"] = "Konfirmasi Password salah";
				break;
			case '4':
				$data["notif"] = "Password berhasil di update";
				break;
			default:
				$alert="";
				break;
		}
		$data["alert"] = $alert;
		$emp_profile_pic = $this->m_profile->getProfilePic($nip);
		$data["emp_profile_pic"] = $emp_profile_pic->emp_profile_pic;

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/emp_form_settings', $data);
		$this->load->view('templates/footer');
	}

	function upload_profile_picture() {
		$nip = $this->session->userdata('user_name');
		$config['upload_path']   = './assets/uploads/emp_pic';
		$config['allowed_types'] = 'jpg|jpeg|pdf|png';
		$config['max_size']      = 1500;
		$config['max_width']     = 2000;
		$config['max_height']    = 2000;
		$config['file_name'] 		 = $nip.'_pic_'.DATE('y-m-d');

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('emp_profile_pic')) {
			// echo 'emp__img'; exit();
			$alert = '0';
		} else {
			// $data_foto   = $this->upload->data();
			$emp_doc_img = $nip.'_pic_'.DATE('y-m-d').$this->upload->data('file_ext');
			$data        = array('emp_profile_pic' => $emp_doc_img);
			$this->m_profile->updateEmployee($data, $nip);
			$alert = '1';
			// echo "berhasil upload"; exit();
		}

		redirect('employee/emp_profile/settings/'.base64_encode($nip).'/'.$alert);
	}

	function update_password() {
		$user_name 		= $this->input->post('user_name');
		$old_pass 		= $this->input->post('old_pass');
		$new_pass 		= $this->input->post('new_pass');
		$confirm_pass = $this->input->post('confirm_pass');

		$getPass = $this->m_profile->checkPassword($user_name);
		$checkPass = $getPass->user_pass;
		if (md5($old_pass) == $checkPass) {
			if ($new_pass == $confirm_pass) {
				$updatePass = array('user_pass' => md5($new_pass));
				$this->m_hr->UpdateUser($updatePass, $user_name);
				$alert = "4";
			} else { // error confirmation pass is not match
				$alert = "3";
			}
		} else { // error wrong password
			$alert = "2";
		}
		redirect('employee/emp_profile/settings/'.base64_encode($user_name).'/'.$alert);
	}

	function changeShift() {
		$nip = $this->session->userdata('user_name');
		$profile = $this->m_profile->getEmployeeProfile($nip);
		$data = array(
			'emp_nip' 		 => $profile->emp_nip,
			'emp_fullname' => $profile->emp_fullname,
			'shift' 			 => !empty($profile->emp_office_hour) ? $profile->emp_office_hour : '',
		);
		// var_dump($data); exit();

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('employees/emp_shift_setting', $data);
		$this->load->view('templates/footer');
	}

	function updateShift() {
		$emp_nip 				 = $this->input->post('emp_nip');
		$emp_fullname 	 = $this->input->post('emp_fullname');
		$emp_office_hour = $this->input->post('emp_office_hour');

		// if null selected, default value is n
		if (empty($emp_office_hour)) {
			$emp_office_hour = "n";
		}

		$updateShift = array(
			'emp_office_hour' => $emp_office_hour,
		);
		$this->m_profile->updateEmployee($updateShift, $emp_nip);

		redirect('employee/emp_profile/index/'.base64_encode($emp_nip));
	}

}
?>
