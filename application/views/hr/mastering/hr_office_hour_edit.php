<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Office Hour  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Mastering </li>
            <li class="breadcrumb-item active">Office Hour </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Edit Office Hour </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_mastering_officeHour/update_schedule" ?>" method="post">
              <input type="hidden" name="hourId" value="<?php echo $hourId ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hour Type  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $hourType ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hour Title <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $hourName ?>" name="hourName"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Time In <span class="text-danger">* </span></label>
                    <input class="form-control" type="time" value="<?php echo $hourTimeIn ?>" name="hourTimeIn"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Time Out  <span class="text-danger">* </span></label>
                    <input class="form-control" type="time" value="<?php echo $hourTimeOut ?>" name="hourTimeOut"/>
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
