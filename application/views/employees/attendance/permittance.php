<!-- Page Wrapper -->
<div class="page-wrapper">

 <!-- Page Content -->
 <div class="content container-fluid">

	 <!-- Page Header -->
	 <div class="page-header">
		 <div class="row align-items-center">
			 <div class="col">
				 <h3 class="page-title">Permittance </h3>
				 <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
					 <li class="breadcrumb-item">Attendance </li>
					 <li class="breadcrumb-item active">Permittance </li>
				 </ul>
			 </div>
			 <div class="col-auto float-right ml-auto">
				 <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Input Permittance </a>
			 </div>
		 </div>
	 </div>
	 <!-- /Page Header -->
   <!-- alert error -->
   <?php if (!empty($alert)) { ?>
     <div class="alert <?php echo 'alert-'.$status_alert ?> alert-dismissible fade show" role="alert">
       <strong></strong> <p> <?php echo $alert ?> </p>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times; </span>
       </button>
     </div>
   <?php } ?>
   <!-- alert error -->
   <hr>

	 <div class="row">
		 <div class="col-md-12">
       <h3>Your Permit History</h3>
       <p> Reports to: <?php echo $this->session->userdata('dept_manager') ?></p>
			 <div class="table-responsive">
				 <table class="table table-striped custom-table mb-0 datatable">
					 <thead>
						 <tr>
							 <!-- <th>Employee </th> -->
               <th>#</th>
							 <th>Reason </th>
               <th>Request Date</th>
							 <th>From </th>
							 <th>To </th>
							 <!-- <th>Days </th> -->
               <th>Time (h:min)</th>
							 <th>Cause </th>
							 <th class="text-center">Status </th>
							 <!-- <th class="text-right">Actions </th> -->
						 </tr>
					 </thead>
					 <tbody>
             <?php
              if (!empty($userPermit)) {
                $i=1;
                foreach ($userPermit as $key => $value) {
             ?>
						 <tr>
							 <!-- <td>
								 <h2 class="table-avatar">
									 <a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg" /></a>
									 <a href="#"><?php echo $this->session->userdata('user_fullname') ?>
                     <span>Divisi / Department </span>
                     <span>Jabatan </span>
                   </a>
								 </h2>
							 </td> -->
               <td><?php echo $i ?></td>
							 <td><?php echo $value["permit_reason"] ?> </td>
               <td><?php echo $value["permit_request_date"] ?></td>
							 <td><?php echo $value["permit_from"] ?> </td>
							 <td><?php echo $value["permit_to"] ?> </td>
							 <!-- <td><?php echo $value["permit_days"] ?> </td> -->
               <td><?php echo $value["permit_hours"].":".$value["permit_minutes"] ?> </td>
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
                   <p><?php echo $value["permit_approved_date"] ?></p>
									 <!-- <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-purple"></i> New </a>
									 </div> -->
								 </div>
							 </td>
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
           <?php $i++;} }?>
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
				 <h5 class="modal-title">Request Permittance </h5>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times; </span>
				 </button>
			 </div>
			 <div class="modal-body">
				 <form class="form" action="<?php echo base_url()."employee/Emp_attendance_permittance/insert_izin" ?>" method="POST">
           <div class="form-group">
             <input type="hidden" name="master_nip" value="<?php echo $this->session->userdata('user_name') ?>">
             <input type="hidden" name="leave_manager_nip" value="<?php echo $this->session->userdata('dept_manager') ?>">
           </div>
					 <div class="form-group">
						 <label>Reason <span class="text-danger">* </span></label>
						 <select class="select" name="leave_reason" required>
							 <option value="Keperluan pekerjaan"/>Keperluan pekerjaan
							 <option value="Keperluan pribadi"/>Keperluan pribadi
						 </select>
					 </div>
					 <div class="form-group">
						 <label>From <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="datetime-local" name="leave_from" required/>
						 </div>
					 </div>
					 <div class="form-group">
						 <label>To  <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="datetime-local" name="leave_to" required/>
						 </div>
					 </div>
					 <!-- <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" type="text" name="leave_days" required/>
					 </div> -->
					 <div class="form-group">
						 <label>Cause  <span class="text-danger">* </span></label>
						 <textarea rows="4" class="form-control" name="leave_cause" required></textarea>
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
						 <div class="">
							 <input class="form-control" value="01-01-2019" type="text" />
						 </div>
					 </div>
					 <div class="form-group">
						 <label>To  <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" value="01-01-2019" type="text" />
						 </div>
					 </div>
					 <!-- <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" type="text" value="2" />
					 </div> -->
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


</div>
<!-- /Page Wrapper -->
