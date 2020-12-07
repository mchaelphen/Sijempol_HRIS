<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Employee Paycheck </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item"> Payroll </li>
            <li class="breadcrumb-item active"> Employee Paycheck</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <!-- alert error -->
    <!-- <div class="container"><br>
      <?php if (!empty($dupeCount)) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>INFORMATION </strong>
          <p> Insert Done.</p>
          <p> <?php echo $message ?> </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
      <?php } ?>
    </div> -->
    <!-- alert error -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Employee Paycheck Form</h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/hr_payroll_paycheck/getPaycheckList" ?>" method="post">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                 <div class="form-group form-focus">
                   <label class="">Month </label>
                   <select class="form-control select" name="paycheck_month">
                     <option value="1"/>January
                     <option value="2"/>February
                     <option value="3"/>March
                     <option value="4"/>April
                     <option value="5"/>May
                     <option value="6"/>June
                     <option value="7"/>July
                     <option value="8"/>August
                     <option value="9"/>September
                     <option value="10"/>October
                     <option value="11"/>November
                     <option value="12"/>December
                   </select>
                 </div>
                </div>
                <div class="col-md-6 col-sm-6">
                 <div class="form-group form-focus">
                   <label class="">Year </label>
                	 <input type="text" name="paycheck_year" class="form-control" value="<?php echo DATE("Y")?>"/>
                 </div>
                </div>
              </div>
              <br><br>
              <div class="row">
                <div class="col-md-12">
                  <b>COMPANY</b>
                </div>
                <div class="col-md-6 col-sm-6">
                 <div class="form-group form-focus">
                   <label class="">Branch </label>
                   <select class="form-control select" name="emp_branch">
                     <option value="JKT"/>JKT
                     <option value="BDO"/>BDO
                     <option value="BPN"/>BPN
                     <option value="JOG"/>JOG
                     <option value="MES"/>MES
                     <option value="SRG"/>SRG
                     <option value="SUB"/>SUB
                     <option value="UPG"/>UPG
                   </select>
                 </div>
                </div>
                <div class="col-md-6 col-sm-6">
                 <div class="form-group form-focus">
                   <label class="">Designation </label>
                   <select class="form-control select" name="dept_level">
                     <option value="1"/>Staff
                     <option value="2"/>Spv to Manager
                   </select>
                 </div>
                </div>
              </div>
              <br><br>
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
