<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Deactivate Employee </h3>
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
            <h4 class="card-title mb-0 text-danger">Deactivate Account </h4>
            <p>NIP : <?php echo $emp_nip." - ".$emp_fullname ?></p>
          </div>
          <div class="card-body">
            <form action="<?php echo base_url()."hr/hr_employee/deactivateEmployee" ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
                  <div class="form-group">
                    <label>Tanggal Resign</label>
                    <input type="date" class="form-control" name="emp_date_resign" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Alasan Resign</label>
                    <input type="text" class="form-control" name="emp_resign_reason" value=""/>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <a href="<?php echo base_url().'hr/Hr_employee'?>" class="btn btn-info">Cancel</a>
                <button type="submit" class="btn btn-danger">Deactivate </button>
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
