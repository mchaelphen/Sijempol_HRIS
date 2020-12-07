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
              <th>Time In</th>
              <th>Time Out</th>
              <th>Work Hours</th>
              <th>OT Actual</th>
              <th class="text-center">Manager Approval </th>
              <!-- <th>Mngr. Approve Date</th> -->
              <th class="text-center">HR Approval </th>
              <!-- <th>HR Approve Date</th> -->
              <th class="text-right">Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php
             if (!empty($otlist)) {
               $i=1;
               foreach ($otlist as $key => $value) {
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td>
                <h2 class="table-avatar blue-link">
                  <?php echo $value["emp_fullname"] ?>
                  <?php echo $value["emp_nip"] ?>
                </h2>
              </td>
              <td nowrap> <?php echo $value["overtime_date"] ?> </td>
              <td class="text-center"> <?php echo $value["overtime_request_hour"] ?> </td>
              <td class="text-center"> <?php echo !empty($value["overtime_approved_hour"])?$value["overtime_approved_hour"]:"Waiting" ?> </td>
              <td> <?php echo $value["overtime_remarks"] ?> </td>
              <td nowrap> <?php echo $value["TimeIn"] ?> </td>
              <td nowrap> <?php echo $value["TimeOut"] ?> </td>
              <td nowrap> <?php echo $value["jam_kerja"] ?> </td>
              <td nowrap> <?php echo $value["fix"] ?> </td>
              <td class="text-center">
                <div class="action-label">
                  <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                    <?php if ($value["overtime_flag_manager"] == 1) { ?>
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
              <!-- <td nowrap> <?php echo $value["overtime_approved_date"] ?> </td> -->
              <td class="text-center">
                <div class="action-label">
                  <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                    <?php if ($value["overtime_flag_hrd"] == 1) { ?>
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
              <!-- <td nowrap> <?php echo $value["overtime_approved_hr_date"] ?> </td> -->
              <td class="text-right">
                <?php if ($value["datediff"] > 100) { ?>
                  <p class="text-light btn btn-danger btn-sm">Approval Overdue</p>
                <?php } else { ?>
                <div class="dropdown dropdown-action">
                  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_overtime/approve_staffot/".$value["overtime_id"] ?>"><i class="fa fa-check m-r-5 text-success"></i> Approve </a>
                    <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_overtime/UpdateOTFlag/decline/".$value["overtime_id"] ?>"><i class="fa fa-close m-r-5 text-danger"></i> Decline </a>
                    <hr style="margin:3px 0px;">
                    <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_overtime/voidOT/".$value["overtime_id"] ?>"><i class="fa fa-circle m-r-5 text-secondary"></i> Void (Batal) </a>
                  </div>
                </div>
              <?php } ?>
              </td>
            </tr>
            <?php $i++;} }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

  <!-- Add Overtime Modal -->
  <div id="add_overtime" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Overtime </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."employee/Emp_attendance_overtime/insert_overtime" ?>" method="post">
            <div class="form-group">
              <label>Requested by  <span class="text-danger">* </span></label>
              <select class="select" name="master_nip">
                <option value="<?php echo $this->session->userdata('user_name')?>"/> <?php echo $this->session->userdata('user_fullname') ?>
              </select>
            </div>
            <div class="form-group">
              <label>Overtime Date  <span class="text-danger">* </span></label>
              <div class="cal-icon">
                <input class="form-control " name="overtime_date_raw" type="text" value="<?php echo DATE("Y-m-d") ?>" readonly/>
              </div>
            </div>
            <div class="form-group row">
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="1"/> Yesterday
            		 </label>
            	 </div>
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="2"/> Today
            		 </label>
            	 </div>
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="3"/> Tomorrow
            		 </label>
            	 </div>
            </div>
            <div class="form-group">
              <label>Overtime Hours  <span class="text-danger">* </span></label>
              <input class="form-control" name="overtime_request_hour" type="text" />
            </div>
            <div class="form-group">
              <label>Description  <span class="text-danger">* </span></label>
              <textarea rows="4" class="form-control" name="overtime_remarks"></textarea>
            </div>
            <div class="form-group">
              <label>Supervisors NIP  <span class="text-danger">* </span></label>
              <input class="form-control" type="text" name="overtime_manager_nip" value="<?php echo $this->session->userdata('dept_manager') ?>" />
            </div>
            <div class="submit-section">
              <button class="btn btn-primary submit-btn">Submit </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Overtime Modal -->

</div>
<!-- /Page Wrapper -->
