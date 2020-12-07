<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Approve Overtime  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Overtime (HR) </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">HR approve overtime as Manager </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_attendance_overtime/UpdateOTFlag/approveasmanager" ?>" method="post">
              <input type="hidden" name="overtime_id" value="<?php echo $overtime_id ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Full Name  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Division <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $dept_division ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Position <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $dept_position ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Time In  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $pairingTimeIn ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Time Out  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $pairingTimeOut ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>OT Date  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $overtime_date ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>OT Remarks  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $overtime_remarks ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>OT Hour (Requested)  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $overtime_request_hour ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>OT Hour (Approved)  <span class="text-danger">* </span></label>
                    <input class="form-control" type="number" value="<?php echo $overtime_request_hour ?>" name="overtime_approved_hour" min="0" max="6" required/>
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
