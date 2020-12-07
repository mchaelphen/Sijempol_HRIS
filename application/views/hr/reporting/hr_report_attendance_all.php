<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Attendance Report </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item"> Reporting </li>
            <li class="breadcrumb-item active"> Attendance Report </li>
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
            <h4 class="card-title mb-0">Attendance Report </h4>
          </div>

          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_report_attendance/getResultAttendanceAll" ?>" method="post">
              <div class="row">
                <div class="col-md-6 col-sm-6">
  							 <div class="form-group form-focus">
                   <label class="">Start Date </label>
  								 <input type="date" name="start_date" class="form-control"required />
  							 </div>
  						 </div>
                <div class="col-md-6 col-sm-6">
  							 <div class="form-group form-focus">
                   <label class="">End Date </label>
  								 <input type="date" name="end_date" class="form-control" required />
  							 </div>
  						 </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 col-sm-6">
  							 <div class="form-group form-focus">
                   <label class="">Designation </label>
                   <select class="form-control" name="emp_designation">
                     <option value="PST">Back Office</option>
                     <option value="BO/OPS">OPS Office</option>
                     <option value="Pure OPS">Pure OPS</option>
                   </select>
  							 </div>
  						 </div>

               <div class="col-md-6 col-sm-6">
   							 <div class="form-group form-focus">
                    <label class="">Branch </label>
                    <select class="form-control js-select2" name="emp_branch">
                      <option value="JKT" />JKT
                      <option value="BDO" />BDO
                      <option value="BPN" />BPN
                      <option value="CBN" />CBN
                      <option value="JOG" />JOG
                      <option value="MES" />MES
                      <option value="PWO" />PWO
                      <option value="SOC" />SOC
                      <option value="SRG" />SRG
                      <option value="SUB" />SUB
                      <option value="UPG" />UPG
                    </select>
   							 </div>
   						 </div>
              </div>

              <br>
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
