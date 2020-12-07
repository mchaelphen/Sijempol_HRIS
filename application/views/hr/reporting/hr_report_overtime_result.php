<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Report Total Overtime Hour </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Reporting </li>
            <li class="breadcrumb-item active"> Overtime Report </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->
    <h4>Result from period: <?php echo $startDate." - ".$endDate ?></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 export_datatable">
            <thead>
              <tr>
                <th style="width: 30px;"># </th>
                <th>NIP </th>
                <th>Name </th>
                <th>Total Requested Hour</th>
                <th>Total Approved Hour </th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($row)) { ?>
                <?php
                $no = 1;
                foreach ($row as $key => $value) { ?>
                <tr>
                  <td> <?php echo $no ?></td>
                  <td> <?php echo $value["master_nip"]?> </td>
                  <td> <?php echo $value["emp_fullname"]?> </td>
                  <td> <?php echo $value["requested_hour"]?> </td>
                  <td> <?php echo $value["approved_hour"]?> </td>

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

</div>
<!-- /Page Wrapper -->
