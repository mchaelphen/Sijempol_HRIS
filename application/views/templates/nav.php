<!-- Main Wrapper -->
<div class="main-wrapper">

  <!-- Header -->
  <div class="header">

    <!-- Logo -->
    <div class="header-left">
      <a href="#" class="logo">
        <img src="<?php echo base_url()?>assets/img/logo.png" width="40" height="40" alt="" />
      </a>
    </div>
    <!-- /Logo -->

    <a id="toggle_btn" href="javascript:void(0);">
      <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </a>

    <!-- Header Title -->
    <div class="page-title-box">
      <h3>Human Resources Information System </h3>
    </div>
    <!-- /Header Title -->
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">
      <li class="nav-item dropdown has-arrow main-drop">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
          <?php
            $query = "SELECT a.emp_profile_pic FROM employee a WHERE a.emp_nip=".$this->session->userdata('user_name');
            $pic = $this->db->query($query)->row();
          ?>
          <?php if (!empty($pic->emp_profile_pic)) { ?>
            <span class="user-img"><img src="<?php echo base_url().'assets/uploads/emp_pic/'.$pic->emp_profile_pic?>" alt="" />
          <?php } else { ?>
            <span class="user-img"><img src="<?php echo base_url().'assets/img/user.jpg'?>" alt="" />
          <?php } ?>
          <!-- <span class="status online"></span></span> -->
          <span><?php echo $this->session->userdata('user_fullname'); ?> </span>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo base_url().'employee/emp_profile/index/'.base64_encode($this->session->userdata('user_name'))?>">My Profile </a>
          <!-- <a class="dropdown-item" href="settings.html">Settings </a> -->
          <a class="dropdown-item" href="<?php echo base_url()?>Authentication/logout">Logout </a>
        </div>
      </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?php echo base_url().'employee/emp_profile/index/'.base64_encode($this->session->userdata('user_name'))?>">My Profile </a>
        <!-- <a class="dropdown-item" href="settings.html">Settings </a> -->
        <a class="dropdown-item" href="<?php echo base_url()?>Authentication/logout">Logout </a>
      </div>
    </div>
    <!-- /Mobile Menu -->

  </div>
  <!-- /Header -->

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
        <ul>
          <li class="menu-title">
            <span>Main </span>
          </li>
          <?php if ($this->session->userdata('user_role') == 4 ) { ?>
            <li><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>"> <i class="la la-dashboard"></i> &nbsp; &nbsp; Employee Dashboard </a></li>
          <?php } else { ?>
            <li><a href="<?php echo base_url().'Admin/admin_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>"> <i class="la la-dashboard"></i> &nbsp; &nbsp; Admin Dashboard </a></li>
          <?php } ?>

          <!-- General Employee -->
          <?php if ($this->session->userdata('user_role') == 4 ) { ?>
          <li class="menu-title">
            <span>Employees </span>
          </li>
          <li class="submenu">
            <a href="#" class="#noti-dot"><i class="la la-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="<?php echo base_url().'employee/emp_profile/index/'.base64_encode($this->session->userdata('user_name')) ?>">Profile </a></li>
            </ul>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-user"></i> <span> <i style="font-size:10.5pt; display:inline;">Attendance</i> (Kehadiran) </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="<?php echo base_url().'employee/Emp_attendance_permittance/permittance'?>"> <i style="font-size:10pt; display:inline;">Permittance</i> (Izin) </a></li>
              <li><a href="<?php echo base_url().'employee/Emp_attendance_medicleave/medicalleave'?>"> <i style="font-size:10pt; display:inline;">Sick Leave</i> (Sakit) </a></li>
              <li><a href="<?php echo base_url().'employee/Emp_attendance_leave/leave'?>"> <i style="font-size:10pt; display:inline;">Leave</i> (Cuti) </a></li>
              <li><a href="<?php echo base_url().'employee/Emp_attendance_overtime/overtime'?>"> <i style="font-size:10pt; display:inline;">Overtime</i> (Lembur) </a></li>
              <?php if ($this->session->userdata('dept_subname') == "Customer Service") { ?>
                <li><a href="<?php echo base_url().'employee/Emp_profile/changeShift'?>">Shift Setting</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php if ($this->session->userdata('user_flag_attendancemanager') == 1): ?>
          <li class="submenu">
            <a href="#" class="#noti-dot"><i class="la la-user"></i> <span> <i style="font-size:10.5pt; display:inline;">Attendance</i> (Manager) </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
                <li><a href="<?php echo base_url().'employee/Emp_attendance_permittance/permittance_manager'?>">Staff Permittance </a></li>
                <li><a href="<?php echo base_url().'employee/Emp_attendance_leave/leave_manager'?>">Staff Leave </a></li>
                <li><a href="<?php echo base_url().'employee/Emp_attendance_overtime/overtime_manager'?>">Staff Overtime </a></li>
                <li><a href="<?php echo base_url().'employee/Emp_attendance_overtime/overtime_history'?>">Staff Overtime History </a></li>
                <li><a href="<?php echo base_url().'employee/Emp_attendance_schedule/'?>">Staff Schedule </a></li>
            </ul>
          </li>
          <?php endif; ?>
          <?php } ?>
          <!-- END General Employee -->

          <!-- HR Admin Menu -->
          <?php if ($this->session->userdata('user_role') < 4 ) { ?>
          <li class="menu-title">
            <span>HR </span>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="<?php echo base_url().'hr/hr_employee'?>">All Employees </a></li>
              <li><a href="<?php echo base_url().'hr/hr_employee/activeEmployeeList'?>">Active Employees </a></li>
              <li><a href="<?php echo base_url().'hr/hr_employee/nonactiveEmployeeList'?>">Inactive Employees </a></li>
              <li><a href="<?php echo base_url().'hr/hr_employee_contract/'?>">Employee Contracts </a></li>
            </ul>
          </li>

          <li class="submenu">
            <a href="#"><i class="la la-group"></i> <span> Attendance </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <!-- <li><a href="<?php echo base_url().'hr/hr_employee/nonactiveEmployeeList'?>">Unactive Employees </a></li> -->
              <li><a href="<?php echo base_url().'hr/hr_attendance_permittance/permittance'?>"><i style="font-size:10pt; display:inline;">Permittance</i> (Izin)</a></li>
              <li><a href="<?php echo base_url().'hr/hr_attendance_medicleave/medicalleave'?>"><i style="font-size:10pt; display:inline;">Sick Leave</i> (Sakit)</a></li>
              <li><a href="<?php echo base_url().'hr/hr_attendance_leave/leave'?>"><i style="font-size:10pt; display:inline;">Leave</i> (Cuti)</a></li>
              <li><a href="<?php echo base_url().'hr/hr_attendance_overtime/overtime'?>"><i style="font-size:10pt; display:inline;">Overtime</i> (Lembur)</a></li>
            </ul>
          </li>

          <li class="submenu">
            <a href="#"><i class="la la-list"></i> <span> Report </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <!-- <li><a href="<?php echo base_url().'hr/hr_employee/nonactiveEmployeeList'?>">Unactive Employees </a></li> -->
              <li><a href="<?php echo base_url().'hr/hr_report_attendance/showFormReportAttendanceAll'?>">Attendance Report</a></li>
              <li><a href="<?php echo base_url().'hr/hr_report_overtime/showFormReportOvertime'?>">Overtime Report</a></li>
              <li><a href="<?php echo base_url().'hr/hr_report_contract/showFormReportContract'?>">Contracts Report</a></li>
            </ul>
          </li>

          <li class="submenu">
            <a href="#"><i class="la la-cogs"></i> <span> Mastering </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="<?php echo base_url().'hr/hr_mastering_holiday/'?>">Holidays</a></li>
              <li><a href="<?php echo base_url().'hr/hr_mastering_massleave/'?>">Mass Leave</a></li>
              <li><a href="<?php echo base_url().'hr/hr_mastering_officeHour/'?>">Office Hour</a></li>
            </ul>
          </li>

          <?php if ($this->session->userdata('user_role') < 3 ) { ?>
          <li class="submenu">
            <a href="#"><i class="la la-cogs"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="<?php echo base_url().'hr/hr_payroll_loan/'?>">Cooperation</a></li>
              <li><a href="<?php echo base_url().'hr/hr_payroll_minwage/'?>">UMP / UMK</a></li>
              <li><a href="<?php echo base_url().'hr/hr_payroll_salary/'?>">Employee Salary</a></li>
              <li><a href="<?php echo base_url().'hr/hr_payroll_paycheck/'?>">Generate Paycheck</a></li>
              <li><a href="<?php echo base_url().'hr/hr_payroll_paycheck/formPaycheckList'?>">Employee Paycheck</a></li>
            </ul>
          </li>
          <?php } ?>
          <!-- <li class="submenu">
            <a href="#"><i class="la la-files-o"></i>  <span> Accounts  </span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="estimates.html">Estimates </a></li>
              <li><a href="invoices.html">Invoices </a></li>
              <li><a href="payments.html">Payments </a></li>
              <li><a href="expenses.html">Expenses </a></li>
              <li><a href="provident-fund.html">Provident Fund </a></li>
              <li><a href="taxes.html">Taxes </a></li>
            </ul>
          </li> -->
          <!-- <li class="submenu">
            <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="salary.html"> Employee Salary </a></li>
              <li><a href="salary-view.html"> Payslip </a></li>
              <li><a href="payroll-items.html"> Payroll Items </a></li>
            </ul>
          </li> -->
          <!-- <li>
            <a href="policies.html"><i class="la la-file-pdf-o"></i>  <span>Policies </span></a>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-pie-chart"></i>  <span> Reports  </span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="expense-reports.html"> Expense Report  </a></li>
              <li><a href="invoice-reports.html"> Invoice Report  </a></li>
            </ul>
          </li> -->
          <!-- <li class="menu-title">
            <span>Performance </span>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-graduation-cap"></i>  <span> Performance  </span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="performance-indicator.html"> Performance Indicator  </a></li>
              <li><a href="performance.html"> Performance Review  </a></li>
              <li><a href="performance-appraisal.html"> Performance Appraisal  </a></li>
            </ul>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-crosshairs"></i>  <span> Goals  </span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="goal-tracking.html"> Goal List  </a></li>
              <li><a href="goal-type.html"> Goal Type  </a></li>
            </ul>
          </li>
          <li class="submenu">
            <a href="#"><i class="la la-edit"></i>  <span> Training  </span>  <span class="menu-arrow"></span></a>
            <ul style="display: none;">
              <li><a href="training.html"> Training List  </a></li>
              <li><a href="trainers.html"> Trainers </a></li>
              <li><a href="training-type.html"> Training Type  </a></li>
            </ul>
          </li>
          <li><a href="promotion.html"><i class="la la-bullhorn"></i>  <span>Promotion </span></a></li>
          <li><a href="resignation.html"><i class="la la-external-link-square"></i>  <span>Resignation </span></a></li>
          <li><a href="termination.html"><i class="la la-times-circle"></i>  <span>Termination </span></a></li> -->
          <?php } ?>
          <!-- END HR Admin Menu -->
          <li class="menu-title">
            <span>Administration </span>
          </li>
          <li>
            <a href="<?php echo base_url().'employee/emp_profile/settings/'.base64_encode($this->session->userdata('user_name')) ?>"><i class="la la-cog"></i> <span>Settings </span></a>
          </li>

        </ul>
      </div>
    </div>
  </div>
  <!-- /Sidebar -->
