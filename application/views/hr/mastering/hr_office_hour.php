<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Office Hour </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Mastering </li>
            <li class="breadcrumb-item active">Office Hour </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_officehour"><i class="fa fa-plus"></i> Add Office Hour </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0 datatable">
            <thead>
              <tr>
                <th># </th>
                <th>Code </th>
                <th>Title </th>
                <th>Time In </th>
                <th>Time Out </th>
                <th>Hour Over </th>
                <th>Time In Late </th>
                <th>Stamp User </th>
                <th>Stamp Date </th>
                <th class="text-right">Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php
               if (!empty($scheduleList)) {
                 $i=1;
                 foreach ($scheduleList as $key => $value) {
              ?>
              <tr>
                <td> <?php echo $i ?> </td>
                <td> <?php echo $value["hourType"] ?>      </td>
                <td> <?php echo $value["hourName"] ?>      </td>
                <td> <?php echo $value["hourTimeIn"] ?>    </td>
                <td> <?php echo $value["hourTimeOut"] ?>   </td>
                <td> <?php echo $value["hourOver"] ?>      </td>
                <td> <?php echo $value["hourlate"] ?>      </td>
                <td> <?php echo $value["hourStampUser"] ?> </td>
                <td> <?php echo $value["hourStampDate"] ?> </td>
                <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_mastering_officeHour/edit_schedule/".$value["hourId"] ?>"><i class="fa fa-edit text-primary m-r-5"></i> Edit </a>
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
  <div id="add_officehour" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Office Hour Schedule </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."hr/Hr_mastering_officeHour/insert_schedule" ?>" method="post">
            <div class="form-group">
              <label>Code of Hour Type<span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="hourType" type="text" value="" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Title <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="hourName" type="text" value=""  required/>
              </div>
            </div>
            <div class="form-group">
              <label>Cross day flag <span class="text-danger">* </span></label>
              <div class="">
                <select class="form-control" name="hourOver">
                  <option value="0">Same Day</option>
                  <option value="1">Cross Day</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Time In <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="hourTimeIn" type="time" value="" placeholder="ex: 08:00" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Time Out <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="hourTimeOut" type="time" value="" placeholder="ex: 17:00" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Time In Late <span class="text-danger">* </span></label>
              <div class="">
                <input class="form-control" name="hourlate" type="time" value="" placeholder="ex: 08:05" required/>
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
