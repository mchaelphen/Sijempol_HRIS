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
            <li class="breadcrumb-item active">Loan </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_loan"><i class="fa fa-plus"></i> Add Loan </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th style="width: 30px;"># </th>
                <th>Branch </th>
                <th>NIP </th>
                <th>Name </th>
                <th>Position </th>
                <th>Start Date </th>
                <th>End Date </th>
                <th>Amount </th>
                <th>Reason </th>
                <th>Remark </th>
                <th>Status </th>
                <th class="text-right">Action </th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($LoanMasterList)) { ?>
                <?php
                $no = 1;
                foreach ($LoanMasterList as $key => $value) { ?>
                <tr>
                  <td> <?php echo $no ?></td>
                  <td> <?php echo $value["emp_branch"]?> </td>
                  <td> <?php echo $value["master_nip"]?> </td>
                  <td> <?php echo $value["emp_fullname"]?> </td>
                  <td> <?php echo $value["dept_position"]?> </td>
                  <td> <?php echo $value["loan_startDate"]?> </td>
                  <td> <?php echo $value["loan_endDate"]?> </td>
                  <td> <?php echo $value["loan_amount"]?> </td>
                  <td> <?php echo $value["loan_reason"]?> </td>
                  <td> <?php echo $value["loan_remark"]?> </td>
                  <?php if ($value["loan_status"] == 1){ ?>
                    <td class="text-success">Paid Off</td>
                  <?php } else { ?>
                    <td class="text-danger">Not Paid</td>
                  <?php }?>
                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url().'hr/Hr_payroll_loan/loan_detail_index/'.$value["loan_id"] ?>"><i class="fa fa-eye m-r-5"></i> View </a>
                        <a class="dropdown-item" href="<?php echo base_url().'hr/Hr_payroll_loan/edit_loan_master/'.$value["loan_id"] ?>"><i class="fa fa-edit m-r-5"></i> Edit </a>
                        <?php if ($value["loan_status"] != 1) { ?>
                          <a class="dropdown-item" href="<?php echo base_url().'hr/Hr_payroll_loan/update_loan_status_paid/'.$value["loan_id"] ?>"><i class="fa fa-money m-r-5"></i> Paid Off </a>
                        <?php } ?>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php $no++; } ?>
            <?php } else { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p> Data not found.</p>
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
  <div id="add_loan" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Loan </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."hr/Hr_payroll_loan/insert_loan_master" ?>" method="post">
            <div class="form-group">
              <label>Requested by  <span class="text-danger">* </span></label>
              <!-- <input class="form-control" type="text" name="master_nip" value="" placeholder="Staff's NIP"/> -->
              <select class="form-control js-select2" name="master_nip" placeholder="Select Employee">
                <?php foreach ($EmployeeList as $key => $value): ?>
                  <option class="form-control" value="<?php echo $value["emp_nip"] ?>"><?php echo $value["emp_fullname"] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Loan Amount  <span class="text-danger">* </span></label>
              <input class="form-control" name="loan_amount" type="text" />
            </div>
            <div class="form-group">
              <label>Start Date  <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control " name="loan_startDate" type="date" value="<?php echo DATE("Y-m-d") ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label>End Date  <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control " name="loan_endDate" type="date" value="<?php echo DATE("Y-m-d") ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label>Reason  <span class="text-danger">* </span></label>
              <textarea rows="4" class="form-control" name="loan_reason"></textarea>
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
