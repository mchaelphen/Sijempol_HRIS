<!-- Page Wrapper -->
<div class="page-wrapper">

 <!-- Page Content -->
 <div class="content container-fluid">

	 <!-- Page Header -->
	 <div class="page-header">
		 <div class="row align-items-center">
			 <div class="col">
				 <h3 class="page-title"> Sick Leave (HR) </h3>
				 <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
					 <li class="breadcrumb-item active"> Sick Leave(HR) </li>
				 </ul>
			 </div>
			 <div class="col-auto float-right ml-auto">
				 <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Sick Leave </a>
			 </div>
		 </div>
	 </div>
	 <!-- /Page Header -->
   <!-- alert error -->
   <?php if (!empty($alert)) { ?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success! </strong> <p> <?php echo $alert ?> </p>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times; </span>
       </button>
     </div>
   <?php } ?>
   <!-- alert error -->

   <hr>
	 <div class="row">
		 <div class="col-md-12">
       <h3>Employee Sick Leave History</h3>
			 <div class="table-responsive">
				 <table class="table table-striped custom-table mb-0 datatable">
					 <thead>
						 <tr>
							 <th>Employee </th>
               <th>Request Date</th>
							 <th>From </th>
							 <th>To </th>
							 <th>No of Days </th>
							 <th>Remarks </th>
							 <th>Image </th>
               <th>HR Approval</th>
							 <th class="text-right">Actions </th>
						 </tr>
					 </thead>
					 <tbody>
             <?php
              if (!empty($userMedic)) {
                foreach ($userMedic as $key => $value) {
             ?>
						 <tr>
               <td>
								 <h2 class="table-avatar">
									 <!-- <a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg" /></a> -->
									 <p><?php  echo $value["emp_fullname"] ?>
                     <span><?php  echo $value["master_nip"] ?> </span>
                   </p>
								 </h2>
							 </td>
							 <td><?php echo $value["medic_request_date"] ?> </td>
							 <td><?php echo $value["medic_from"] ?> </td>
							 <td><?php echo $value["medic_to"] ?> </td>
							 <td><?php echo $value["medic_days"] ?> </td>
							 <td><?php echo $value["medic_remark"] ?> </td>
							 <td><img src="<?php echo base_url().'assets/uploads/attendance_medicalleave/'.$value["medic_upload"] ?>" class="img img-responsive" width="100px" alt=""> </td>
               <td class="text-center">
                 <div class="action-label">
                   <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                     <?php if ($value["medic_hr_approval_flag"] == 1) { ?>
                       <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                       <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                     <?php } elseif ($value["medic_hr_approval_flag"] == 2) { ?>
                       <i class="fa fa-check text-success"></i> Approved
                       <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                     <?php } elseif ($value["medic_hr_approval_flag"] == 3) { ?>
                       <i class="fa fa-close text-danger"></i> Declined
                       <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                     <?php } ?>
                   </a>
                   <p><?php echo $value["medic_hr_approval_date"]; ?></p>
                 </div>
               </td>
               <td class="text-right">
                 <div class="dropdown dropdown-action">
                   <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                   <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_attendance_medicleave/editMedicalLeave/".$value["medic_id"] ?>"><i class="fa fa-edit m-r-5 text-primary"></i> Edit </a>
                     <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_attendance_medicleave/approve_sickleave/".$value["medic_id"] ?>"><i class="fa fa-check m-r-5 text-success"></i> Approve </a>
                     <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_attendance_medicleave/decline_sickleave/".$value["medic_id"] ?>"><i class="fa fa-close m-r-5 text-danger"></i> Decline </a>
                   </div>
                 </div>
               </td>
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
				 <h5 class="modal-title">Add Sick Leave </h5>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times; </span>
				 </button>
			 </div>
			 <div class="modal-body">
				 <form class="form" action="<?php echo base_url()."employee/Emp_attendance_medicleave/insert_medicleave" ?>" method="POST" enctype="multipart/form-data">
           <div class="form-group">
             <input type="hidden" name="medic_manager_nip" value="<?php echo $this->session->userdata('dept_manager') ?>">
           </div>
           <div class="form-group">
						 <label>Employee NIP<span class="text-danger">* </span></label>
						 <input class="form-control" type="text" name="master_nip" required/>
					 </div>
           <div class="form-group">
						 <label>Employee's Manager NIP<span class="text-danger">* </span></label>
						 <input class="form-control" type="text" name="medic_manager_nip" required/>
					 </div>
					 <div class="form-group">
						 <label>From <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="date" name="medic_from" value="<?php echo DATE("Y-m-d") ?>" required/>
						 </div>
					 </div>
					 <div class="form-group">
						 <label>To  <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="date" name="medic_to" value="<?php echo DATE("Y-m-d") ?>" required/>
						 </div>
					 </div>
           <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" type="text" name="medic_days" required/>
					 </div>
					 <div class="form-group">
						 <label>Remarks  <span class="text-danger">* </span></label>
						 <textarea rows="4" class="form-control" name="medic_remark" required></textarea>
					 </div>
           <div class="form-group">
             <label>Upload Medical Letter  <span class="text-danger">* </span></label>
             <input class="form-control" type="file" name="medic_upload" required/>
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
					 <div class="form-group">
						 <label>Number of days  <span class="text-danger">* </span></label>
						 <input class="form-control" type="text" value="2" />
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


</div>
<!-- /Page Wrapper -->
