<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Add Employee </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Employee </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">Personal Information Form </h4>
          </div>
          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_employee/save_edit_employee" ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Full Name </label>
                    <input type="text" class="form-control" name="emp_fullname" value="<?php echo $emp_fullname?>" />
                  </div>
                  <div class="form-group">
                    <label>Email </label>
                    <input type="text" class="form-control" name="emp_email" value="<?php echo $emp_email?>"/>
                  </div>
                  <div class="form-group">
                    <label>Gender </label>
                    <select class="select" name="emp_gender">
                      <option value="Pria" <?php if ($emp_gender == "Pria"){ echo "Selected";} ?> />Pria
                      <option value="Wanita" <?php if ($emp_gender == "Wanita"){ echo "Selected";} ?> />Wanita
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Birthplace </label>
                    <input type="text" class="form-control" name="emp_birthplace" value="<?php echo $emp_birthplace?>" />
                  </div>
                  <div class="form-group">
                    <label>Marital Status </label>
                    <select class="select" name="emp_marital_status">
                      <option value="TK" <?php if ($emp_marital_status == "TK"){ echo "Selected";} ?>/>TK - Tidak Kawin
                      <option value="K0" <?php if ($emp_marital_status == "K0"){ echo "Selected";} ?>/>K0 - Kawin 0 Anak
                      <option value="K1" <?php if ($emp_marital_status == "K1"){ echo "Selected";} ?>/>K1 - Kawin 1 Anak
                      <option value="K2" <?php if ($emp_marital_status == "K2"){ echo "Selected";} ?>/>K2 - Kawin 2 Anak
                      <option value="K3" <?php if ($emp_marital_status == "K3"){ echo "Selected";} ?>/>K3 - Kawin 3 Anak
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bank Account No. </label>
                    <input type="text" class="form-control" name="emp_bank_acc" value="<?php echo $emp_bank_acc?>"/>
                  </div>
                  <div class="form-group">
                    <label>Address </label>
                    <textarea rows="3" cols="80" class="form-control" name="emp_address"><?php echo $emp_address ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIP </label>
                    <input type="text" class="form-control" name="emp_nip" value="<?php echo $emp_nip?>"/>
                  </div>
                  <div class="form-group">
                    <label>Phone </label>
                    <input type="text" class="form-control" name="emp_phone" value="<?php echo $emp_phone ?>"/>
                  </div>
                  <div class="form-group">
                    <label>Religion </label>
                    <select class="select" name="emp_religion">
                      <option value="Islam" <?php if ($emp_religion == "Islam"){ echo "Selected";} ?>/>Islam
                      <option value="Kristen" <?php if ($emp_religion == "Kristen"){ echo "Selected";} ?>/>Kristen
                      <option value="Katholik" <?php if ($emp_religion == "Katholik"){ echo "Selected";} ?>/>Katolik
                      <option value="Budha" <?php if ($emp_religion == "Budha"){ echo "Selected";} ?>/>Budha
                      <option value="Hindu" <?php if ($emp_religion == "Hindu"){ echo "Selected";} ?>/>Hindu
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Birthdate </label>
                    <input type="date" class="form-control" name="emp_birthdate" value="<?php echo $emp_birthdate ?>"/>
                  </div>
                  <div class="form-group">
                    <label>Last Education Grade </label>
                    <select class="select" name="emp_last_edu_grade">
                      <option value="SD" <?php if ($emp_last_edu_grade == "SD"){ echo "Selected";} ?>/>SD
                      <option value="SMP" <?php if ($emp_last_edu_grade == "SMP"){ echo "Selected";} ?>/>SMP
                      <option value="SMA/K" <?php if ($emp_last_edu_grade == "SMA/K"){ echo "Selected";} ?>/>SMA/K
                      <option value="S-I" <?php if ($emp_last_edu_grade == "S-I"){ echo "Selected";} ?>/>S-I
                      <option value="S-II" <?php if ($emp_last_edu_grade == "S-II"){ echo "Selected";} ?>/>S-II
                      <option value="S-III" <?php if ($emp_last_edu_grade == "S-III"){ echo "Selected";} ?>/>S-III
                      <option value="D-I" <?php if ($emp_last_edu_grade == "D-I"){ echo "Selected";} ?>/>D-I
                      <option value="D-II" <?php if ($emp_last_edu_grade == "D-II"){ echo "Selected";} ?>/>D-II
                      <option value="D-III" <?php if ($emp_last_edu_grade == "D-III"){ echo "Selected";} ?>/>D-III
                      <option value="D-IV" <?php if ($emp_last_edu_grade == "D-IV"){ echo "Selected";} ?>/>D-IV
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bank Account Name </label>
                    <input type="text" class="form-control" name="emp_bank_accname" value="<?php echo $emp_bank_accname ?>"/>
                  </div>
                  <div class="form-group">
                    <label> Employee Absen Id </label>
                    <input type="text" class="form-control" name="emp_absen_id" value="<?php echo $emp_absen_id ?>"/>
                  </div>
                </div>
              </div>

              <br>

              <h4 class="card-title">Employment </h4>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Reports to</label>
                    <!-- <input type="text" name="dept_manager" value="<?php echo $dept_manager ?>" placeholder="Manager's NIP" class="form-control"> -->
                    <select class="form-control select select2" name="dept_manager">
                      <option value=""/> Select
                        <?php foreach ($managerList as $key => $value): ?>
                          <option value="<?php echo $value["emp_nip"] ?>" <?php if($value["emp_nip"] == $dept_manager) {echo "selected";} ?>><?php echo $value["emp_fullname"]." - ".$value["dept_position"] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Office Hour (Schedule)</label>
                    <select class="form-control js-select2" name="emp_office_hour">
                      <?php foreach ($scheduleList as $key => $value): ?>
                        <option value="<?php echo $value["hourType"] ?>" <?php if ($value["hourType"] == $emp_office_hour) {echo "selected";} ?> /> <?php echo $value["hourName"]." (".$value["hourTimeIn"]." - ".$value["hourTimeOut"].")"  ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Divisi </label>
                    <select class="form-control js-select2" name="dept_division">
                      <option value=""/> Select
                      <option value="Commercial & Service" <?php if ($dept_division == "Commercial & Service"){ echo "Selected";} ?>/>Commercial & Service
                      <option value="Finance, Accounting & Tax" <?php if ($dept_division == "Finance, Accounting & Tax"){ echo "Selected";} ?>/>Finance, Accounting & Tax
                      <option value="HR, Legal, GA" <?php if ($dept_division == "HR, Legal, GA"){ echo "Selected";} ?>/>HR, Legal, GA
                      <option value="Information Technology" <?php if ($dept_division == "Information Technology"){ echo "Selected";} ?>/>Information Technology
                      <option value="Operation" <?php if ($dept_division == "Operation"){ echo "Selected";} ?>/>Operation
                      <option value="Operation & Support" <?php if ($dept_division == "Operation & Support"){ echo "Selected";} ?>/>Operation & Support
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Department </label>
                    <select class="form-control js-select2" name="dept_name">
                      <option value=""/> Select
                      <option value="Accounting & Tax" <?php if ($dept_name == "Accounting & Tax"){ echo "Selected";} ?>/>Accounting & Tax
                      <option value="Finance" <?php if ($dept_name == "Finance"){ echo "Selected";} ?>/>Finance
                      <option value="General Affairs" <?php if ($dept_name == "General Affairs"){ echo "Selected";} ?>/>General Affairs
                      <option value="Human Resources" <?php if ($dept_name == "Human Resources"){ echo "Selected";} ?>/>Human Resources
                      <option value="Legal" <?php if ($dept_name == "Legal"){ echo "Selected";} ?>/>Legal
                      <option value="Networking Management" <?php if ($dept_name == "Networking Management"){ echo "Selected";} ?>/>Networking Management
                      <option value="Operation" <?php if ($dept_name == "Operation"){ echo "Selected";} ?>/>Operation
                      <option value="Programming" <?php if ($dept_name == "Programming"){ echo "Selected";} ?>/>Programming
                      <option value="Sales" <?php if ($dept_name == "Sales"){ echo "Selected";} ?>/>Sales
                      <option value="Sales & Marketing Support" <?php if ($dept_name == "Sales & Marketing Support"){ echo "Selected";} ?>/>Sales & Marketing Support
                      <option value="Support & Data Entry" <?php if ($dept_name == "Support & Data Entry"){ echo "Selected";} ?>/>Support & Data Entry
                      <option value="Support & Design" <?php if ($dept_name == "Support & Design"){ echo "Selected";} ?>/>Support & Design
                      <option value="Support & Maintenance" <?php if ($dept_name == "Support & Maintenance"){ echo "Selected";} ?>/>Support & Maintenance
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Department </label>
                    <select class="form-control js-select2" name="dept_subname">
                      <option value=""/> Select
                      <option value="Account Management" <?php if ($dept_subname == "Account Management"){ echo "Selected";} ?>/>Account Management
                      <option value="Billing" <?php if ($dept_subname == "Billing"){ echo "Selected";} ?>/>Billing
                      <option value="CDC" <?php if ($dept_subname == "CDC"){ echo "Selected";} ?>/>CDC
                      <option value="Collection" <?php if ($dept_subname == "Collection"){ echo "Selected";} ?>/>Collection
                      <option value="Courier" <?php if ($dept_subname == "Courier"){ echo "Selected";} ?>/>Courier
                      <option value="Customer Service" <?php if ($dept_subname == "Customer Service"){ echo "Selected";} ?>/>Customer Service
                      <option value="Dedicated" <?php if ($dept_subname == "Dedicated"){ echo "Selected";} ?>/>Dedicated
                      <option value="Network" <?php if ($dept_subname == "Network"){ echo "Selected";} ?>/>Network
                      <option value="Pricing" <?php if ($dept_subname == "Pricing"){ echo "Selected";} ?>/>Pricing
                      <option value="Sorter & Gateway" <?php if ($dept_subname == "Sorter & Gateway"){ echo "Selected";} ?>/>Sorter & Gateway
                      <option value="Treasury" <?php if ($dept_subname == "Treasury"){ echo "Selected";} ?>/>Treasury
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Position </label>
                    <select class="form-control js-select2" name="dept_position">
                      <option value=""/> Select
                      <option value="Account Executive" <?php if ($dept_position == "Account Executive"){ echo "Selected";} ?>/>Account Executive
                      <option value="Accounting Staff" <?php if ($dept_position == "Accounting Staff"){ echo "Selected";} ?>/>Accounting Staff
                      <option value="Admin" <?php if ($dept_position == "Admin"){ echo "Selected";} ?>/>Admin
                      <option value="Admin Finance" <?php if ($dept_position == "Admin Finance"){ echo "Selected";} ?>/>Admin Finance
                      <option value="Admin Gateway & Project" <?php if ($dept_position == "Admin Gateway & Project"){ echo "Selected";} ?>/>Admin Gateway & Project
                      <option value="Admin Operation" <?php if ($dept_position == "Admin Operation"){ echo "Selected";} ?>/>Admin Operation
                      <option value="Admin Umum" <?php if ($dept_position == "Admin Umum"){ echo "Selected";} ?>/>Admin Umum
                      <option value="Administration" <?php if ($dept_position == "Administration"){ echo "Selected";} ?>/>Administration
                      <option value="Billing Coordinator" <?php if ($dept_position == "Billing Coordinator"){ echo "Selected";} ?>/>Billing Coordinator
                      <option value="Billing Staff" <?php if ($dept_position == "Billing Staff"){ echo "Selected";} ?>/>Billing Staff
                      <option value="Billing Supervisor" <?php if ($dept_position == "Billing Supervisor"){ echo "Selected";} ?>/>Billing Supervisor
                      <option value="Branch Coordinator" <?php if ($dept_position == "Branch Coordinator"){ echo "Selected";} ?>/>Branch Coordinator
                      <option value="Branch Manager" <?php if ($dept_position == "Branch Manager"){ echo "Selected";} ?>/>Branch Manager
                      <option value="CDC Coordinator" <?php if ($dept_position == "CDC Coordinator"){ echo "Selected";} ?>/>CDC Coordinator
                      <option value="CDC Staff" <?php if ($dept_position == "CDC Staff"){ echo "Selected";} ?>/>CDC Staff
                      <option value="Chairman" <?php if ($dept_position == "Chairman"){ echo "Selected";} ?>/>Chairman
                      <option value="Checker" <?php if ($dept_position == "Checker"){ echo "Selected";} ?>/>Checker
                      <option value="Collection Staff" <?php if ($dept_position == "Collection Staff"){ echo "Selected";} ?>/>Collection Staff
                      <option value="Commisioner" <?php if ($dept_position == "Commisioner"){ echo "Selected";} ?>/>Commisioner
                      <option value="Courier Coordinator" <?php if ($dept_position == "Courier Coordinator"){ echo "Selected";} ?>/>Courier Coordinator
                      <option value="Courier Supervisor" <?php if ($dept_position == "Courier Supervisor"){ echo "Selected";} ?>/>Courier Supervisor
                      <option value="Customer Service" <?php if ($dept_position == "Customer Service"){ echo "Selected";} ?>/>Customer Service
                      <option value="Customer Service Supervisor" <?php if ($dept_position == "Customer Service Supervisor"){ echo "Selected";} ?>/>Customer Service Supervisor
                      <option value="Data Entry Staff" <?php if ($dept_position == "Data Entry Staff"){ echo "Selected";} ?>/>Data Entry Staff
                      <option value="Data Entry Coordinator" <?php if ($dept_position == "Data Entry Coordinator"){ echo "Selected";} ?>/>Data Entry Coordinator
                      <option value="Dispatcher" <?php if ($dept_position == "Dispatcher"){ echo "Selected";} ?>/>Dispatcher
                      <option value="Driver" <?php if ($dept_position == "Driver"){ echo "Selected";} ?>/>Driver
                      <option value="Finance Staff" <?php if ($dept_position == "Finance Staff"){ echo "Selected";} ?>/>Finance Staff
                      <option value="General Affair Staff" <?php if ($dept_position == "General Affair Staff"){ echo "Selected";} ?>/>General Affair Staff
                      <option value="General Affair Supervisor" <?php if ($dept_position == "General Affair Supervisor"){ echo "Selected";} ?>/>General Affair Supervisor
                      <option value="Gateway" <?php if ($dept_position == "Gateway"){ echo "Selected";} ?>/>Gateway
                      <option value="Gateway Coordinator" <?php if ($dept_position == "Gateway Coordinator"){ echo "Selected";} ?>/>Gateway Coordinator
                      <option value="Graphic Designer" <?php if ($dept_position == "Graphic Designer"){ echo "Selected";} ?>/>Graphic Designer
                      <option value="Head of Finance, Accounting & Tax" <?php if ($dept_position == "Head of Finance, Accounting & Tax"){ echo "Selected";} ?>/>Head of Finance, Accounting & Tax
                      <option value="Head of HR, Legal & GA" <?php if ($dept_position == "Head of HR, Legal & GA"){ echo "Selected";} ?>/>Head of HR, Legal & GA
                      <option value="Head of Networking Management" <?php if ($dept_position == "Head of Networking Management"){ echo "Selected";} ?>/>Head of Networking Management
                      <option value="Head of Sales & Marketing Support" <?php if ($dept_position == "Head of Sales & Marketing Support"){ echo "Selected";} ?>/>Head of Sales & Marketing Support
                      <option value="Helper" <?php if ($dept_position == "Helper"){ echo "Selected";} ?>/>Helper
                      <option value="HR Generalist Supervisor" <?php if ($dept_position == "HR Generalist Supervisor"){ echo "Selected";} ?>/>HR Generalist Supervisor
                      <option value="Implan" <?php if ($dept_position == "Implan"){ echo "Selected";} ?>/>Implan
                      <option value="IT & DE Supervisor" <?php if ($dept_position == "IT & DE Supervisor"){ echo "Selected";} ?>/>IT & DE Supervisor
                      <option value="IT Manager" <?php if ($dept_position == "IT Manager"){ echo "Selected";} ?>/>IT Manager
                      <option value="IT Support Supervisor" <?php if ($dept_position == "IT Support Supervisor"){ echo "Selected";} ?>/>IT Support Supervisor
                      <option value="Kurir - Hand Carry" <?php if ($dept_position == "Kurir - Hand Carry"){ echo "Selected";} ?>/>Kurir - Hand Carry
                      <option value="Kurir - Mobil" <?php if ($dept_position == "Kurir - Mobil"){ echo "Selected";} ?>/>Kurir - Mobil
                      <option value="Kurir - Mobil / Motor" <?php if ($dept_position == "Kurir - Mobil / Motor"){ echo "Selected";} ?>/>Kurir - Mobil / Motor
                      <option value="Kurir - Motor" <?php if ($dept_position == "Kurir - Motor"){ echo "Selected";} ?>/>Kurir - Motor
                      <option value="Kurir - Motor Coordinators" <?php if ($dept_position == "Kurir - Motor Coordinators"){ echo "Selected";} ?>/>Kurir - Motor Coordinators
                      <option value="Legal Staff" <?php if ($dept_position == "Legal Staff"){ echo "Selected";} ?>/>Legal Staff
                      <option value="Legal Supervisor" <?php if ($dept_position == "Legal Supervisor"){ echo "Selected";} ?>/>Legal Supervisor
                      <option value="Mailing Room" <?php if ($dept_position == "Mailing Room"){ echo "Selected";} ?>/>Mailing Room
                      <option value="Manager Account Management" <?php if ($dept_position == "Manager Account Management"){ echo "Selected";} ?>/>Manager Account Management
                      <option value="Managing Director" <?php if ($dept_position == "Managing Director"){ echo "Selected";} ?>/>Managing Director
                      <option value="Network Staff" <?php if ($dept_position == "Network Staff"){ echo "Selected";} ?>/>Network Staff
                      <option value="Network Supevisor" <?php if ($dept_position == "Network Supevisor"){ echo "Selected";} ?>/>Network Supevisor
                      <option value="Office Support" <?php if ($dept_position == "Office Support"){ echo "Selected";} ?>/>Office Support
                      <option value="Operation Coordinator" <?php if ($dept_position == "Operation Coordinator"){ echo "Selected";} ?>/>Operation Coordinator
                      <option value="Operation Deputy Manager" <?php if ($dept_position == "Operation Deputy Manager"){ echo "Selected";} ?>/>Operation Deputy Manager
                      <option value="Operation Manager" <?php if ($dept_position == "Operation Manager"){ echo "Selected";} ?>/>Operation Manager
                      <option value="Operation Staff" <?php if ($dept_position == "Operation Staff"){ echo "Selected";} ?>/>Operation Staff
                      <option value="Operation Support" <?php if ($dept_position == "Operation Support"){ echo "Selected";} ?>/>Operation Support
                      <option value="Operational Director" <?php if ($dept_position == "Operational Director"){ echo "Selected";} ?>/>Operational Director
                      <option value="Planner" <?php if ($dept_position == "Planner"){ echo "Selected";} ?>/>Planner
                      <option value="Prepare Coordinator" <?php if ($dept_position == "Prepare Coordinator"){ echo "Selected";} ?>/>Prepare Coordinator
                      <option value="President Commisioner" <?php if ($dept_position == "President Commisioner"){ echo "Selected";} ?>/>President Commisioner
                      <option value="President Director" <?php if ($dept_position == "President Director"){ echo "Selected";} ?>/>President Director
                      <option value="Pricing Coordinator" <?php if ($dept_position == "Pricing Coordinator"){ echo "Selected";} ?>/>Pricing Coordinator
                      <option value="Pricing Staff" <?php if ($dept_position == "Pricing Staff"){ echo "Selected";} ?>/>Pricing Staff
                      <option value="Programmer" <?php if ($dept_position == "Programmer"){ echo "Selected";} ?>/>Programmer
                      <option value="Project Coordinator" <?php if ($dept_position == "Project Coordinator"){ echo "Selected";} ?>/>Project Coordinator
                      <option value="Sales Executive" <?php if ($dept_position == "Sales Executive"){ echo "Selected";} ?>/>Sales Executive
                      <option value="Sales Support" <?php if ($dept_position == "Sales Support"){ echo "Selected";} ?>/>Sales Support
                      <option value="Security" <?php if ($dept_position == "Security"){ echo "Selected";} ?>/>Security
                      <option value="Sorter" <?php if ($dept_position == "Sorter"){ echo "Selected";} ?>/>Sorter
                      <option value="Sorter Coordinator" <?php if ($dept_position == "Sorter Coordinator"){ echo "Selected";} ?>/>Sorter Coordinator
                      <option value="Sorter Supervisor" <?php if ($dept_position == "Sorter Supervisor"){ echo "Selected";} ?>/>Sorter Supervisor
                      <option value="Staff Administrasi" <?php if ($dept_position == "Staff Administrasi"){ echo "Selected";} ?>/>Staff Administrasi
                      <option value="Treasury Staff" <?php if ($dept_position == "Treasury Staff"){ echo "Selected";} ?>/>Treasury Staff
                      <option value="Undelivery Staff" <?php if ($dept_position == "Undelivery Staff"){ echo "Selected";} ?>/>Undelivery Staff
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Designation </label>
                    <select class="select" name="emp_designation">
                      <option value="PST" <?php if ($emp_designation == "PST"){ echo "Selected";} ?>/>PST
                      <option value="BO/OPS" <?php if ($emp_designation == "BO/OPS"){ echo "Selected";} ?>/>BO/OPS
                      <option value="Pure OPS" <?php if ($emp_designation == "Pure OPS"){ echo "Selected";} ?>/>Pure OPS
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Contract</label>
                    <select class="select" name="emp_contract">
                      <option value="Kontrak" <?php if ($emp_contract == "Kontrak"){ echo "Selected";} ?>/>Kontrak
                      <option value="Tetap" <?php if ($emp_contract == "Tetap"){ echo "Selected";} ?>/>Tetap
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Project </label>
                    <input type="text" class="form-control" name="dept_project" value="<?php echo $dept_project ?>"/>
                  </div>
                  <div class="form-group">
                    <label>Terhitung Masuk Kerja (TMK)</label>
                    <input type="date" class="form-control" name="emp_date_entry" value="<?php echo $emp_date_entry ?>"/>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit </button>
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
