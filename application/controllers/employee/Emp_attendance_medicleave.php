<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_attendance_medicleave extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_medicleave');

			if ($this->session->userdata('status') == '') {
				redirect('Authentication');
			}
  }
	// IZIN
  function medicalleave($alert = "") {
		$data = array();
		if (!empty($alert)) {
			$data["alert"] = "Medical History submitted.";
		}

		$medlev = $this->m_medicleave->getUserMedlev($this->session->userdata('user_name'));
    // var_dump($medlev); exit();
		foreach ($medlev as $key => $value) {
			$data["userMedic"][] = array(
				'medic_id'					=> $value->medic_id,
				'master_nip'				=> $value->master_nip,
				'medic_from' 				=> $value->medic_from,
				'medic_to' 					=> $value->medic_to,
				'medic_days' 				=> $value->medic_days,
				'medic_remark' 			=> $value->medic_remark,
				'medic_upload'      => $value->medic_upload,
				'medic_manager_nip' => $value->medic_manager_nip,
				'medic_request_date'=> $value->medic_request_date,
				'medic_hr_approval_flag' => $value->medic_hr_approval_flag
			);
		};
		// var_dump($data); exit();

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('employees/attendance/medical_leave', $data);
    $this->load->view('templates/footer');
  }

	function insert_medicleave() {
		$master_nip 			  = $this->input->post('master_nip');
		$medic_manager_nip  = $this->input->post('medic_manager_nip');
		$medic_from 			  = $this->input->post('medic_from');
		$medic_to 				  = $this->input->post('medic_to');
		$medic_days 				= $this->input->post('medic_days');
		$medic_remark  			= $this->input->post('medic_remark');
    $medic_upload 			= $this->input->post('medic_upload');

    // $to_date   = strtotime($medic_to);
    // $from_date = strtotime($medic_from);
    // $datediff  = $to_date - $from_date;
    //
    // echo round($datediff / (60 * 60 * 24));

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
        'master_nip'        => $this->session->userdata('user_name'),
        'medic_manager_nip' => $medic_manager_nip,
				'medic_month' 			=> DATE("m",strtotime($medic_from)),
				'medic_year' 				=> DATE("Y",strtotime($medic_from)),
        'medic_from'        => $medic_from,
        'medic_to'          => $medic_to,
        'medic_days'        => $medic_days,
        'medic_remark'      => $medic_remark,
        'medic_upload'      => $imageLocation,
				'medic_hr_approval_flag' => 1,
				'medic_request_date' => DATE('Y-m-d')
      );
      // var_dump($data); exit();
      $this->m_medicleave->InsertMedicalLeave($data);
      // echo "berhasil upload"; exit();
    }
		// $this->m_attendance->InsertPermit($insertPermit);
		$alert = "success";
		redirect('employee/Emp_attendance_medicleave/medicalleave/'.$alert);
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
    $this->load->view('employees/attendance/medical_leave_edit', $data);
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
		redirect('employee/emp_attendance_medicleave/medicalleave/'.$alert);
  }

}
?>
