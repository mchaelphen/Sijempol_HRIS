<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_attendance_medicleave extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_medicleave');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }
	// IZIN
  function medicalleave($alert = "") {
		$data["title"] = "Sick Leave";
		$data["link"]  = "medicleave";

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_periodsearch', $data);
    $this->load->view('templates/footer');
  }

	function medicleaveResult() {
		$startDate = $this->input->post('start_date');
		$endDate 	 = $this->input->post('end_date');

		$data = array();
		if (!empty($alert)) {
			$data["alert"] = "Medical History submitted.";
		}

		$medlev = $this->m_medicleave->getAllMedLev($startDate, $endDate);
    // var_dump($medlev); exit();
		foreach ($medlev as $key => $value) {
			$data["userMedic"][] = array(
				'emp_fullname'		  => $value->emp_fullname,
				'medic_id'					=> $value->medic_id,
				'master_nip'				=> $value->master_nip,
				'medic_from' 				=> $value->medic_from,
				'medic_to' 					=> $value->medic_to,
				'medic_days' 				=> $value->medic_days,
				'medic_remark' 			=> $value->medic_remark,
				'medic_upload'      => $value->medic_upload,
				'medic_manager_nip' => $value->medic_manager_nip,
				'medic_request_date'=> $value->medic_request_date,
				'medic_hr_approval_flag' => $value->medic_hr_approval_flag,
				'medic_hr_approval_date' => $value->medic_hr_approval_date
			);
		};
		// var_dump($data); exit();

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_medical_leave', $data);
    $this->load->view('templates/footer');
	}

  function editMedicalLeave($id) {
    $result = $this->m_medicleave->getMedicbyId($id);
    $data = array(
      'emp_fullname'		  => $result->emp_fullname,
      'medic_id'					=> $result->medic_id,
      'master_nip'				=> $result->master_nip,
      'medic_from' 				=> $result->medic_from,
      'medic_to' 					=> $result->medic_to,
      'medic_days' 				=> $result->medic_days,
      'medic_remark' 			=> $result->medic_remark,
      'medic_upload'      => $result->medic_upload,
      'medic_manager_nip' => $result->medic_manager_nip,
    );

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/attendance/hr_medical_leave_edit', $data);
    $this->load->view('templates/footer');
  }

  function updateMedical() {
    $medic_id   = $this->input->post('medic_id');
    $medic_from = $this->input->post('medic_from');
    $medic_to   = $this->input->post('medic_to');
    $medic_days = $this->input->post('medic_days');
    $oldimage  = $this->input->post('old_image');

    //Upload Image
    $config['upload_path']   = './assets/uploads/attendance_medicalleave';
    $config['allowed_types'] = 'jpg|jpeg|pdf|png';
    $config['max_size']      = 2000;
    $config['max_width']     = 9000;
    $config['max_height']    = 9000;
    $config['file_name'] 		 = $_FILES['medic_upload']['name'];

    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('medic_upload')) {
      $alert = 0;
       // echo $this->upload->display_errors();
      // echo $awb.' gagal'; exit();
    } else {
      // echo $awb.' sukses'; exit();
      $uploadData    = $this->upload->data();
      $imageLocation = $uploadData['file_name'];
      $data = array(
        'medic_from'        => $medic_from,
        'medic_to'          => $medic_to,
        'medic_days'        => $medic_days,
        'medic_upload'      => $imageLocation
      );
      // var_dump($data); exit();
      $this->m_medicleave->updateMedic($oldimage, $data, $medic_id);
    }
		// $this->m_attendance->InsertPermit($insertPermit);
		$alert = "success";
		redirect('hr/hr_attendance_medicleave/medicalleave/'.$alert);

  }

	function approve_sickleave($id) {
		$medic_id = $id;
		$data = array(
			'medic_hr_approval_flag' => 2,
			'medic_hr_approval_date' => DATE('Y-m-d H:i:s'),
		);
		$this->m_medicleave->updateApproval($id, $data);
		redirect('hr/hr_attendance_medicleave/medicalleave/');
	}

	function decline_sickleave($id) {
		$medic_id = $id;
		$data = array(
			'medic_hr_approval_flag' => 3,
			'medic_hr_approval_date' => DATE('Y-m-d H:i:s'),
		);
		$this->m_medicleave->updateApproval($id, $data);
		redirect('hr/hr_attendance_medicleave/medicalleave/');
	}


}
?>
