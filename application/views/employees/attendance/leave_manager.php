<!-- Page Wrapper -->
<div class="page-wrapper">
  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Leaves (Manager)</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Leaves (Manager) </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th>Employee</th>
                <th nowrap>Leave Type </th>
                <th>From </th>
                <th>To </th>
                <th>Days </th>
                <th>Reason </th>
                <th class="text-center">Manager Approval </th>
                <th class="text-center">HR Approval </th>
                <th class="text-right">Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($row)): ?>
                <?php foreach ($row as $key => $value): ?>
                  <tr>
                    <td><?php echo $value["emp_fullname"] ?> <br> <span><?php echo $value["master_nip"] ?></span> </td>
                    <td><?php echo $value["leave_type"] ?></td>
                    <td nowrap><?php echo $value["leave_from"] ?></td>
                    <td nowrap><?php echo $value["leave_to"] ?></td>
                    <td><?php echo $value["leave_days"] ?></td>
                    <td><?php echo $value["leave_reason"] ?></td>

                    <td class="text-center">
                      <div class="action-label">
                        <div class="action-label">
                          <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                            <?php if ($value["leave_manager_flag"] == 1) { ?>
                              <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                              <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                            <?php } elseif ($value["leave_manager_flag"] == 2) { ?>
                              <i class="fa fa-check text-success"></i> Approved
                              <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                            <?php } elseif ($value["leave_manager_flag"] == 3) { ?>
                              <i class="fa fa-close text-danger"></i> Declined
                              <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                            <?php } ?>
                          </a>
                          <br>
                          <?php echo $value["leave_approved_date"] ?>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <div class="action-label">
                        <div class="action-label">
                          <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                            <?php if ($value["leave_hr_flag"] == 1) { ?>
                              <i class="fa fa-dot-circle-o text-purple"></i> Pending
                              <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                            <?php } elseif ($value["leave_hr_flag"] == 2) { ?>
                              <i class="fa fa-check text-success"></i> Approved
                              <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                            <?php } elseif ($value["leave_hr_flag"] == 3) { ?>
                              <i class="fa fa-close text-danger"></i> Declined
                              <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                            <?php } ?>
                          </a>
                          <br>
                          <?php echo $value["leave_hr_approved_date"] ?>
                        </div>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_leave/updateLeaveFlag/approve/".$value["leave_id"] ?>"><i class="fa fa-check m-r-5 text-success"></i> Approve </a>
                          <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_leave/updateLeaveFlag/decline/".$value["leave_id"] ?>"><i class="fa fa-close m-r-5 text-danger"></i> Decline </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
