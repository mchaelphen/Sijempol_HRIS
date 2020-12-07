<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Edit Contract  </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item"> Employee </li>
 					 <li class="breadcrumb-item active"> Contract </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Edit Contract Form </h4>
          </div>

          <div class="card-body">
            <form class="form" action="<?php echo base_url()."hr/hr_employee_contract/update_contract" ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" name="contract_id" value="<?php echo $contract_id?>">
                <input type="hidden" name="old_contract_file" value="<?php echo $contract_file?>">
              </div>
              <div class="form-group">
   						 <label>Employee NIP<span class="text-danger">* </span></label>
   						 <select class="form-control" name="master_nip" readonly>
                  <option value="<?php echo $master_nip ?>"><?php echo $master_nip." - ".$emp_fullname ?></option>
                </select>
   					 </div>
   					 <div class="form-group">
   						 <label>Contract Signed Date <span class="text-danger">* </span></label>
   						 <div class="">
   							 <input class="form-control" type="date" name="contract_signed_date" value="<?php echo $contract_signed_date ?>" required/>
   						 </div>
   					 </div>
   					 <div class="form-group">
   						 <label>Contract End Date <span class="text-danger">* </span></label>
   						 <div class="">
   							 <input class="form-control" type="date" name="contract_end_date" value="<?php echo $contract_end_date ?>" required/>
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

  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
