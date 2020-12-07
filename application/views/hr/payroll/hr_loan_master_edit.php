<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Master Loan  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Payroll </li>
            <li class="breadcrumb-item active">Loan (Edit) </li>
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
            <form action="<?php echo base_url()."hr/Hr_payroll_loan/update_loan_master" ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="loan_id" value="<?php echo $loan_id ?>">
              <input type="hidden" name="master_nip" value="<?php echo $master_nip ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Full Name  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $emp_fullname." - ".$master_nip ?>" name="" readonly/>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Loan Amount (Rp)  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $loan_amount ?>" name="loan_amount" <?php if ($loan_status == 1) { echo "readonly"; } ?>/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>From  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $loan_startDate ?>" name="loan_startDate" required <?php if ($loan_status == 1) { echo "readonly"; } ?>/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>To  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $loan_endDate ?>" name="loan_endDate" required <?php if ($loan_status == 1) { echo "readonly"; } ?>/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Reason  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $loan_reason ?>" name="loan_reason" required <?php if ($loan_status == 1) { echo "readonly"; } ?>/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Loan Remark  <span class="text-danger">* </span></label>
                    <input class="form-control" type="text" value="<?php echo $loan_remark ?>" name="loan_remark" <?php if ($loan_status == 1) { echo "required"; } ?>/>
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
