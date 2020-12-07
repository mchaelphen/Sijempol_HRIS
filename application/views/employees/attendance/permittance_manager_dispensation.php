<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Approve Dispensation Permittance  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Permittance </li>
            <li class="breadcrumb-item active">Permittance (Manager) </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Approve Dispensation Form </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."employee/Emp_attendance_permittance/dispensation_approve" ?>" method="post">
              <input type="hidden" name="permit_id" value="<?php echo $permit_id ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Full Name  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>From <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_from ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>To <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_to ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hours <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_hours ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Minutes <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_minutes ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Reason  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_reason ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Cause  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $permit_cause ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Approval Remarks  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="" name="permit_paycut_reason" required/>
                  </div>
                </div>

              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">Approve Dispensation</button>
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
