<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Overtime (OT) </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item">Attendance </li>
            <li class="breadcrumb-item active">Overtime (Lembur) </li>
          </ul>
        </div>
        <div class="col-auto float-right ml-auto">
          <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_overtime"><i class="fa fa-plus"></i> Tambah Lemburan </a>
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
                <th>#</th>
                <th nowrap>Tanggal Lembur </th>
                <th class="text-center">Jumlah jam (yang diajukan)</th>
                <th class="text-center">Jumlah jam (yang disetujui)</th>
                <th>Deskripsi </th>
                <th class="text-center">Manager Approval </th>
                <th class="text-center">HR Approval </th>
              </tr>
            </thead>
            <tbody>
              <?php
               if (!empty($otlist)) {
                 $i=1;
                 foreach ($otlist as $key => $value) {
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td> <?php echo $value["overtime_date"] ?> </td>
                <td class="text-center"> <?php echo $value["overtime_request_hour"] ?> </td>
                <td class="text-center"> <?php echo !empty($value["overtime_approved_hour"])?$value["overtime_approved_hour"]:"Waiting" ?> </td>
                <td> <?php echo $value["overtime_remarks"] ?> </td>
                <td class="text-center">
                  <div class="action-label">
                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                      <?php if ($value["overtime_flag_manager"] == 1) { ?>
                        <?php if ($value["datediff"] > 2): ?>
                          <i class="fa fa-close text-danger"></i> Kadaluwarsa
                        <?php else: ?>
                          <i class="fa fa-dot-circle-o text-purple"></i> Menunggu
                        <?php endif; ?>
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                      <?php } elseif ($value["overtime_flag_manager"] == 2) { ?>
                        <i class="fa fa-check text-success"></i> Disetujui
                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                      <?php } elseif ($value["overtime_flag_manager"] == 3) { ?>
                        <i class="fa fa-close text-danger"></i> Ditolak
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                      <?php } ?>
                    </a>
                    <p><?php echo $value["overtime_approved_date"]; ?></p>
                  </div>
                </td>
                <td class="text-center">
                  <div class="action-label">
                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                      <?php if ($value["overtime_flag_hrd"] == 1) { ?>
                        <?php if ($value["datediff"] > 2): ?>
                          <i class="fa fa-close text-danger"></i> Kadaluwarsa
                        <?php else: ?>
                          <i class="fa fa-dot-circle-o text-purple"></i> Menunggu
                        <?php endif; ?>
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                      <?php } elseif ($value["overtime_flag_hrd"] == 2) { ?>
                        <i class="fa fa-check text-success"></i> Disetujui
                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                      <?php } elseif ($value["overtime_flag_hrd"] == 3) { ?>
                        <i class="fa fa-close text-danger"></i> Ditolak
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                      <?php } ?>
                    </a>
                    <p><?php echo $value["overtime_approved_hr_date"]; ?></p>
                  </div>
                </td>
                <!-- <td class="text-right">
                  <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit </a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                    </div>
                  </div>
                </td> -->
              </tr>
              <?php $i++;} }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->

  <!-- Add Overtime Modal -->
  <div id="add_overtime" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Lemburan </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."employee/Emp_attendance_overtime/insert_overtime" ?>" method="post">
            <div class="form-group">
              <label>Di ajukan oleh <span class="text-danger">* </span></label>
              <select class="select" name="master_nip">
                <option value="<?php echo $this->session->userdata('user_name')?>"/> <?php echo $this->session->userdata('user_fullname') ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Lembur (Pilih salah satu) <span class="text-danger">* </span></label>
              <div class="cal-icon">
                <input class="form-control" name="overtime_date_raw" type="text" value="<?php echo DATE("Y-m-d") ?>" readonly/>
              </div>
            </div>
            <div class="form-group row">
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="1"/> Kemarin
            		 </label>
            	 </div>
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="2" checked="checked"/> Hari ini
            		 </label>
            	 </div>
            	 <div class="radio col-md-4">
            		 <label>
            			 <input type="radio" name="overtime_date_parameter" value="3"/> Besok
            		 </label>
            	 </div>
            </div>
            <div class="form-group">
              <label>Jam Lembur yang diajukan (Max. 6 jam) <span class="text-danger">* </span></label>
              <input class="form-control" name="overtime_request_hour" type="number" min="1" max="6" />
            </div>
            <div class="form-group">
              <label>Keterangan  <span class="text-danger">* </span></label>
              <textarea rows="4" class="form-control" name="overtime_remarks"></textarea>
            </div>
            <div class="form-group">
              <label>NIP Supervisor  <span class="text-danger">* </span></label>
              <input class="form-control" type="text" name="overtime_manager_nip" value="<?php echo $this->session->userdata('dept_manager') ?>"  readonly required/>
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
