<!-- Page Wrapper -->
<div class="page-wrapper">

 <!-- Page Content -->
 <div class="content container-fluid">

	 <!-- Page Header -->
	 <div class="page-header">
		 <div class="row align-items-center">
			 <div class="col">
				 <h3 class="page-title">Permittance (Manager)</h3>
				 <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
					 <li class="breadcrumb-item">Attendance </li>
					 <li class="breadcrumb-item active">Permittance (Manager)</li>
				 </ul>
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

   <!-- Manager Table -->
   <?php if ($this->session->userdata('dept_level') == "Manager" || $this->session->userdata('dept_level') == "Leader" || $this->session->userdata('dept_level') == "Coordinator" || $this->session->userdata('dept_level') == "Director" || $this->session->userdata('dept_level') == "Supervisor") { ?>
     <div class="row">
       <div class="col-md-12">
         <h3>Your Staff Permit Request</h3>
         <div class="table-responsive">
           <table class="table table-striped custom-table mb-0 datatable">
             <thead>
               <tr>
                 <th>Employee </th>
                 <th>Reason </th>
                 <th nowrap>Request Date</th>
                 <th>From </th>
                 <th>To </th>
                 <!-- <th>Days </th> -->
                 <th>Time (min)</th>
                 <th>Cause </th>
                 <th class="text-center">Status </th>
                 <th nowrap>Pay Cut</th>
                 <th>Dispensation Reason</th>
                 <th class="text-right">Actions </th>
               </tr>
             </thead>
             <tbody>
               <?php
                if (!empty($staffPermit)) {
                  foreach ($staffPermit as $key => $value) {
               ?>
               <tr>
                 <td>
                   <h2 class="table-avatar">
                     <!-- <a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg" /></a> -->
                     <a href="#"><?php echo $value["staff_fullname"] ?>
                       <span><?php echo $value["staff_nip"] ?> </span>
                       <!-- <span>Jabatan </span> -->
                     </a>
                   </h2>
                 </td>
                 <td><?php echo $value["permit_reason"] ?> </td>
                 <td><?php echo $value["permit_request_date"] ?> </td>
                 <td><?php echo $value["permit_from"] ?> </td>
                 <td><?php echo $value["permit_to"] ?> </td>
                 <!-- <td><?php echo $value["permit_days"] ?> </td> -->
                 <td><?php echo ($value["permit_hours"]*60)+$value["permit_minutes"] ?> </td>
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
                 <td>
                   <?php if ($value["permit_paycut_flag"] == 0) { ?>
                      Not Cut
                  <?php } else { ?>
                      Pay Cut
                  <?php } ?>
                 </td>
                 <td><?php echo $value["permit_paycut_approved_date"]."<br>".$value["permit_paycut_reason"] ?></td>
                 <td class="text-right">
                   <div class="dropdown dropdown-action">
                     <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                     <div class="dropdown-menu dropdown-menu-right">
                       <a class="dropdown-item" href="<?php echo base_url().'employee/Emp_attendance_permittance/approve_permit/'.$value["permit_id"] ?>"><i class="fa fa-check m-r-5 text-success"></i> Approve </a>
                       <a class="dropdown-item" href="<?php echo base_url().'employee/Emp_attendance_permittance/decline_permit/'.$value["permit_id"] ?>"><i class="fa fa-close m-r-5 text-danger"></i> Decline </a>
                       <?php if ($value["permit_reason"] == "Keperluan pribadi" && $value["permit_paycut_flag"] == 1): ?>
                         <a class="dropdown-item" href="<?php echo base_url().'employee/Emp_attendance_permittance/dispensation_permit/'.$value["permit_id"] ?>"><i class="fa fa-asterisk m-r-5" style="color:orange"></i> Dispensation </a>
                       <?php endif; ?>
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
   <?php } ?>
   <!-- END Manager Table -->
 </div>
 <!-- /Page Content -->


</div>
<!-- /Page Wrapper -->
