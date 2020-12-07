<!-- Page Wrapper -->
<div class="page-wrapper">

 <!-- Page Content -->
 <div class="content container-fluid">

	 <!-- Page Header -->
	 <div class="page-header">
		 <div class="row align-items-center">
			 <div class="col">
				 <h3 class="page-title"> Employee Contracts </h3>
				 <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
					 <li class="breadcrumb-item"> Employee </li>
					 <li class="breadcrumb-item active"> Contract </li>
				 </ul>
			 </div>
			 <div class="col-auto float-right ml-auto">
				 <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Contract </a>
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
       <h3>Employee Contract History</h3>
			 <div class="table-responsive">
				 <table class="table table-striped custom-table mb-0 datatable">
					 <thead>
						 <tr>
               <th># </th>
							 <th>Employee </th>
               <th>Department </th>
							 <th>Signed Date </th>
							 <th>End Date </th>
							 <th>File </th>
							 <th class="text-right">Actions </th>
						 </tr>
					 </thead>
					 <tbody>
             <?php
              if (!empty($contract_list)) {
                $i = 1;
                foreach ($contract_list as $key => $value) {
             ?>
						 <tr>
               <td><?php echo $i; ?></td>
               <td>
								 <h2 class="table-avatar">
									 <p><?php  echo $value["emp_fullname"] ?>
                     <span><?php  echo $value["master_nip"] ?> </span>
                   </p>
								 </h2>
							 </td>
               <td><?php echo $value["dept_position"] ?> </td>
							 <td><?php echo $value["contract_signed_date"] ?> </td>
							 <td><?php echo $value["contract_end_date"] ?> </td>
							 <td>
                 <a href="<?php echo base_url().'assets/uploads/emp_contracts/'.$value["contract_file"] ?>" class="btn btn-info" target="_BLANK"> See Contract</a>
                 <!-- <img src="<?php echo base_url().'assets/uploads/emp_contracts/'.$value["contract_file"] ?>" class="img img-responsive" width="100px" alt=""> </td> -->
               <td class="text-right">
                 <div class="dropdown dropdown-action">
                   <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert </i></a>
                   <div class="dropdown-menu dropdown-menu-right">
                     <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_employee_contract/edit_contract/".$value["contract_id"] ?>"><i class="fa fa-edit m-r-5 text-primary"></i> Edit </a>
                     <!-- <a class="dropdown-item" href="<?php echo base_url()."hr/Hr_employee_contract/delete_contract/".$value["contract_id"] ?>"><i class="fa fa-close m-r-5 text-danger"></i> Delete </a> -->
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

 <!-- Add Contract Modal -->
 <div id="add_leave" class="modal custom-modal fade" role="dialog">
	 <div class="modal-dialog modal-dialog-centered" role="document">
		 <div class="modal-content">
			 <div class="modal-header">
				 <h5 class="modal-title">Add Contract </h5>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times; </span>
				 </button>
			 </div>
			 <div class="modal-body">
				 <form class="form" action="<?php echo base_url()."hr/hr_employee_contract/insert_contract" ?>" method="POST" enctype="multipart/form-data">
           <div class="form-group">
						 <label>Employee NIP<span class="text-danger">* </span></label>
						 <select class="form-control js-select2" name="master_nip">
               <option value="">Select</option>
               <?php foreach ($emp_list as $key => $value): ?>
                 <option value="<?php echo $value["emp_nip"] ?>"><?php echo $value["emp_nip"]." - ".$value["emp_fullname"] ?></option>
               <?php endforeach; ?>
             </select>
					 </div>
					 <div class="form-group">
						 <label>Contract Signed Date <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="date" name="contract_signed_date" value="<?php echo DATE("Y-m-d") ?>" required/>
						 </div>
					 </div>
					 <div class="form-group">
						 <label>Contract End Date <span class="text-danger">* </span></label>
						 <div class="">
							 <input class="form-control" type="date" name="contract_end_date" value="<?php echo DATE("Y-m-d") ?>" required/>
						 </div>
					 </div>
           <div class="form-group">
             <label>Upload Contract Document <span class="text-danger">* </span></label>
             <input class="form-control" type="file" name="contract_file" required/>
           </div>
					 <div class="submit-section">
						 <button class="btn btn-primary submit-btn">Submit </button>
					 </div>
				 </form>
			 </div>
		 </div>
	 </div>
 </div>
 <!-- /Add Contract Modal -->

</div>
<!-- /Page Wrapper -->
