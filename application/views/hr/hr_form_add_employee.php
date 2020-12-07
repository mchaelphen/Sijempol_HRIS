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

          <!-- alert error -->
          <div class="container"><br>
            <?php if (!empty($alert)) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong> <p> <?php echo $message ?> </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; </span>
                </button>
              </div>
            <?php } ?>
          </div>
          <!-- alert error -->
          <div class="card-body">
            <form action="<?php echo base_url()."hr/Hr_employee/save_add_employee" ?>" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Full Name </label>
                    <input type="text" class="form-control" name="emp_fullname" required />
                  </div>
                  <div class="form-group">
                    <label>NIP </label>
                    <input type="text" class="form-control" name="emp_nip" required />
                  </div>

                  <div class="form-group">
                    <label>Email </label>
                    <input type="text" class="form-control" name="emp_email"/>
                  </div>
                  <div class="form-group">
                    <label>Gender </label>
                    <select class="select" name="emp_gender" required>
                      <option value="Pria" />Pria
                      <option value="Wanita" />Wanita
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Birthplace </label>
                    <input type="text" class="form-control" name="emp_birthplace" />
                  </div>
                  <div class="form-group">
                    <label>Marital Status </label>
                    <select class="select" name="emp_marital_status">
                      <option value="TK" />TK - Tidak Kawin
                      <option value="K0" />K0 - Kawin 0 Anak
                      <option value="K1" />K1 - Kawin 1 Anak
                      <option value="K2" />K2 - Kawin 2 Anak
                      <option value="K3" />K3 - Kawin 3 Anak
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bank Account No. </label>
                    <input type="text" class="form-control" name="emp_bank_acc"/>
                  </div>
                  <div class="form-group">
                    <label>Address </label>
                    <textarea rows="3" cols="80" class="form-control" name="emp_address"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>User Role </label>
                    <select class="select" name="user_role">
                      <option value="4" />Staff
                      <!-- <option value="1" />HR Manager
                      <option value="2" />HR Supervisor
                      <option value="3" />HR Staff -->
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Password </label>
                    <input type="text" class="form-control" name="user_pass" required/>
                  </div>
                  <div class="form-group">
                    <label>Phone </label>
                    <input type="text" class="form-control" name="emp_phone"/>
                  </div>
                  <div class="form-group">
                    <label>Religion </label>
                    <select class="select" name="emp_religion">
                      <option value="Islam" />Islam
                      <option value="Kristen" />Kristen
                      <option value="Katholik" />Katholik
                      <option value="Budha" />Budha
                      <option value="Hindu" />Hindu
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Birthdate </label>
                    <input type="date" class="form-control" name="emp_birthdate"/>
                  </div>
                  <div class="form-group">
                    <label>Last Education Grade </label>
                    <select class="select" name="emp_last_edu_grade">
                      <option value="SD" />SD
                      <option value="SMP" />SMP
                      <option value="SMA/K" />SMA/K
                      <option value="S-I" />S-I
                      <option value="S-II" />S-II
                      <option value="S-III" />S-III
                      <option value="D-I" />D-I
                      <option value="D-II" />D-II
                      <option value="D-III" />D-III
                      <option value="D-IV" />D-IV
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bank Account Name </label>
                    <input type="text" class="form-control" name="emp_bank_accname"/>
                  </div>
                  <div class="form-group">
                    <label> Employee Absen Id </label>
                    <input type="text" class="form-control" name="emp_absen_id"/>
                  </div>
                </div>
              </div>

              <br>

              <h4 class="card-title">Employment </h4>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Branch </label>
                    <select class="form-control js-select2" name="emp_branch">
                      <option value=""/> Select
                      <option value="JKT" />JKT
                      <option value="BDO" />BDO
                      <option value="BPN" />BPN
                      <option value="CBN" />CBN
                      <option value="JOG" />JOG
                      <option value="MES" />MES
                      <option value="PWO" />PWO
                      <option value="SOC" />SOC
                      <option value="SRG" />SRG
                      <option value="SUB" />SUB
                      <option value="UPG" />UPG
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Level </label>
                    <select class="select" name="dept_level">
                      <option value="Staff" />Staff
                      <option value="Supervisor" />Supervisor
                      <option value="Manager" />Manager
                      <option value="Assistant Manager" />Assistant Manager
                      <option value="Leader" />Leader
                      <option value="Coordinator" />Coordinator
                      <option value="Director" />Director
                      <option value="Commisioner" />Commisioner
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Reports to</label>
                    <!-- <input type="text" name="dept_manager" value="" placeholder="Manager's NIP" class="form-control"> -->
                    <select class="form-control select select2" name="dept_manager">
                      <option value=""/> Select
                        <?php foreach ($managerList as $key => $value): ?>
                          <option value="<?php echo $value["emp_nip"] ?>"><?php echo $value["emp_fullname"]." - ".$value["dept_position"] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Office Hour (Schedule)</label>
                    <select class="form-control js-select2" name="emp_office_hour">
                      <?php foreach ($scheduleList as $key => $value): ?>
                        <option value="<?php echo $value["hourType"] ?>" /> <?php echo $value["hourName"]." (".$value["hourTimeIn"]." - ".$value["hourTimeOut"].")"  ?>
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
                      <option value="Commercial & Service" />Commercial & Service
                      <option value="Finance, Accounting & Tax" />Finance, Accounting & Tax
                      <option value="HR, Legal, GA" />HR, Legal, GA
                      <option value="Information Technology" />Information Technology
                      <option value="Operation" />Operation
                      <option value="Operation & Support" />Operation & Support
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Department </label>
                    <select class="form-control js-select2" name="dept_name">
                      <option value=""/> Select
                      <option value="Accounting & Tax" />Accounting & Tax
                      <option value="Finance" />Finance
                      <option value="General Affairs" />General Affairs
                      <option value="Human Resources" />Human Resources
                      <option value="Legal" />Legal
                      <option value="Networking Management" />Networking Management
                      <option value="Operation" />Operation
                      <option value="Programming" />Programming
                      <option value="Sales" />Sales
                      <option value="Sales & Marketing Support" />Sales & Marketing Support
                      <option value="Support & Data Entry" />Support & Data Entry
                      <option value="Support & Design" />Support & Design
                      <option value="Support & Maintenance" />Support & Maintenance
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Department </label>
                    <select class="form-control js-select2" name="dept_subname">
                      <option value=""/> Select
                      <option value="Account Management" />Account Management
                      <option value="Billing" />Billing
                      <option value="CDC" />CDC
                      <option value="Collection" />Collection
                      <option value="Courier" />Courier
                      <option value="Customer Service" />Customer Service
                      <option value="Dedicated" />Dedicated
                      <option value="Network" />Network
                      <option value="Pricing" />Pricing
                      <option value="Sorter & Gateway" />Sorter & Gateway
                      <option value="Treasury" />Treasury
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Position </label>
                    <select class="form-control js-select2" name="dept_position">
                      <option value=""/> Select
                      <option value="Account Executive" />Account Executive
                      <option value="Accounting Staff" />Accounting Staff
                      <option value="Admin" />Admin
                      <option value="Admin Finance" />Admin Finance
                      <option value="Admin Gateway & Project" />Admin Gateway & Project
                      <option value="Admin Operation" />Admin Operation
                      <option value="Admin Umum" />Admin Umum
                      <option value="Administration" />Administration
                      <option value="Billing Coordinator" />Billing Coordinator
                      <option value="Billing Staff" />Billing Staff
                      <option value="Billing Supervisor" />Billing Supervisor
                      <option value="Branch Coordinator" />Branch Coordinator
                      <option value="Branch Manager" />Branch Manager
                      <option value="CDC Coordinator" />CDC Coordinator
                      <option value="CDC Staff" />CDC Staff
                      <option value="Chairman" />Chairman
                      <option value="Checker" />Checker
                      <option value="Collection Staff" />Collection Staff
                      <option value="Commisioner" />Commisioner
                      <option value="Courier Coordinator" />Courier Coordinator
                      <option value="Courier Supervisor" />Courier Supervisor
                      <option value="Customer Service" />Customer Service
                      <option value="Customer Service Supervisor" />Customer Service Supervisor
                      <option value="Data Entry Staff" />Data Entry Staff
                      <option value="Data Entry Coordinator" />Data Entry Coordinator
                      <option value="Dispatcher" />Dispatcher
                      <option value="Driver" />Driver
                      <option value="Finance Staff" />Finance Staff
                      <option value="General Affair Staff" />General Affair Staff
                      <option value="General Affair Supervisor" />General Affair Supervisor
                      <option value="Gateway" />Gateway
                      <option value="Gateway Coordinator" />Gateway Coordinator
                      <option value="Graphic Designer" />Graphic Designer
                      <option value="Head of Finance, Accounting & Tax" />Head of Finance, Accounting & Tax
                      <option value="Head of HR, Legal & GA" />Head of HR, Legal & GA
                      <option value="Head of Networking Management" />Head of Networking Management
                      <option value="Head of Sales & Marketing Support" />Head of Sales & Marketing Support
                      <option value="Helper" />Helper
                      <option value="HR Generalist Supervisor" />HR Generalist Supervisor
                      <option value="Implan" />Implan
                      <option value="IT & DE Supervisor" />IT & DE Supervisor
                      <option value="IT Manager" />IT Manager
                      <option value="IT Support Supervisor" />IT Support Supervisor
                      <option value="Kurir - Hand Carry" />Kurir - Hand Carry
                      <option value="Kurir - Mobil" />Kurir - Mobil
                      <option value="Kurir - Mobil / Motor" />Kurir - Mobil / Motor
                      <option value="Kurir - Motor" />Kurir - Motor
                      <option value="Kurir - Motor Coordinators" />Kurir - Motor Coordinators
                      <option value="Legal Staff" />Legal Staff
                      <option value="Legal Supervisor" />Legal Supervisor
                      <option value="Mailing Room" />Mailing Room
                      <option value="Manager Account Management" />Manager Account Management
                      <option value="Managing Director" />Managing Director
                      <option value="Network Staff" />Network Staff
                      <option value="Network Supevisor" />Network Supevisor
                      <option value="Office Support" />Office Support
                      <option value="Operation Coordinator" />Operation Coordinator
                      <option value="Operation Deputy Manager" />Operation Deputy Manager
                      <option value="Operation Manager" />Operation Manager
                      <option value="Operation Staff" />Operation Staff
                      <option value="Operation Support" />Operation Support
                      <option value="Operational Director" />Operational Director
                      <option value="Planner" />Planner
                      <option value="Prepare Coordinator" />Prepare Coordinator
                      <option value="President Commisioner" />President Commisioner
                      <option value="President Director" />President Director
                      <option value="Pricing Coordinator" />Pricing Coordinator
                      <option value="Pricing Staff" />Pricing Staff
                      <option value="Programmer" />Programmer
                      <option value="Project Coordinator" />Project Coordinator
                      <option value="Sales Executive" />Sales Executive
                      <option value="Sales Support" />Sales Support
                      <option value="Security" />Security
                      <option value="Sorter" />Sorter
                      <option value="Sorter Coordinator" />Sorter Coordinator
                      <option value="Sorter Supervisor" />Sorter Supervisor
                      <option value="Staff Administrasi" />Staff Administrasi
                      <option value="Treasury Staff" />Treasury Staff
                      <option value="Undelivery Staff" />Undelivery Staff
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Designation </label>
                    <select class="select" name="emp_designation">
                      <option value="PST" />PST
                      <option value="BO/OPS" />BO/OPS
                      <option value="Pure OPS" />Pure OPS
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Contract</label>
                    <select class="select" name="emp_contract">
                      <option value="Kontrak" />Kontrak
                      <option value="Tetap" />Tetap
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Project </label>
                    <input type="text" class="form-control" name="dept_project"/>
                  </div>
                  <div class="form-group">
                    <label>Terhitung Masuk Kerja (TMK)</label>
                    <input type="date" class="form-control" name="emp_date_entry"/>
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
