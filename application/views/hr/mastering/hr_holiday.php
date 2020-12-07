<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Holiday </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Mastering </li>
            <li class="breadcrumb-item active">Holiday </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <hr>
    <h4>Year: <?php echo $year; ?></h4>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th># </th>
                <th>Holiday Date </th>
                <th>Holiday Year </th>
                <th>Holiday Description </th>
                <th>Stamp User </th>
                <th>Stamp Date </th>
                <th class="text-right">Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php
               if (!empty($holidaylist)) {
                 $i=1;
                 foreach ($holidaylist as $key => $value) {
              ?>
              <tr>
                <td> <?php echo $i ?> </td>
                <td> <?php echo $value["holiday_date"] ?> </td>
                <td> <?php echo $value["holiday_year"] ?> </td>
                <td> <?php echo $value["holiday_title"] ?> </td>
                <td> <?php echo $value["holiday_stampuser"] ?> </td>
                <td> <?php echo $value["holiday_stampdate"] ?> </td>
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_mastering_holiday/delete_holiday/".$value["holiday_id"] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete </a>
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
  <div id="add_holiday" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Holiday </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."hr/Hr_mastering_holiday/insert_holiday" ?>" method="post">
            <div class="form-group">
              <label>Holiday Title <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="holiday_title" type="text" value="" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Holiday Date <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="holiday_date" type="date" value="<?php echo DATE("Y-m-d") ?>" required/>
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
  <!-- /Add Holiday Modal -->

</div>
<!-- /Page Wrapper -->
