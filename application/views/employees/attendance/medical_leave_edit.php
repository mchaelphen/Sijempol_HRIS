<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Sick Leave  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Sick Leave </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Edit Form </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."employee/Emp_attendance_medicleave/updateMedical" ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="medic_id" value="<?php echo $medic_id ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Full Name  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname." - ".$master_nip ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>From  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $medic_from ?>" name="medic_from" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>To  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $medic_to ?>" name="medic_to" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Days  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $medic_days ?>" name="medic_days" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Medic Remarks  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $medic_remark ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Upload  <span class="text-danger">* </span></label>
                    <input class="form-control" type="file" name="medic_upload" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="hidden" name="old_image" value="<?php echo $medic_upload ?>">
                    <img src="<?php echo base_url().'assets/uploads/attendance_medicalleave/'.$medic_upload ?>" class="img img-responsive" width="100px" alt="">
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
