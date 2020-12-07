<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Employee Schedule  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Employee Schedule </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Edit Employee Schedule </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."employee/Emp_attendance_schedule/update_empschedule" ?>" method="post">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Employee  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname." - ".$emp_nip ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Schedule <span class="text-danger">* </span></label>
                    <select class="form-control js-select2" name="emp_office_hour" required>
                      <?php foreach ($scheduleList as $key => $value): ?>
                        <option value="<?php echo $value["hourType"] ?>" <?php if($emp_office_hour == $value["hourType"]){echo "selected";} ?> /> <?php echo $value["hourName"]." (".$value["hourTimeIn"]." - ".$value["hourTimeOut"].")"  ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
