<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Employee Paycheck </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Employee Paycheck</li>
          </ul>
        </div>

      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped custom-table mb-0 datatable table-responsive">
          <thead>
            <tr>
              <th style="width: 30px;"># </th>
              <th>NIP </th>
              <th>Full Name </th>
              <th>Position </th>
              <th>Level </th>
              <th>Month </th>
              <th>Year </th>
              <th>Overtime Hours </th>
              <th>Bonus Overtime </th>
              <th>Late Frequency </th>
              <th>Late Minutes </th>
              <th>Late Deduction </th>
              <th>Leave </th>
              <th>Sick </th>
              <th>Permit </th>
              <th>Alpha </th>
              <th>Absence Deduction </th>
              <th>Loan Deduction </th>
              <th>Salary Total </th>
              <th class="text-right">Action </th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($EmployeePayheckList)) { ?>
              <?php
              $no = 1;
              foreach ($EmployeePayheckList as $key => $value) { ?>
              <tr>
                <td> <?php echo $no ?></td>
                <td> <?php echo $value["emp_nip"]?> </td>
                <td> <?php echo $value["emp_fullname"]?> </td>
                <td> <?php echo $value["dept_position"]?> </td>
                <td> <?php echo $value["dept_level"]?> </td>
                <td> <?php echo $value["paycheck_month"]?> </td>
                <td> <?php echo $value["paycheck_year"]?> </td>
                <td> <?php echo $value["paycheck_overtimeHours"]?> </td>
                <td> <?php echo $value["paycheck_overtimeBonus"]?> </td>
                <td> <?php echo $value["paycheck_lateFrequency"]?> </td>
                <td> <?php echo $value["paycheck_lateMinutes"]?> </td>
                <td> <?php echo $value["paycheck_lateDeduct"]?> </td>
                <td> <?php echo $value["paycheck_leave"]?> </td>
                <td> <?php echo $value["paycheck_sickleave"]?> </td>
                <td> <?php echo $value["paycheck_permit"]?> </td>
                <td> <?php echo $value["paycheck_alpha"]?> </td>
                <td> <?php echo $value["paycheck_absenceDeduct"]?> </td>
                <td> <?php echo $value["paycheck_loanDeduct"]?> </td>
                <td> <?php echo $value["paycheck_salaryTotal"]?> </td>
                <!-- <?php if ($value["user_active"] == 1){ ?>
                  <td class="text-success">Active</td>
                <?php } else { ?>
                  <td class="text-danger">Disabled</td>
                <?php }?> -->
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo base_url().'employee/emp_profile/index/'.base64_encode($value["emp_nip"]) ?>"><i class="fa fa-pencil m-r-5"></i> View </a>
                      <a class="dropdown-item" href="<?php echo base_url().'hr/hr_employee/edit_profile/'.base64_encode($value["emp_nip"]) ?>"><i class="fa fa-pencil m-r-5"></i> Edit </a>
                      <?php if ($value["user_active"] != 0){ ?>
                        <a class="dropdown-item" href="<?php echo base_url().'hr/hr_employee/deactivateFormEmployee/'.base64_encode($value["emp_nip"]) ?>"><i class="fa fa-trash-o m-r-5"></i> Deactivate </a>
                      <?php } ?>
                      <?php if ($value["user_active"] != 0 && $value["user_flag_editprofile"] != 1){ ?>
                        <a class="dropdown-item" href="<?php echo base_url().'hr/hr_employee/updateEditFlag/'.base64_encode($value["emp_nip"])."/1" ?>"><i class="fa fa-trash-o m-r-5"></i> Enable Edit </a>
                      <?php } else { ?>
                        <a class="dropdown-item" href="<?php echo base_url().'hr/hr_employee/updateEditFlag/'.base64_encode($value["emp_nip"])."/0" ?>"><i class="fa fa-trash-o m-r-5"></i> Disable Edit </a>
                      <?php } ?>
                    </div>
                  </div>
                </td>
              </tr>
            <?php $no++; } ?>
          <?php } else { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p> Data not found.</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span>
              </button>
            </div>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
