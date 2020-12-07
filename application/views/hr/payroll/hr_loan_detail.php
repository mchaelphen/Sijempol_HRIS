<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Loan </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Payroll </li>
            <li class="breadcrumb-item">Loan </li>
            <li class="breadcrumb-item active">Detail </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <?php if ($loan_status != 1){ ?>
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_payment"><i class="fa fa-plus"></i> Add Payment </a>
          <?php } else { ?>
            <a href="#" class="btn btn-success"><i class="fa fa-check"></i> Loan Paid Off </a>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <hr>

    <!-- Loan Info -->
    <div class="row">
      <div class="col-md-12">
        <h2>Loan Info</h2>
      </div>
      <div class="col-md-6">
        <p> Name: <?php echo $emp_fullname ?></p>
        <p> NIP: <?php echo $master_nip ?></p>
        <p> Loan Amount: Rp <?php echo number_format("$loan_amount",2,",","."); ?></p>
        <p> Loan Paid: Rp <?php echo number_format("$totalDebtPaid",2,",","."); ?></p>
      </div>
      <div class="col-md-6">
        <p> Date: <?php echo $loan_startDate." - ".$loan_endDate ?></p>
        <p> Reason: <?php echo $loan_reason ?></p>
        <p> Loan Remaining: Rp <?php echo number_format(($loan_amount-$totalDebtPaid),2,",","."); ?></p>
        <p> Loan Remark: <?php echo $loan_remark ?></p>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th style="width: 30px;"># </th>
                <!-- <th>NIP </th>
                <th>Year Paid </th>
                <th>Month Paid </th> -->
                <th>Amount Paid </th>
                <th>Date Paid </th>
                <!-- <th class="text-right">Action </th> -->
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($LoanDetailList)) { ?>
                <?php
                $no = 1;
                foreach ($LoanDetailList as $key => $value) { ?>
                <tr>
                  <td> <?php echo $no ?></td>
                  <!-- <td> <?php echo $value["master_nip"]?> </td>
                  <td> <?php echo $value["loandet_year"]?> </td>
                  <td> <?php echo $value["loandet_month"]?> </td> -->
                  <td> <?php echo $value["loandet_debtPaid"]?> </td>
                  <td> <?php echo $value["loandet_datePaid"]?> </td>

                  <!-- <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url().'hr/Hr_payroll_loan/edit_loan_master/'.$value["loandet_id"] ?>"><i class="fa fa-edit m-r-5"></i> Edit </a>
                      </div>
                    </div>
                  </td> -->
                </tr>
              <?php $no++; } ?>
            <?php } else { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p> Payment not found.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; </span>
                </button>
              </div>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

  <!-- Add Loan -->
  <div id="add_payment" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Payment </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."hr/Hr_payroll_loan/insert_loan_detail" ?>" method="post">
            <input type="hidden" name="loandet_masterId" value="<?php echo $loan_id ?>">
            <input type="hidden" name="master_nip" value="<?php echo $master_nip ?>">
            <div class="form-group">
              <label>Loan Paid Amount  <span class="text-danger">* </span></label>
              <input class="form-control" name="loandet_debtPaid" type="text" />
            </div>

            <div class="submit-section">
              <button class="btn btn-primary submit-btn">Submit </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Loan -->

</div>
<!-- /Page Wrapper -->
