<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Decline Overtime  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Overtime (HR)</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Decline Form </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_attendance_overtime/UpdateOTFlag/decline" ?>" method="post">
              <input type="hidden" name="overtime_id" value="<?php echo $overtime_id ?>">
              <input type="hidden" name="paramStartDate" value="<?php echo $paramStartDate ?>">
              <input type="hidden" name="paramEndDate" value="<?php echo $paramEndDate ?>">
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
                    <input class="form-control" type="number" value="<?php echo $overtime_request_hour ?>" name="overtime_approved_hour" min="0" max="6" readonly/>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>HR Decline Remarks  <span class="text-danger">* </span></label>
                    <textarea name="overtime_hr_remarks" class="form-control" rows="8" cols="80"></textarea>
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
