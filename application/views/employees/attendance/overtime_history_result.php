<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Overtime (Manager)</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance</li>
            <li class="breadcrumb-item active">Overtime (Manager)</li>
          </ul>
        </div>
        <!-- <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_overtime"><i class="fa fa-plus"></i> Add Overtime </a>
        </div> -->
      </div>
    </div>
    <!-- /Page Header -->

    <!-- Overtime Statistics -->
    <!-- <div class="row">
      <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="stats-info">
          <h6>Overtime Employee </h6>
          <h4>12  <span>this month </span></h4>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="stats-info">
          <h6>Overtime Hours </h6>
          <h4>118  <span>this month </span></h4>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="stats-info">
          <h6>Pending Request </h6>
          <h4>23 </h4>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="stats-info">
          <h6>Rejected </h6>
          <h4>5 </h4>
        </div>
      </div>
    </div> -->
    <!-- /Overtime Statistics -->

    <hr>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-sm table-striped mb-0 datatable table-responsive nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Name </th>
              <th nowrap>OT Date </th>
              <th class="text-center">OT Hours (Request)</th>
              <th class="text-center">OT Hours (Approved)</th>
              <th>Desc. </th>
              <th>Void Remark. </th>
              <th class="text-center">Manager Approval </th>
              <th class="text-center">HR Approval </th>
            </tr>
          </thead>
          <tbody>
            <?php
             if (!empty($OvertimeList)) {
               $i=1;
               foreach ($OvertimeList as $key => $value) {
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td>
                <h2 class="table-avatar blue-link">
                  <?php echo $value["emp_nip"] ?>
                  <?php echo $value["emp_fullname"] ?>
                </h2>
              </td>
              <td nowrap> <?php echo $value["overtime_date"] ?> </td>
              <td class="text-center"> <?php echo $value["overtime_request_hour"] ?> </td>
              <td class="text-center"> <?php echo !empty($value["overtime_approved_hour"])?$value["overtime_approved_hour"]:"Waiting" ?> </td>
              <td> <?php echo $value["overtime_remarks"] ?> </td>
              <td class="text-danger"> <?php echo $value["overtime_void_remarks"] ?> </td>
              <td class="text-center">
                <div class="action-label">
                  <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                    <?php if($value["overtime_flag_manager"] == 0) { ?>
                      <i class="fa fa-close text-danger"></i> Void
                    <?php } elseif ($value["overtime_flag_manager"] == 1) { ?>
                      <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                      <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                    <?php } elseif ($value["overtime_flag_manager"] == 2) { ?>
                      <i class="fa fa-check text-success"></i> Approved
                      <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                    <?php } elseif ($value["overtime_flag_manager"] == 3) { ?>
                      <i class="fa fa-close text-danger"></i> Declined
                      <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                    <?php } ?>
                  </a>
                  <?php echo $value["overtime_approved_date"] ?>
                </div>
              </td>
              <td class="text-center">
                <div class="action-label">
                  <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                    <?php if($value["overtime_flag_manager"] == 0) { ?>
                      <i class="fa fa-close text-danger"></i> Void
                    <?php } elseif ($value["overtime_flag_hrd"] == 1) { ?>
                      <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                      <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                    <?php } elseif ($value["overtime_flag_hrd"] == 2) { ?>
                      <i class="fa fa-check text-success"></i> Approved
                      <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                    <?php } elseif ($value["overtime_flag_hrd"] == 3) { ?>
                      <i class="fa fa-close text-danger"></i> Declined
                      <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                    <?php } ?>
                  </a>
                  <?php echo $value["overtime_approved_hr_date"] ?>
                </div>
              </td>

            </tr>
            <?php $i++;} }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
