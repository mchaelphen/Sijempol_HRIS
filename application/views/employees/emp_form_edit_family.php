<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Update Family Member </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Employee </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Update Family Member Form </h4>
          </div>

          <!-- alert error -->
          <div class="container"><br>
            <?php if (!empty($alert)) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong> <p> <?php echo $message ?> </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; </span>
                </button>
              </div>
            <?php } ?>
          </div>
          <!-- alert error -->
          <div class="card-body">
            <form action="<?php echo base_url()."employee/emp_profile/save_edit_family" ?>" method="post">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <input type="hidden" name="fam_id" value="<?php echo $fam_id ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Full Name  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $fam_fullname ?>" name="fam_fullname" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Relationship  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $fam_relationship ?>" name="fam_relationship" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>No. KTP  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $fam_ktp_num ?>" name="fam_ktp_num" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Phone  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $fam_phone_num ?>" name="fam_phone_num" required/>
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
