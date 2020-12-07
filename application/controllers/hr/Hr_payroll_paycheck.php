<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hr_payroll_paycheck extends CI_Controller {
	public function __construct() {
      parent::__construct();
			$this->load->model('m_payroll');

			if ($this->session->userdata('status') == '') {
				redirect('Admin');
			}
  }

	function index($dupeCounter="") {

    $data["dupeCount"] = $dupeCounter;
    if (!empty($dupeCounter)) {
      $data["message"] = "There are ".$dupeCounter." employees with already generated paycheck. [Ignored]";
    }

    // var_dump($data["row"]); exit();
		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/payroll/hr_payroll_generate_paycheck_form', $data);
		$this->load->view('templates/footer');
	}

  function generate_paycheck() {
    $start_date      = $this->input->post('start_date');
    $end_date        = $this->input->post('end_date');
    $emp_branch      = $this->input->post('emp_branch');
    $emp_designation = $this->input->post('emp_designation');
    $paycheck_month  = DATE("m",strtotime($end_date));
    $paycheck_year   = DATE("Y",strtotime($end_date));

    if ($emp_branch == "JKT") {
      $getEmployee = $this->m_payroll->getFilteredEmployees($emp_branch, $emp_designation);
    } else {
      $getEmployee = $this->m_payroll->getFilteredEmployeesBranch($emp_branch);
    }

		// var_dump($getEmployee); exit();

    $DupePaycheckCounter = 0; //Count already existed paycheck this month.
    foreach ($getEmployee as $key => $value) {
      $validateDupePaycheck = $this->m_payroll->checkDupePaycheck($value->emp_nip, $paycheck_month, $paycheck_year);
      if ($validateDupePaycheck == 0) {
        // Continue process paycheck

        // check overtime approved hour as per cut off
        $checkOvertime = $this->m_payroll->getOvertimeApprovedHour($value->emp_nip, $start_date, $end_date);
        if (empty($checkOvertime)) {
          $checkOvertime = 0;
        }

        $gajipokok = !empty($value->salary_main)?base64_decode($value->salary_main):0;
        $paycheckOvertime = round((1/173) * $gajipokok * $checkOvertime["approvedHour"], 0, PHP_ROUND_HALF_DOWN); // Round half down. 0.5 go down, 0.6 go up
				// End check overtime

				// Check Employee Late
				$totalLate = 0; //total late in minute from start date to end date
				$numberOfDaysLate = 0; // total of late frequency
				$totalHoliday = $totalPermit = $totalLeave = $totalSick = $totalAlpha = 0;

				$getEmployeeAttendance = $this->m_payroll->getEmployeeAttendance($value->emp_nip, $start_date, $end_date);
				foreach ($getEmployeeAttendance as $key => $pair) {
					if ($value->emp_designation == "PST") { // if back office pusat
						if ($pair->pairingcurday != "Saturday" && $pair->pairingcurday != "Sunday") { // only calculate weekday
							// echo $pair->pairingDate." ".$pair->pairingTimeIn."<br>";
							if (!empty($pair->pairingTimeIn)) {
								// take time from datetime in consolepairing
								$timeIn 			= new DateTime($pair->pairingTimeIn);
								$actualTimeIn = $timeIn->format('h:i:s');
								$lateinmin 		= floor($this->timeDiff($pair->hourTimeIn, $actualTimeIn)/60); //ignore seconds, only calculate minute
								if ($lateinmin > 0) {
									$totalLate += $lateinmin;
									$numberOfDaysLate += 1;
								}
							} else {
								$getHoliday		= $this->m_payroll->checkHoliday($pair->pairingDate);
								$getMassLeave	= $this->m_payroll->checkMassLeave($pair->pairingDate);
								$getPermit		= $this->m_payroll->checkPermittance($pair->pairingDate, $value->emp_nip);

								$inMonth = DATE("m",strtotime($start_date)).",".DATE("m",strtotime($end_date));

								$whereleave   = " WHERE a.master_nip= ".$value->emp_nip." AND a.leave_month IN(".$inMonth.") AND a.leave_manager_flag = 2";
								$getLeave			= $this->m_payroll->checkLeave($whereleave);
								$wheresick    = " WHERE a.master_nip= ".$value->emp_nip." AND a.medic_month IN(".$inMonth.") AND a.medic_hr_approval_flag = 2";
								$getSickLeave	= $this->m_payroll->checkSickLeave($wheresick);

								// count absence
								if ($getHoliday > 0 || $getMassLeave > 0) {
									$totalHoliday += 1;
								} elseif ($getPermit > 0) {
									$totalPermit += 1;
								} elseif (!empty($getLeave)) {
									foreach ($getLeave as $key => $leave) {
										$date = strtotime($pair->pairingDate);
										$from = strtotime($leave->leave_from);
										$to 	= strtotime($leave->leave_to);
										if ($date >= $from && $date <= $to) {
											$totalLeave += 1;
										}
									}
								} elseif (!empty($getSickLeave)) {
									foreach ($getSickLeave as $key => $med) {
										$date = strtotime($pair->pairingDate);
										$from = strtotime($med->medic_from);
										$to 	= strtotime($med->medic_to);
										if ($date >= $from && $date <= $to) {
											$totalSick += 1;
										}
									}
								} else {
									$totalAlpha += 1;
								}
								// end counting absence
							}
						}
					} else { // else operational
						if ($pair->pairingcurday != "Sunday") { // calculate weekday + saturday
							$getHoliday		= $this->m_payroll->checkHoliday($pair->pairingDate);
							$getMassLeave	= $this->m_payroll->checkMassLeave($pair->pairingDate);
							$getPermit		= $this->m_payroll->checkPermittance($pair->pairingDate, $value->emp_nip);

							$inMonth = DATE("m",strtotime($start_date)).",".DATE("m",strtotime($end_date));

							$whereleave   = " WHERE a.master_nip= ".$value->emp_nip." AND a.leave_month IN(".$inMonth.") AND a.leave_manager_flag = 2";
							$getLeave			= $this->m_payroll->checkLeave($whereleave);
							$wheresick    = " WHERE a.master_nip= ".$value->emp_nip." AND a.medic_month IN(".$inMonth.") AND a.medic_hr_approval_flag = 2";
							$getSickLeave	= $this->m_payroll->checkSickLeave($wheresick);

							// count absence
							if ($getHoliday > 0 || $getMassLeave > 0) {
								$totalHoliday += 1;
							} elseif ($getPermit > 0) {
								$totalPermit += 1;
							} elseif (!empty($getLeave)) {
								foreach ($getLeave as $key => $leave) {
									$date = strtotime($pair->pairingDate);
									$from = strtotime($leave->leave_from);
									$to 	= strtotime($leave->leave_to);
									if ($date >= $from && $date <= $to) {
										$totalLeave += 1;
									}
								}
							} elseif (!empty($getSickLeave)) {
								foreach ($getSickLeave as $key => $med) {
									$date = strtotime($pair->pairingDate);
									$from = strtotime($med->medic_from);
									$to 	= strtotime($med->medic_to);
									if ($date >= $from && $date <= $to) {
										$totalSick += 1;
									}
								}
							} else {
								$totalAlpha += 1;
							}
							// end counting absence
						}
					}
				}

				// echo $totalLate." ".$numberOfDaysLate;
				if ($value->dept_level == 'Staff' || $value->dept_level == 'Coordinator') {
					$lateCut 	  = $totalLate * 424;
					$absenceCut = $totalAlpha * 100000;
				} else {
					$specialAllowance = !empty(base64_decode($value->salary_specialallowance))?base64_decode($value->salary_specialallowance):0;
					$salaryKpi 				= !empty(base64_decode($value->salary_kpi))?base64_decode($value->salary_kpi):0;
					$managerCutPerLate 		= ($specialAllowance + $salaryKpi)/21/2; // price per late
					$managerCutPerAbsence = ($specialAllowance + $salaryKpi)/21; // price per absence
					$lateCut 		= $numberOfDaysLate * $managerCutPerLate;
					$absenceCut = $totalAlpha * $managerCutPerAbsence;
					// echo $lateCut." ".$numberOfDaysLate." ".$managerCutPerLate;
				}

				if ($totalLate <= 30) {
					$lateCut += 0;
				} elseif ($totalLate >= 31 && $totalLate <= 60) {
					$lateCut += 100000;
				} elseif ($totalLate >= 61 && $totalLate <= 120) {
					$lateCut += 300000;
				} elseif ($totalLate >= 121 && $totalLate <= 180) {
					$lateCut += 400000;
				} elseif ($totalLate >= 181) {
					$lateCut += 500000;
				}
				// echo "<br>".$lateCut." Menit: ".$totalLate."<br>";

				$getEmployeeLoan = $this->m_payroll->getEmployeeLoan($value->emp_nip, $paycheck_month, $paycheck_year);
				$loanCut = !empty($getEmployeeLoan->loandet_debtPaid)?$getEmployeeLoan->loandet_debtPaid:0;

				// Total Salary = $value->salary_total + paycheckOvertime - lateDeduct - absenceDeduct - loan deduct
        $salaryTotal = (!empty(base64_decode($value->salary_total))?base64_decode($value->salary_total):0) + $paycheckOvertime - $lateCut - $loanCut - $absenceCut;
        // echo $value->emp_nip." ".base64_decode($value->salary_total)." ".$paycheckOvertime." ".$salaryTotal."<br>".$lateCut;
				// exit();
        // array insert paycheck
        $InsertPaycheck = array(
          'master_nip'               => $value->emp_nip,
          'paycheck_startCutOff'     => $start_date,
          'paycheck_endCutOff'       => $end_date,
          'paycheck_month'           => $paycheck_month,
          'paycheck_year'            => $paycheck_year,
          'paycheck_overtimeHours'   => !empty($checkOvertime["approvedHour"])?$checkOvertime["approvedHour"]:0,
          'paycheck_overtimeBonus'   => base64_encode($paycheckOvertime),
          'paycheck_lateMinutes'  	 => $totalLate,
          'paycheck_lateFrequency'   => $numberOfDaysLate,
          'paycheck_lateDeduct'      => base64_encode($lateCut),
          'paycheck_loanDeduct'      => base64_encode($loanCut),
          'paycheck_leave'   				 => $totalLeave,
          'paycheck_sickleave'   		 => $totalSick,
          'paycheck_permit'   			 => $totalPermit,
          'paycheck_alpha'   				 => $totalAlpha,
          'paycheck_absenceDeduct'   => base64_encode($absenceCut),
          'paycheck_salaryMain'      => $value->salary_main,
          'paycheck_salaryAllowance' => $value->salary_specialallowance,
          'paycheck_salaryKpi'       => $value->salary_kpi,
          'paycheck_salaryTotal'     => base64_encode($salaryTotal),
					'paycheck_stampuser' 			 => $this->session->userdata('user_fullname'),
					'paycheck_stampdate' 			 => DATE('Y-m-d h:i:s')
        );
				// var_dump($InsertPaycheck); exit();
        $this->m_payroll->InsertPaycheck($InsertPaycheck);
      } else {
        // Ignore Duplicate if paycheck already exist
        $DupePaycheckCounter += 1;
      }
    } // end foreach employee
    redirect('hr/hr_payroll_paycheck/index/'.$DupePaycheckCounter);
  }

  // Form Show Paycheck List
  function formPaycheckList() {

		$this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/payroll/hr_payroll_paycheck_form');
		$this->load->view('templates/footer');
  }

  function getPaycheckList() {
    $data = array();
    $paycheck_month = $this->input->post('paycheck_month');
    $paycheck_year  = $this->input->post('paycheck_year');
    $emp_branch     = $this->input->post('emp_branch');
    $dept_level     = $this->input->post('dept_level');

    $getEmployeePaycheck = $this->m_payroll->getEmployeePaycheck($paycheck_month, $paycheck_year, $emp_branch, $dept_level);

    foreach ($getEmployeePaycheck as $key => $value) {
      $data["EmployeePayheckList"][] = array(
        'emp_nip'       => $value->master_nip,
        'emp_fullname'  => $value->emp_fullname,
        'dept_position' => $value->dept_position,
        'dept_level'    => $value->dept_level,
        'paycheck_month'=> $value->paycheck_month,
        'paycheck_year' => $value->paycheck_year,
        'paycheck_overtimeHours' => $value->paycheck_overtimeHours,
				'paycheck_overtimeBonus' => number_format(base64_decode($value->paycheck_overtimeBonus),2,",","."),
        'paycheck_lateFrequency' => $value->paycheck_lateFrequency,
        'paycheck_lateMinutes' 	 => $value->paycheck_lateMinutes,
        'paycheck_lateDeduct' 	 => number_format(base64_decode($value->paycheck_lateDeduct),2,",","."),
				'paycheck_leave'   			 => $value->paycheck_leave,
				'paycheck_sickleave'   	 => $value->paycheck_sickleave,
				'paycheck_permit'   		 => $value->paycheck_permit,
				'paycheck_alpha'   			 => $value->paycheck_alpha,
				'paycheck_absenceDeduct' => number_format(base64_decode($value->paycheck_absenceDeduct),2,",","."),
				'paycheck_loanDeduct'    => number_format(base64_decode($value->paycheck_loanDeduct),2,",","."),
        'paycheck_salaryTotal'   => number_format(base64_decode($value->paycheck_salaryTotal),2,",","."),
      );
    }

    $this->load->view('templates/header');
		$this->load->view('templates/nav');
		$this->load->view('hr/payroll/hr_payroll_paycheck_result', $data);
		$this->load->view('templates/footer');
  }

	function timeDiff($firstTime,$lastTime) {
		// convert to unix timestamps
		$firstTime = strtotime($firstTime);
		$lastTime  = strtotime($lastTime);

		// perform subtraction to get the difference (in seconds) between times
		$timeDiff = $lastTime-$firstTime;

		// return the difference
		return $timeDiff;
	}

}
?>
