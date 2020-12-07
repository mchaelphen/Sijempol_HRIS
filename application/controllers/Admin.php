<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
    parent::__construct();
		$this->load->model('M_login');
		$this->load->model('m_profile');
  }

	public function index($alert = "") {
		$data = array();
		if ($alert == 3) {
			$data["alert"] = 3;
		}

		$this->load->view('templates/header');
		$this->load->view('templates/login_admin', $data);
		$this->load->view('templates/footer');
	}

	function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUserExistance = $this->M_login->getAdminData($username, md5($password))->num_rows();
		if ($checkUserExistance == 1) {
			$getUserData = $this->M_login->getAdminData($username, md5($password))->row();

			$data_session = array(
				'user_id'       				=> $getUserData->user_id,
				'user_name'     				=> $getUserData->user_name,
				'user_fullname' 				=> $getUserData->user_fullname,
				'user_role'  						=> $getUserData->user_role,
				'user_active'   				=> $getUserData->user_active,
				'user_flag_editprofile' => $getUserData->user_flag_editprofile,
				'date_today'    				=> DATE('l, j F Y'),
				'dept_level'						=> $getUserData->dept_level,
				'dept_manager'					=> $getUserData->dept_manager,
				'status'								=> 'admin_login'
			);
			// var_dump($data_session); exit();
			if ($getUserData->user_active != 0) { //user is active
				$this->session->set_userdata($data_session);

				$nip = base64_encode($getUserData->user_name);

				// update attendance console pairing field currentday
				$this->db->query("UPDATE attendance_consolepairing a SET pairingcurday = dayname(DATE(pairingdate)) WHERE !isnull(a.pairingDate);");
				$this->db->query("UPDATE attendance_consolepairing SET pairingstatus = 'working' WHERE !isnull(pairingtimeout) AND !isnull(pairingtimein);");
				$this->db->query("UPDATE attendance_consolepairing SET pairingstatus = 'no_in' WHERE isnull(pairingtimein) AND !isnull(pairingtimeout);");
				$this->db->query("UPDATE attendance_consolepairing SET pairingstatus = 'no_out' WHERE isnull(pairingtimeout) AND !isnull(pairingtimein);");
				$this->db->query("UPDATE attendance_consolepairing SET pairingstatus = 'no_working' WHERE isnull(pairingtimein) AND isnull(pairingtimeout);");
				// end update attendance console pairing field currentday

        $this->admin_dashboard($nip);
			} else {
				$alert = 2;
				$data["alert"] = "This account access is disabled.";
				$this->load->view('templates/header');
				$this->load->view('templates/login_admin', $data);
				$this->load->view('templates/footer');
			}
		} else {
			$alert = 1;
			$data["alert"] = "Wrong username or password combination.";
			$this->load->view('templates/header');
			$this->load->view('templates/login_admin', $data);
			$this->load->view('templates/footer');
		}

	}

	function logout() {
    $this->session->sess_destroy();
    redirect(base_url().'Authentication');
  }

	function admin_dashboard($nip) {
		$nip = base64_decode($nip);
		$profile_picture = $this->m_profile->getProfilePic($nip);
		$data = array('emp_profile_pic' => $profile_picture->emp_profile_pic);
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('templates/footer');
		$this->load->view('dashboard/admin_dashboard', $data);
	}

	// function employee_dashboard($nip) {
	// 	$nip = base64_decode($nip);
	// 	$profile_picture = $this->m_profile->getProfilePic($nip);
	// 	$data = array('emp_profile_pic' => $profile_picture->emp_profile_pic);
	// 	$this->load->view('templates/header');
	// 	$this->load->view('templates/nav');
	// 	$this->load->view('templates/footer');
	// 	$this->load->view('dashboard/employee_dashboard', $data);
	// }

  function register($alert = "") {
		$data = array();
		if ($alert == 1) {
			$data["alert"] = "User not found. Unable to register as admin.";
		} elseif ($alert == 2) {
			$data["alert"] = "This user is already registered as admin.";
		}
    $this->load->view('templates/header');
		$this->load->view('templates/register_admin', $data);
		$this->load->view('templates/footer');
  }

	function register_new() {
		$user_role = $this->input->post('user_role');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// var_dump($checkUser->row());
		// exit();
		$checkUserRegistered = $this->M_login->checkBeforeRegister($username);
		if ($checkUserRegistered->num_rows() == 1) {

			$checkAdminDuplicate = $this->M_login->checkDuplicateAdmin($username);
			if ($checkAdminDuplicate->num_rows() == 0) {
				$result = $checkUserRegistered->row();
				$insertNewAdmin = array(
					'user_name' 		=> $username,
					'user_pass' 		=> md5($password),
					'user_fullname' => $result->user_fullname,
					'user_role' 		=> $user_role,
					'user_active' 	=> 1,
					'user_flag_editprofile' => 1,
				);
				$this->M_login->insertNewAdmin($insertNewAdmin);
				$alert = 3;
				redirect('admin/index/'.$alert);
			} else {
				$alert = 2;
				redirect('admin/register/'.$alert);
			}
		} else {
			$alert = 1;
			redirect('admin/register/'.$alert);
		}
	}

}
?>
