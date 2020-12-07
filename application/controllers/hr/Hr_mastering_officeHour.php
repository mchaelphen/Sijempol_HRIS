<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_mastering_officeHour extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_officeHour');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function index() {
		$data = array();

    $getSchedule = $this->m_officeHour->getAllSchedule();
    // var_dump($getEmpOT); exit();
    foreach ($getSchedule as $key => $value) {
  		$data["scheduleList"][] = array(
  			'hourId' 				=> $value->hourId,
	  		'hourType' 			=> $value->hourType,
  			'hourName' 			=> $value->hourName,
  			'hourTimeIn' 	  => $value->hourTimeIn,
  			'hourTimeOut'   => $value->hourTimeOut,
	      'hourOver'			=> $value->hourOver,
  			'hourlate'      => $value->hourlate,
  			'hourStampUser' => $value->hourStampUser,
  			'hourStampDate' => $value->hourStampDate
  		);
  	}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/mastering/hr_office_hour', $data);
    $this->load->view('templates/footer');
  }

  function insert_schedule() {
    $hourType 		= $this->input->post('hourType');
    $hourName 	  = $this->input->post('hourName');
    $hourTimeIn   = $this->input->post('hourTimeIn');
    $hourTimeOut	= $this->input->post('hourTimeOut');
    $hourlate  		= $this->input->post('hourlate');
    $hourOver  		= $this->input->post('hourOver');

    // var_dump($holiday_year); exit();
    $insertSchedule = array(
      'hourType' 	  => $hourType,
      'hourName' 		=> $hourName,
      'hourTimeIn' 	=> $hourTimeIn,
      'hourTimeOut'	=> $hourTimeOut,
      'hourOver'		=> $hourOver,
      'hourlate'    => $hourlate,
      'hourStampUser' => $this->session->userdata('user_fullname'),
      'hourStampDate' => date('Y-m-d h:i:s'),
			'fixtime'			=> '10:00:00'
    );
		// var_dump($insertSchedule); exit();
    $this->m_officeHour->InsertSchedule($insertSchedule);
    redirect('hr/Hr_mastering_officeHour');
  }

	function edit_schedule($id) {
		$scheduleInfo = $this->m_officeHour->getScheduleInfo($id);
		$data = array(
			'hourId' 				=> $scheduleInfo->hourId,
			'hourType' 			=> $scheduleInfo->hourType,
			'hourName' 			=> $scheduleInfo->hourName,
			'hourTimeIn' 	  => $scheduleInfo->hourTimeIn,
			'hourTimeOut'   => $scheduleInfo->hourTimeOut,
			'hourOver'			=> $scheduleInfo->hourOver,
			'hourlate'      => $scheduleInfo->hourlate,
		);
		// var_dump($data); exit();
		$this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/mastering/hr_office_hour_edit', $data);
    $this->load->view('templates/footer');
	}

  function update_schedule() {
		$hourId 		 = $this->input->post('hourId');
		$hourName 	 = $this->input->post('hourName');
		$hourTimeIn  = $this->input->post('hourTimeIn');
		$hourTimeOut = $this->input->post('hourTimeOut');
		$hourOver 	 = $this->input->post('hourOver');

		$updateSchedule = array(
			'hourName' 		=> $hourName,
			'hourTimeIn'  => $hourTimeIn,
			'hourTimeOut' => $hourTimeOut,
			'hourOver' 		=> $hourOver,
			'hourStampUser' => $this->session->userdata('user_fullname'),
			'hourStampDate' => date('Y-m-d h:i:s'),
		);
    $this->m_officeHour->update_schedule($hourId, $updateSchedule);
    redirect('hr/Hr_mastering_officeHour');
  }



}
?>
