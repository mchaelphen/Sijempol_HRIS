<!-- Page Wrapper -->
<div class="page-wrapper">
  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Leaves </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Leaves </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <!-- Leave Statistics -->
    <div class="row">
      <div class="col-md-3">
        <div class="stats-info">
          <h6>Annual Leave </h6>
          <h4><?php echo $annualleave ?> </h4>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stats-info">
          <h6>Mass Leave </h6>
          <h4><?php echo $massleave ?> </h4>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stats-info">
          <h6>Taken Leave </h6>
          <h4><?php echo $takenleave ?> </h4>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stats-info">
          <h6>Remaining Leave </h6>
          <h4><?php echo $remainingleave ?> </h4>
        </div>
      </div>
    </div>
    <!-- /Leave Statistics -->

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th>Leave Type </th>
                <th>From </th>
                <th>To </th>
                <th>No of Days </th>
                <th>Reason </th>
                <th class="text-center">Manager Approval </th>
                <th class="text-center">HR Approval </th>
                <!-- <th class="text-right">Actions </th> -->
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($row)): ?>
                <?php foreach ($row as $key => $value): ?>
                  <tr>
                    <td><?php echo $value["leave_type"] ?></td>
                    <td><?php echo $value["leave_from"] ?></td>
                    <td><?php echo $value["leave_to"] ?></td>
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
                          <?php echo $value["leave_hr_approved_date"] ?>
                        </div>
                      </div>
                    </td>
                    <!-- <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit </a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                        </div>
                      </div>
                    </td> -->
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

  <!-- Add Leave Modal -->
  <div id="add_leave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Leave </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."employee/Emp_attendance_leave/insert_leave" ?>" method="post">
            <div class="form-group">
              <label>Leave Type  <span class="text-danger">* </span></label>
              <select class="select" name="leave_type">
                <option value="Casual Leave"/>Casual Leave 12 Days
              </select>
            </div>
            <div class="form-group">
              <label>From  <span class="text-danger">* </span></label>
              <input class="form-control" type="date" name="leave_from" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . "+1 days")) ?>"/>
            </div>
            <div class="form-group">
              <label>To  <span class="text-danger">* </span></label>
              <input class="form-control" type="date" name="leave_to" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . "+1 days")) ?>"/>
            </div>
            <div class="form-group">
              <label>Remaining Leaves  <span class="text-danger">* </span></label>
              <input class="form-control" readonly="" value="<?php echo $remainingleave ?>" name="leave_remaining" type="text" />
            </div>
            <div class="form-group">
              <label>Leave Reason  <span class="text-danger">* </span></label>
              <textarea rows="4" class="form-control" name="leave_reason" required></textarea>
            </div>
            <div class="submit-section">
              <?php if ($remainingleave != 0): ?>
                <button class="btn btn-primary submit-btn">Submit </button>
              <?php else: ?>
                <p class="text-danger">You don't have any remaining leave.</p>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                  Close
                </button>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Leave Modal -->

</div>
<!-- /Page Wrapper -->
