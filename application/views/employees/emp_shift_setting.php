<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Employee </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Shift Setting </li>
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Change Shift / Office Hour </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."employee/emp_profile/updateShift" ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="user_name" value="<?php echo $this->session->userdata('user_name') ?>">
                  <div class="form-group">
                    <label>NIP:  </label>
                    <input type="text" class="form-control" name="emp_nip" value="<?php echo $emp_nip ?>" readonly/>
                  </div>
                  <div class="form-group">
                    <label>Full Name:  </label>
                    <input type="text" class="form-control" name="emp_fullname" value="<?php echo $emp_fullname ?>" readonly/>
                  </div>
                  <div class="form-group">
                    <label>Shift / Office Hour: </label>
                    <select class="select js-select2 form-control" name="emp_office_hour">
                      <option value=""/> Select
                      <option value="n" <?php if($shift == 'n'){ echo 'selected';} ?> />08.00 - 17.00 WIB (Normal)
                      <option value="s10" <?php if($shift == 's10'){ echo 'selected';} ?> />10.00 - 19.00 WIB (Shift 3)
                      <option value="s9ShiftSabtu" <?php if($shift == 's9ShiftSabtu'){ echo 'selected';} ?> />09.00 - 14.00 (Shift Sabtu)
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
