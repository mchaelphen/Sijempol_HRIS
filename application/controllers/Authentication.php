<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('M_login');
		$this->load->model('m_profile');
		$this->load->model('m_leave');
		$this->load->model('m_officeHour');
  }

	public function index($alert = "") {
		$data["alert"] = "";
		$this->load->view('templates/header');
		$this->load->view('templates/login', $data);
		$this->load->view('templates/footer');
	}

	function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUserExistance = $this->M_login->getUserData($username, md5($password))->num_rows();
		if ($checkUserExistance == 1) {
			$getUserData = $this->M_login->getUserData($username, md5($password))->row();

			$data_session = array(
				'user_id'       				=> $getUserData->user_id,
				'user_name'     				=> $getUserData->user_name,
				'user_fullname' 				=> $getUserData->user_fullname,
				'user_role'  						=> $getUserData->user_role,
				'user_active'   				=> $getUserData->user_active,
				'user_flag_editprofile' => $getUserData->user_flag_editprofile,
				'user_flag_attendanceonline'  => $getUserData->user_flag_attendanceonline,
				'user_flag_attendancemanager' => $getUserData->user_flag_attendancemanager,
				'date_today'    				=> DATE('l, j F Y'),
				'dept_name'							=> $getUserData->dept_name,
				'dept_subname'					=> $getUserData->dept_subname,
				'dept_position'					=> $getUserData->dept_position,
				'dept_level'						=> $getUserData->dept_level,
				'dept_manager'					=> $getUserData->dept_manager,
				'emp_branch'						=> $getUserData->emp_branch,
				'emp_office_hour'				=> $getUserData->emp_office_hour,
				'status'								=> 'staff_login'
			);

			// var_dump($data_session); exit();
			if ($getUserData->user_active != 0) { //user is active
				$this->session->set_userdata($data_session);
				$nip 				= base64_encode($getUserData->user_name);
				$emp_branch = $getUserData->emp_branch;

				if ($getUserData->user_role < 4) {
					$this->admin_dashboard($nip);
				} else {
					$this->employee_dashboard($nip, $emp_branch);
				}
			} else {
				$alert = 2;
				$data["alert"] = "This account access is disabled.";
				$this->load->view('templates/header');
				$this->load->view('templates/login', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$alert = 1;
			$data["alert"] = "Wrong username or password combination.";
			$this->load->view('templates/header');
			$this->load->view('templates/login', $data);
			$this->load->view('templates/footer');
		}

	}

	function logout() {
    $this->session->sess_destroy();
    redirect(base_url().'Authentication');
  }

	// function admin_dashboard($nip) {
	// 	$nip = base64_decode($nip);
	// 	$profile_picture = $this->m_profile->sgetProfilePic($nip);
	// 	$data = array('emp_profile_pic' => $profile_picture->emp_profile_pic);
	// 	$this->load->view('templates/header');
	// 	$this->load->view('templates/nav');
	// 	$this->load->view('templates/footer');
	// 	$this->load->view('dashboard/admin_dashboard', $data);
	// }

	function employee_dashboard($nip, $alert="") {
		$data = array();
		$nip  = base64_decode($nip);
		$year = DATE("Y");

		// Update leave Remaining (Sisa Cuti)
		$countCutiBersama = $this->m_leave->getCountCutiBersama($year);
    $infocuti = $this->m_leave->getEmpCuti($nip);

		$date = date("Y-m-d");
		$d1 	= strtotime($date);
		$d2 	= strtotime($infocuti->emp_date_entry);
		$totalSecondsDiff = abs($d1-$d2);
		$totalMonthsDiff  = floor($totalSecondsDiff/60/60/24/30);
		$totalYearsDiff   = floor($totalSecondsDiff/60/60/24/365);

    // Hak Cuti Setahun
    if ($totalMonthsDiff >= 12) {
      $cuti = $infocuti->emp_paid_leave_default - $countCutiBersama->cutibersama;
    } else {
      $cuti = 0;
    }

    // Rumus untuk karyawan Prorate
    if($cuti == 0) {
      $prorate = 0;
    } else {
      if($totalYearsDiff == 1) {
				$prorate = 24 - $totalMonthsDiff;
      } else {
				$prorate = 0;
      }
    }

    $countAmbilCuti = $this->m_leave->getCountAmbilCuti($nip, $year);
		if ($cuti == 0) {
			$sisaCuti = 0;
		} else {
			$sisaCuti = abs($cuti - $prorate) - $countAmbilCuti->cutiterambil;
		}
		$updateCuti = array(
      'emp_paid_leave' => $sisaCuti,
    );
    $this->m_leave->updateEmpPaidLeave($nip, $updateCuti);
		// END Update leave Remaining (Sisa Cuti)

		$profile_picture = $this->m_profile->getEmployeeProfile($nip);
		$countAmbilCuti  = $this->m_leave->getCountAmbilCuti($nip, $year);

		$data = array(
			'emp_profile_pic' => $profile_picture->emp_profile_pic,
			'emp_paid_leave'  => $profile_picture->emp_paid_leave,
			'emp_taken_leave' => !empty($countAmbilCuti->cutiterambil)?$countAmbilCuti->cutiterambil:"0"
		);

		// get online attendance
		$now 			 = DATE("Y-m-d");
		$yesterday =  DATE('Y-m-d', strtotime($now. ' - 1 days'));
		$type 		 = $this->session->userdata('emp_office_hour');

		$infoschedule = $this->m_officeHour->getScheduleInfoByType($type);

		// var_dump($infoschedule); exit();
		if ($this->session->userdata('user_flag_attendanceonline') == '1' && $this->session->userdata('emp_office_hour') != NULL) {
			if ($infoschedule->hourOver == 0) {
				// $checkAbsence = $this->m_officeHour->getAttendanceByDay($nip, $now);
				$checkAbsenceToday = $this->m_officeHour->getAttendanceByDay($nip, $now);
			} else {
				$checkAbsence = $this->m_officeHour->getAttendanceByDay($nip, $yesterday);
				// if ($checkAbsence->pairingTimeOut != NULL) {
					$checkAbsenceToday = $this->m_officeHour->getAttendanceByDay($nip, $now);
				// }
			}

			// var_dump($checkAbsence); exit();
			$data = array(
				'emp_profile_pic' => $profile_picture->emp_profile_pic,
				'emp_paid_leave'  => $profile_picture->emp_paid_leave,
				'emp_taken_leave' => !empty($countAmbilCuti->cutiterambil)?$countAmbilCuti->cutiterambil:"0",
				'pairingTimeIn'   => !empty($checkAbsence->pairingTimeIn)?$checkAbsence->pairingTimeIn:"-",
				'pairingTimeOut'  => !empty($checkAbsence->pairingTimeOut)?$checkAbsence->pairingTimeOut:"-",
				'pairingTimeInToday'  => !empty($checkAbsenceToday->pairingTimeIn)?$checkAbsenceToday->pairingTimeIn:"-",
				'pairingTimeOutToday' => !empty($checkAbsenceToday->pairingTimeOut)?$checkAbsenceToday->pairingTimeOut:"-",
			);
		}

		$data["alert"] = $alert;
		if (!empty($alert)) { //alert online attendance
			// echo $alert; exit();

			if ($alert == 1) {
				$data["message"] = "Clock In Success";
			} elseif ($alert == 2) {
				$data["message"] = "You are already clocked in!";
			} elseif ($alert == 3) {
				$data["message"] = "Clock Out Success";
			} elseif ($alert == 4) {
				$data["message"] = "You are not clocked in yet!";
			} elseif ($alert == 5) {
				$data["message"] = "You are already clocked out!";
			}
		}

		if ($this->session->userdata('emp_office_hour')) {
			$data["hourOver"] = $infoschedule->hourOver; // flag of employee with cross day shift
		} else {
			$data["alert"] = 6;
			$data["message"] = "Your Office Hour is not set. <br> Please ask HRD team to set your Office Hour Type.";
		}

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('templates/footer');
		$this->load->view('dashboard/employee_dashboard', $data);
	}

	function pushInAttendance() {
		$nip 			  = $this->session->userdata('user_name');
		$officeHour = $this->session->userdata('emp_office_hour');
		$now  			= DATE("Y-m-d");
		// echo $officeHour; exit();

		// get user IP
		$ip = $_SERVER['REMOTE_ADDR'];

		$checkAbsence = $this->m_officeHour->getAttendanceByDay($nip, $now);
		// var_dump($checkAbsence); exit();
		if ($checkAbsence == NULL) {
			// echo "belum pairing";
			$insertPairing = array(
				'pairingDate'   		=> DATE("Y-m-d"),
				'pairingMonth'  		=> DATE("m"),
				'pairingYear'   		=> DATE("Y"),
				'pairingNik'    		=> $nip,
				'pairingTimeIn' 		=> DATE("Y-m-d h:i:s"),
				'pairingTimeOffice' => $officeHour,
				'pairingStampDate' 	=> DATE("Y-m-d h:i:s"),
				'pairingStampUser' 	=> $this->session->userdata('user_fullname'),
				'pairingcurday' 		=> DATE('l'),
				'pairingUserIP' 		=> $ip,
			);
			$this->m_officeHour->insertAttendancePairing($insertPairing);
			$alert = 1;
		} elseif ($checkAbsence->pairingTimeIn == NULL) {
			// echo "belum absen";
			$updateTimeIn = array(
				'pairingTimeIn' 		=> DATE("Y-m-d h:i:s"),
				'pairingStampDate' 	=> DATE("Y-m-d h:i:s"),
				'pairingStampUser' 	=> $this->session->userdata('user_fullname'),
				'pairingcurday' 		=> DATE('l'),
				'pairingUserIP' 		=> $ip,
			);
			$where = array('pairingNik' => $nip, 'pairingDate' => $now,);

			$this->m_officeHour->updateAttendancePairing($where, $updateTimeIn);
			$alert = 1;
		} elseif (!empty($checkAbsence->pairingTimeIn)) {
			// error sudah absen
			$alert = 2;
		}

		$this->employee_dashboard(base64_encode($nip), $alert);
	}

	function pushOutAttendance() {
		$nip 			 = $this->session->userdata('user_name');
		$now			 = DATE("Y-m-d");
		$yesterday = DATE('Y-m-d', strtotime($now. ' - 1 days'));
		$type 		 = $this->session->userdata('emp_office_hour');

		// get user ip
		$ip = $_SERVER['REMOTE_ADDR'];

		$infoschedule = $this->m_officeHour->getScheduleInfoByType($type);
		// var_dump($infoschedule); exit();
		if ($infoschedule->hourOver == 0) {
			$checkAbsence = $this->m_officeHour->getAttendanceByDay($nip, $now);

			if ($checkAbsence->pairingTimeOut == NULL && $checkAbsence->pairingTimeIn != NULL) {
				// echo "sudah absen masuk";
				$updateTimeOut = array (
					'pairingTimeOut' 		=> DATE("Y-m-d h:i:s"),
					'pairingStampDate' 	=> DATE("Y-m-d h:i:s"),
					'pairingStampUser' 	=> $this->session->userdata('user_fullname'),
					'pairingUserIPOut' 	=> $ip,
				);
				$where = array('pairingNik' => $nip, 'pairingDate' => $now,);

				$this->m_officeHour->updateAttendancePairing($where, $updateTimeOut);
				$alert = 3; // success clock out
			} elseif ($checkAbsence->pairingTimeIn == NULL) {
				// echo "belum absen masuk";
				$alert = 4; // failed clock out, not yet clocked in.
			} elseif ($checkAbsence->pairingTimeOut != NULL) {
				$alert = 5; // failed. already clocked out.
			}
		} else {
			$checkAbsence = $this->m_officeHour->getAttendanceByDay($nip, $yesterday);
			if ($checkAbsence->pairingTimeOut == NULL) {
				$updateTimeOut = array (
					'pairingTimeOut' 		=> DATE("Y-m-d h:i:s"),
					'pairingStampDate' 	=> DATE("Y-m-d h:i:s"),
					'pairingStampUser' 	=> $this->session->userdata('user_fullname'),
					'pairingUserIPOut' 	=> $ip,
				);
				$where = array('pairingNik' => $nip, 'pairingDate' => $yesterday,);

				$this->m_officeHour->updateAttendancePairing($where, $updateTimeOut);
				$alert = 3; // success clock out for cross day employee
			} else {
				$alert = 5;
			}
		}

		$this->employee_dashboard(base64_encode($nip), $alert);
	}

}
?>
