<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Update Education </h3>
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
            <h4 class="card-title mb-0">Education Update Form </h4>
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
            <form action="<?php echo base_url()."employee/emp_profile/save_edit_education" ?>" method="post">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <input type="hidden" name="edu_id" value="<?php echo $edu_id ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <input type="text" value="<?php echo $edu_schoolname ?>" class="form-control floating" name="edu_schoolname" required />
                    <label class="focus-label">Institution </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <input type="text" value="<?php echo $edu_major ?>" class="form-control floating" name="edu_major" placeholder="Contoh: Teknik Informatika"/>
                    <label class="focus-label">Subject / Major</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <div class="cal-icon">
                      <input type="text" value="<?php echo $edu_startyear ?>" class="form-control floating datetimepicker" name="edu_startyear" placeholder="4 digit year, ex: 2000" required/>
                    </div>
                    <label class="focus-label">Starting Year </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <div class="cal-icon">
                      <input type="text" value="<?php echo $edu_endyear ?>" class="form-control floating datetimepicker" name="edu_endyear" placeholder="4 digit year, ex: 2006" required/>
                    </div>
                    <label class="focus-label">Complete Year </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <select class="select form-control floating" name="edu_grade">
                      <option value="SD" <?php if ($edu_grade == "SD") { echo "selected";}?>/>SD
                      <option value="SMP" <?php if ($edu_grade == "SMP") { echo "selected";}?>/>SMP
                      <option value="SMA/K" <?php if ($edu_grade == "SMA/K") { echo "selected";}?>/>SMA/K
                      <option value="S-I" <?php if ($edu_grade == "S-I") { echo "selected";}?>/>S-I
                      <option value="S-II" <?php if ($edu_grade == "S-II") { echo "selected";}?>/>S-II
                      <option value="S-III" <?php if ($edu_grade == "S-III") { echo "selected";}?>/>S-III
                      <option value="D-I" <?php if ($edu_grade == "D-I") { echo "selected";}?>/>D-I
                      <option value="D-II" <?php if ($edu_grade == "D-II") { echo "selected";}?>/>D-II
                      <option value="D-III" <?php if ($edu_grade == "D-III") { echo "selected";}?>/>D-III
                      <option value="D-IV" <?php if ($edu_grade == "D-IV") { echo "selected";}?>/>D-IV
                    </select>
                    <label class="focus-label">Degree </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-focus focused">
                    <input type="text" value="<?php echo $edu_grade_point ?>" class="form-control floating" name="edu_grade_point"/>
                    <label class="focus-label">Grade Point / IPK </label>
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
