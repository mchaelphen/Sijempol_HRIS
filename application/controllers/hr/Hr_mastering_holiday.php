<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_mastering_holiday extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_holiday');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function index() {
		$data = array();
    $year = date("Y");
		$data["year"] = $year;

    $getHoliday = $this->m_holiday->getCurrentYearHoliday($year);
    // var_dump($getEmpOT); exit();
    foreach ($getHoliday as $key => $value) {
  		$data["holidaylist"][] = array(
  			'holiday_id' 				=> $value->holiday_id,
	  		'holiday_date' 			=> $value->holiday_date,
  			'holiday_year' 			=> $value->holiday_year,
  			'holiday_title' 	  => $value->holiday_title,
  			'holiday_stampuser' => $value->holiday_stampuser,
  			'holiday_stampdate' => $value->holiday_stampdate
  		);
  	}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/mastering/hr_holiday', $data);
    $this->load->view('templates/footer');
  }

  function insert_holiday() {
    $holiday_title = $this->input->post('holiday_title');
    $holiday_date  = $this->input->post('holiday_date');
    $holiday_year  = date('Y', strtotime($holiday_date));
    // var_dump($holiday_year); exit();
    $insertHoliday = array(
      'holiday_id' 	    	=> $holiday_id,
      'holiday_title' 		=> $holiday_title,
      'holiday_date' 			=> $holiday_date,
      'holiday_year'      => $holiday_year,
      'holiday_stampuser' => $this->session->userdata('user_fullname'),
      'holiday_stampdate' => date('Y-m-d h:i:s'),
    );
    $this->m_holiday->InsertHoliday($insertHoliday);
    redirect('hr/hr_mastering_holiday');
  }

  function delete_holiday($id) {
    $this->m_holiday->DeleteHoliday($id);
    redirect('hr/hr_mastering_holiday');
  }



}
?>
