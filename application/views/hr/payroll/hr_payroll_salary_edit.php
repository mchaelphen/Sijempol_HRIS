<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Employee Salary  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Payroll </li>
            <li class="breadcrumb-item active">Employee Salary </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Edit Salary </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_payroll_salary/update_salary" ?>" method="post">
              <input type="hidden" name="master_nip" value="<?php echo $emp_nip ?>">
              <input type="hidden" name="emp_branch" value="<?php echo $emp_branch ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Employee </label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname." - ".$emp_nip ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Department </label>
                    <input class="form-control" type="text" value="<?php echo $dept_division." - ".$dept_position ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Level </label>
                    <input class="form-control" type="text" value="<?php echo $dept_level ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Basic Salary <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $salary_basic ?>" placeholder="ex. 1500000" name="salary_basic" required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>KPI  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $salary_kpi ?>" placeholder="ex. 1500000" name="salary_kpi" required/>
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
