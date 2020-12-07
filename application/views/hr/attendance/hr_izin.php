<!-- Page Wrapper -->
<div class="page-wrapper">

 <!-- Page Content -->
 <div class="content container-fluid">

	 <!-- Page Header -->
	 <div class="page-header">
		 <div class="row align-items-center">
			 <div class="col">
				 <h3 class="page-title">Permittance (HR) </h3>
				 <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
					 <li class="breadcrumb-item active">Permittance (HR) </li>
				 </ul>
			 </div>
			 <div class="col-auto float-right ml-auto">
				 <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Request Permit </a>
			 </div>
		 </div>
	 </div>
	 <!-- /Page Header -->

	 <!-- Leave Statistics -->
	 <!-- <div class="row">
		 <div class="col-md-3">
			 <div class="stats-info">
				 <h6>Today Presents </h6>
				 <h4>12 / 60 </h4>
			 </div>
		 </div>
		 <div class="col-md-3">
			 <div class="stats-info">
				 <h6>Planned Leaves </h6>
				 <h4>8  <span>Today </span></h4>
			 </div>
		 </div>
		 <div class="col-md-3">
			 <div class="stats-info">
				 <h6>Unplanned Leaves </h6>
				 <h4>0  <span>Today </span></h4>
			 </div>
		 </div>
		 <div class="col-md-3">
			 <div class="stats-info">
				 <h6>Pending Requests </h6>
				 <h4>12 </h4>
			 </div>
		 </div>
	 </div> -->
	 <!-- /Leave Statistics -->

	 <div class="row">
		 <div class="col-md-12">
			 <div class="table-responsive">
         <table class="table table-striped custom-table mb-0 datatable">
					 <thead>
						 <tr>
							 <th>Employee </th>
							 <th>Reason </th>
							 <th>From </th>
							 <th>To </th>
							 <th>Minutes </th>
							 <th>Cause </th>
							 <th class="text-center">Status </th>
               <th>Pay Cut</th>
               <th>Dispensation Reason</th>
               <th>Manager</th>
							 <!-- <th class="text-right">Actions </th> -->
						 </tr>
					 </thead>
					 <tbody>
             <?php
              if (!empty($userPermit)) {
                foreach ($userPermit as $key => $value) {
             ?>
						 <tr>
							 <td>
								 <h2 class="table-avatar">
									 <!-- <a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg" /></a> -->
									 <a href="#"><?php echo $value["user_fullname"] ?>
                     <span><?php echo $value["user_nip"] ?></span>
                     <!-- <span>Jabatan </span> -->
                   </a>
								 </h2>
							 </td>
               <!-- <td><?php echo $value["user_nip"] ?></td> -->
							 <td><?php echo $value["permit_reason"] ?> </td>
							 <td><?php echo $value["permit_from"] ?> </td>
							 <td><?php echo $value["permit_to"] ?> </td>
							 <td><?php echo ($value["permit_hours"] * 60) + $value["permit_minutes"] ?> </td>
							 <td><?php echo $value["permit_cause"] ?> </td>
							 <td class="text-center">
								 <div class="dropdown action-label">
									 <a class="btn btn-white btn-sm btn-rounded dropdown-toggle">
                     <?php if ($value["permit_approved_flag"] == 1) { ?>
                       <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                       <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                     <?php } elseif ($value["permit_approved_flag"] == 2) { ?>
                       <i class="fa fa-dot-circle-o text-success"></i> Approved
                       <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                     <?php } elseif ($value["permit_approved_flag"] == 3) { ?>
                       <i class="fa fa-dot-circle-o text-danger"></i> Declined
                       <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                     <?php } ?>
									 </a>
									 <!-- <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-purple"></i> New </a>
									 </div> -->
								 </div>
							 </td>
               <td>
                 <?php if ($value["permit_paycut_flag"] == 0) { ?>
                    Not Cut
                <?php } else { ?>
                    Pay Cut
                <?php } ?>
               </td>
               <td><?php echo $value["permit_paycut_approved_date"]."<br>".$value["permit_paycut_reason"] ?></td>
               <td><?php echo $value["permit_manager_nip"] ?></td>
							 <!-- <td class="text-right">
								 <div class="dropdown dropdown-action">
									 <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
									 <div class="dropdown-menu dropdown-menu-right">
										 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit </a>
										 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete </a>
									 </div>
								 </div>
							 </td> -->
						 </tr>
           <?php } }?>
					 </tbody>
				 </table>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Page Content -->

 <!-- Add Leave Modal -->
 <div id="add_leave" class="modal custom-modal fade" role="dialog">
	 <div class="modal-dialog modal-dialog-centered" role="document">
		 <div class="modal-content">
			 <div class="modal-header">
				 <h5 class="modal-title">Input Izin </h5>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times; </span>
				 </button>
			 </div>
			 <div class="modal-body">
				 <form>
					 <div class="form-group">
						 <label>Reason  <span class="text-danger">* </span></label>
						 <select class="select">
							 <option />Keperluan pekerjaan
							 <option />Keperluan pribadi
							 <option />Izin datang terlambat
							 <option />Meninggalkan kantor pada jam kerja
               <option />Pulang kerja lebih awal
               <option />Perjalanan dinas
						 </select>
					 </div>
					 <div class="form-group">
						 <label>From  <span class="text-danger">* </span></label>
						 <div class="cal-icon">
							 <input class="form-control" type="date" />
						 </div>
					 </div>
					 <div class="form-group">
						 <label>To  <span class="text-danger">* </span></label>
						 <div class="cal-icon">
							 <input class="form-control" type="date" />
						 </div>
					 </div>
					 <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" readonly="" type="text" />
					 </div>
					 <div class="form-group">
						 <label>Cause  <span class="text-danger">* </span></label>
						 <textarea rows="4" class="form-control"></textarea>
					 </div>
					 <div class="submit-section">
						 <button class="btn btn-primary submit-btn">Submit </button>
					 </div>
				 </form>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Add Leave Modal -->

 <!-- Edit Leave Modal -->
 <div id="edit_leave" class="modal custom-modal fade" role="dialog">
	 <div class="modal-dialog modal-dialog-centered" role="document">
		 <div class="modal-content">
			 <div class="modal-header">
				 <h5 class="modal-title">Edit Leave </h5>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times; </span>
				 </button>
			 </div>
			 <div class="modal-body">
				 <form>
					 <div class="form-group">
						 <label>Leave Type  <span class="text-danger">* </span></label>
						 <select class="select">
							 <option />Select Leave Type
							 <option />Casual Leave 12 Days
						 </select>
					 </div>
					 <div class="form-group">
						 <label>From  <span class="text-danger">* </span></label>
						 <div class="cal-icon">
							 <input class="form-control" value="01-01-2019" type="text" />
						 </div>
					 </div>
					 <div class="form-group">
						 <label>To  <span class="text-danger">* </span></label>
						 <div class="cal-icon">
							 <input class="form-control" value="01-01-2019" type="text" />
						 </div>
					 </div>
					 <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" readonly="" type="text" value="2" />
					 </div>
					 <div class="form-group">
						 <label>Remaining Leaves  <span class="text-danger">* </span></label>
						 <input class="form-control" readonly="" value="12" type="text" />
					 </div>
					 <div class="form-group">
						 <label>Leave Reason  <span class="text-danger">* </span></label>
						 <textarea rows="4" class="form-control">Going to hospital </textarea>
					 </div>
					 <div class="submit-section">
						 <button class="btn btn-primary submit-btn">Save </button>
					 </div>
				 </form>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Edit Leave Modal -->

 <!-- Approve Leave Modal -->
 <div class="modal custom-modal fade" id="approve_leave" role="dialog">
	 <div class="modal-dialog modal-dialog-centered">
		 <div class="modal-content">
			 <div class="modal-body">
				 <div class="form-header">
					 <h3>Leave Approve </h3>
					 <p>Are you sure want __ approve for this leave? </p>
				 </div>
				 <div class="modal-btn delete-action">
					 <div class="row">
						 <div class="col-6">
							 <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve </a>
						 </div>
						 <div class="col-6">
							 <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Decline </a>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Approve Leave Modal -->

 <!-- Delete Leave Modal -->
 <div class="modal custom-modal fade" id="delete_approve" role="dialog">
	 <div class="modal-dialog modal-dialog-centered">
		 <div class="modal-content">
			 <div class="modal-body">
				 <div class="form-header">
					 <h3>Delete Leave </h3>
					 <p>Are you sure want __ delete this leave? </p>
				 </div>
				 <div class="modal-btn delete-action">
					 <div class="row">
						 <div class="col-6">
							 <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete </a>
						 </div>
						 <div class="col-6">
							 <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel </a>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Delete Leave Modal -->

</div>
<!-- /Page Wrapper -->
