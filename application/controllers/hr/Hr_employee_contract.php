<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_employee_contract extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('M_hr');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }


  function index($alert='') {
    $data = array();
    if (!empty($alert)) {
      $data["alert"] = 'New Contract is added';
    }
    $getContractList = $this->M_hr->getContracts($id='');
    foreach ($getContractList as $key => $value) {
      $data["contract_list"][] = array(
        'contract_id'   => $value->contract_id,
        'master_nip'    => $value->master_nip,
        'emp_fullname'  => $value->emp_fullname,
        'contract_file' => $value->contract_file,
        'contract_signed_date' => $value->contract_signed_date,
        'contract_end_date'    => $value->contract_end_date,
        'dept_position' => $value->dept_position,
      );
    }

    $selectEmp = $this->M_hr->getEmployeeSelect();
    // var_dump($result); exit();
    foreach ($selectEmp as $key => $value) {
      $data["emp_list"][] = array(
        'emp_nip'      => $value->emp_nip,
        'emp_fullname' => $value->emp_fullname,
      );
    }

		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/employee/hr_contract_index', $data);
    $this->load->view('templates/footer');
  }

  function insert_contract() {
    $nip         = $this->input->post('master_nip');
    $signed_date = $this->input->post('contract_signed_date');
    $end_date    = $this->input->post('contract_end_date');

    //Upload Image
    $config['upload_path']   = './assets/uploads/emp_contracts';
    $config['allowed_types'] = 'jpg|jpeg|pdf|png';
    $config['max_size']      = 20000;
    $config['max_width']     = 9000;
    $config['max_height']    = 9000;
    $config['file_name'] 		 = $_FILES['contract_file']['name'];

    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('contract_file')) {
      $alert = 0;
       // echo $this->upload->display_errors();
      // echo $awb.' gagal'; exit();
    } else {
      // echo $awb.' sukses'; exit();
      $uploadData    = $this->upload->data();
      $imageLocation = $uploadData['file_name'];
      $data = array(
        'master_nip'           => $nip,
        'contract_signed_date' => $signed_date,
        'contract_end_date'    => $end_date,
        'contract_file'        => $imageLocation,
				'contract_stampuser'   => $this->session->userdata('user_fullname'),
				'contract_stampdate'   => DATE('Y-m-d')
      );
      // var_dump($data); exit();
      $this->M_hr->InsertContract($data);
      // echo "berhasil upload"; exit();


			// TO DO update master contract when insert new contract
			$sumContractDetail = $this->M_hr->count_contract_detail($nip); // TO DO make a model
			// echo $sumContractDetail->SumOfContract; exit();
			$updateMastercontract = array(
				'contract_signed_date' => $signed_date,
				'contract_end_date' 	 => $end_date,
				'contract_stampuser' 	 => $this->session->userdata('user_fullname'),
				'contract_stampdate' 	 => DATE('Y-m-d'),
				'mastercountcontract'  => $sumContractDetail->SumOfContract
			);
			$this->M_hr->updateMasterContract($nip, $updateMastercontract);
    }
		// $this->m_attendance->InsertPermit($insertPermit);
		$alert = "success";
		redirect('hr/Hr_employee_contract/index/'.$alert);
  }

  function edit_contract($id='') {
    $contract_id = $id;

    $getContractList = $this->M_hr->getContracts($contract_id);
    foreach ($getContractList as $key => $value) {
      $data = array(
        'contract_id'   => $value->contract_id,
        'master_nip'    => $value->master_nip,
        'emp_fullname'  => $value->emp_fullname,
        'contract_file' => $value->contract_file,
        'contract_signed_date' => $value->contract_signed_date,
        'contract_end_date'    => $value->contract_end_date,
        'dept_position' => $value->dept_position,
      );
    }

    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/employee/hr_contract_edit', $data);
    $this->load->view('templates/footer');
  }

  function update_contract() {
    $contract_id          = $this->input->post('contract_id');
    $contract_signed_date = $this->input->post('contract_signed_date');
    $contract_end_date    = $this->input->post('contract_end_date');
    $old_contract_file    = $this->input->post('old_contract_file');

    //Upload Image
    $config['upload_path']   = './assets/uploads/emp_contracts';
    $config['allowed_types'] = 'jpg|jpeg|pdf|png';
    $config['max_size']      = 2000;
    $config['max_width']     = 9000;
    $config['max_height']    = 9000;
    $config['file_name'] 		 = $_FILES['contract_file']['name'];

    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('contract_file')) {
      $alert = 0;
       // echo $this->upload->display_errors();
      // echo $awb.' gagal'; exit();
    } else {
      // echo $awb.' sukses'; exit();
      $uploadData    = $this->upload->data();
      $imageLocation = $uploadData['file_name'];
      $data = array(
        'contract_signed_date' => $contract_signed_date,
        'contract_end_date'    => $contract_end_date,
        'contract_file'        => $imageLocation,
				'contract_stampuser'   => $this->session->userdata('user_fullname'),
				'contract_stampdate'   => DATE('Y-m-d')
      );
      // var_dump($data); exit();
      $this->M_hr->unlinkContractFIle($old_contract_file, $contract_id);
      $this->M_hr->updateContract($data, $contract_id);
      $alert = "success";
    }

		redirect('hr/Hr_employee_contract/index/'.$alert);
  }

}
?>
