<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_mastering_massleave extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('m_massleave');

		if ($this->session->userdata('status') == '') {
			redirect('Admin');
		}
  }

  function index() {
		$data = array();
    $year = date("Y");
		$data["year"] = $year;

    $getmassleave = $this->m_massleave->getCurrentYearmassleave($year);
    // var_dump($getEmpOT); exit();
    foreach ($getmassleave as $key => $value) {
  		$data["massleavelist"][] = array(
  			'massleave_id' 				=> $value->massleave_id,
	  		'massleave_date' 			=> $value->massleave_date,
  			'massleave_year' 			=> $value->massleave_year,
  			'massleave_title' 	  => $value->massleave_title,
  			'massleave_stampuser' => $value->massleave_stampuser,
  			'massleave_stampdate' => $value->massleave_stampdate
  		);
  	}
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('hr/mastering/hr_massleave', $data);
    $this->load->view('templates/footer');
  }

  function insert_massleave() {
    $massleave_title = $this->input->post('massleave_title');
    $massleave_date  = $this->input->post('massleave_date');
    $massleave_year  = date('Y', strtotime($massleave_date));
    // var_dump($massleave_year); exit();
    $insertmassleave = array(
      'massleave_id' 	    	=> $massleave_id,
      'massleave_title' 		=> $massleave_title,
      'massleave_date' 			=> $massleave_date,
      'massleave_year'      => $massleave_year,
      'massleave_stampuser' => $this->session->userdata('user_fullname'),
      'massleave_stampdate' => date('Y-m-d h:i:s'),
    );
    $this->m_massleave->Insertmassleave($insertmassleave);
    redirect('hr/hr_mastering_massleave');
  }

  function delete_massleave($id) {
    $this->m_massleave->Deletemassleave($id);
    redirect('hr/hr_mastering_massleave');
  }



}
?>
