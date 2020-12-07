<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Staff Schedule </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance Manager </li>
            <li class="breadcrumb-item active">Staff Schedule </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <hr>
    <?php if ($alert == '1') { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> <p> <?php echo $message ?> </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times; </span>
        </button>
      </div>
    <?php } ?>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th># </th>
                <th>Branch </th>
                <th>NIP </th>
                <th>Full Name </th>
                <th>Schedule </th>
                <th>Time In </th>
                <th>Time Out </th>
                <th>Cross Day </th>
                <th class="text-right">Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php
               if (!empty($row)) {
                 $i=1;
                 foreach ($row as $key => $value) {
              ?>
              <tr>
                <td> <?php echo $i ?> </td>
                <td> <?php echo $value["emp_nip"] ?> </td>
                <td> <?php echo $value["emp_fullname"] ?> </td>
                <td> <?php echo $value["emp_branch"] ?> </td>
                <td> <?php echo $value["emp_office_hour"] ?> </td>
                <td> <?php echo $value["hourTimeIn"] ?> </td>
                <td> <?php echo $value["hourTimeOut"] ?> </td>
                <td> <?php if($value["hourOver"] == 1) {echo 'yes';} else {echo 'no';} ?> </td>
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo base_url()."employee/Emp_attendance_schedule/edit_schedule/".$value["emp_nip"] ?>"><i class="fa fa-clock-o m-r-5"></i> Change Schedule </a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php $i++;} }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
