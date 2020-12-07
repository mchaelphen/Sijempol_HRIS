<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Report Contract</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Reporting </li>
            <li class="breadcrumb-item active">Contract expires within days</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-responsive mb-0 export_datatable">
          <thead>
            <tr>
              <th># </th>
              <th>Branch</th>
              <th>NIP </th>
              <th>Full Name </th>
              <th>Department</th>
              <th>Signed Date </th>
              <th>End Date</th>
              <th>Days before expire </th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) { ?>
              <?php
              $no = 1;
              foreach ($row as $key => $value) { ?>
              <tr>
                <td> <?php echo $no ?></td>
                <td> <?php echo $value["emp_branch"]?> </td>
                <td> <?php echo $value["master_nip"]?> </td>
                <td> <?php echo $value["emp_fullname"]?> </td>
                <td> <?php echo $value["dept_division"]?> </td>
                <td> <?php echo $value["contract_signed_date"]?> </td>
                <td> <?php echo $value["contract_end_date"]?> </td>
                <td <?php if ($value["expired_in"] < 0) { echo "style='color:red;'";} ?>> <?php echo $value["expired_in"]?> </td>
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
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
