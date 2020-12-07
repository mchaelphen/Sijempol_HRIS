<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Settings </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Settings </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <!-- alert error -->
    <div class="container"><br>
      <?php if (!empty($alert)) { ?>
        <?php if ($alert == '0' || $alert == '2' || $alert == '3') { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> <p> <?php echo $notif ?> </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times; </span>
            </button>
          </div>
        <?php } elseif ($alert == '1' || $alert == '4') { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> <p> <?php echo $notif; ?> </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times; </span>
            </button>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
    <!-- alert error -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Profile Picture </h4>
          </div>

          <div class="card-body">
            <div class="profile-view">
              <div class="profile-img-wrap">
                <div class="profile-img">
                  <?php if (!empty($emp_profile_pic)) { ?>
                    <span class="user-img"><img src="<?php echo base_url().'assets/uploads/emp_pic/'.$emp_profile_pic?>" alt="" />
                  <?php } else { ?>
                    <span class="user-img"><img src="<?php echo base_url().'assets/img/user.jpg'?>" alt="" />
                  <?php } ?>
                </div>
              </div>
              <div class="profile-basic">
                <form action="<?php echo base_url()."employee/emp_profile/upload_profile_picture" ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Upload Profile Pic </label>
                        <input type="file" class="form-control" name="emp_profile_pic" required/>
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

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Change Password </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."employee/emp_profile/update_password" ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="user_name" value="<?php echo $this->session->userdata('user_name') ?>">
                  <div class="form-group">
                    <label>Old Password </label>
                    <input type="password" class="form-control" name="old_pass" required/>
                  </div>
                  <div class="form-group">
                    <label>New Password </label>
                    <input type="password" class="form-control" name="new_pass" required/>
                  </div>
                  <div class="form-group">
                    <label>Confirm Password </label>
                    <input type="password" class="form-control" name="confirm_pass" required/>
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
