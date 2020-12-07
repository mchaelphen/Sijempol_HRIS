<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Employee Salary </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item">Payroll </li>
            <li class="breadcrumb-item active">Employee Salary </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <!-- <a href="<?php echo base_url()."hr/hr_employee/form_add_employee" ?>" class="btn add-btn"><i class="fa fa-plus"></i> Add Employees </a> -->
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <?php if ($alert == '0') { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong> <p> <?php echo $message ?> </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times; </span>
        </button>
      </div>
    <?php } elseif ($alert == '1') { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> <p> <?php echo $message; ?> </p>
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
                <th style="width: 30px;"># </th>
                <th>Branch </th>
                <th>NIP </th>
                <th>Full Name </th>
                <th>Division </th>
                <th>Position </th>
                <th>Total Salary </th>
                <th>Base Salary </th>
                <th>KPI </th>
                <th class="text-right">Action </th>
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
                  <td> <?php echo $value["emp_nip"]?> </td>
                  <td> <?php echo $value["emp_fullname"]?> </td>
                  <td> <?php echo $value["dept_division"]?> </td>
                  <td> <?php echo $value["dept_position"]?> </td>
                  <td> <?php echo $value["salary_total"]?> </td>
                  <td> <?php echo $value["salary_basic"]?> </td>
                  <td> <?php echo $value["salary_kpi"]?> </td>

                  <td class="text-right">
                    <div class="dropdown dropdown-action">
                      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?php echo base_url().'hr/hr_payroll_salary/edit_salary/'.base64_encode($value["emp_nip"]) ?>"><i class="fa fa-pencil m-r-5"></i> Edit Salary </a>
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

</div>
<!-- /Page Wrapper -->
