<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Payroll Min. Wage </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Payroll </li>
            <li class="breadcrumb-item active">Min. Wage </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_minwage"><i class="fa fa-plus"></i> Add Min. Wage </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <hr>
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
    
    <h4>Year: <?php echo $year; ?></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th># </th>
                <th>TLC Province / City </th>
                <th>Wage Year </th>
                <th>Amount (Rp) </th>
                <th>Stamp User </th>
                <th>Stamp Date </th>
                <th class="text-right">Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php
               if (!empty($wageList)) {
                 $i=1;
                 foreach ($wageList as $key => $value) {
              ?>
              <tr>
                <td> <?php echo $i ?> </td>
                <td> <?php echo $value["wage_tlcreg"] ?> </td>
                <td> <?php echo $value["wage_year"] ?> </td>
                <td> <?php echo $value["wage_amount"] ?> </td>
                <td> <?php echo $value["wage_stampuser"] ?> </td>
                <td> <?php echo $value["wage_stampdate"] ?> </td>
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_payroll_minwage/delete_minWage/".$value["wage_id"] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete </a>
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

  <!-- Add Holiday Modal -->
  <div id="add_minwage" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Minimum Wage </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."hr/Hr_payroll_minwage/insert_minwage" ?>" method="post">
            <div class="form-group">
              <label>Year <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="year" type="text" value="<?php echo DATE("Y") ?>" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Province / City <span class="text-danger">* </span></label>
              <select class="form-control select" name="wage_tlcreg">
                <option value="JKT" />JKT
                <option value="BDO" />BDO
                <option value="BPN" />BPN
                <option value="JOG" />JOG
                <option value="MES" />MES
                <option value="SRG" />SRG
                <option value="SUB" />SUB
                <option value="UPG" />UPG
              </select>
            </div>
            <div class="form-group">
              <label>Minimum Wage Amount <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="wage_amount" type="text" value="" placeholder="Please input only number. Ex: 4500500" required/>
              </div>
            </div>

            <div class="submit-section">
              <button class="btn btn-primary submit-btn">Submit </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Overtime Modal -->

</div>
<!-- /Page Wrapper -->
