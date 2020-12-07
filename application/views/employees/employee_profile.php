<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Profile </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/employee_dashboard/'.base64_encode($this->session->userdata('user_name')) ?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Profile </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->
    <div class="card mb-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="profile-view">
              <div class="profile-img-wrap">
                <div class="profile-img">
                  <?php if (!empty($emp_profile_pic)) { ?>
                    <a href="#"><img alt="Profile Pic" src="<?php echo base_url().'assets/uploads/emp_pic/'.$emp_profile_pic?>" /></a>
                  <?php } else { ?>
                    <a href="#"><img alt="Profile Pic" src="<?php echo base_url().'assets/img/user.jpg'?>" /></a>
                  <?php } ?>
                </div>
              </div>
              <div class="profile-basic">
                <div class="row">
                  <div class="col-md-4">
                    <div class="profile-info-left">
                      <h3 class="user-name m-t-0 mb-0"> <?php echo $emp_fullname ?> </h3>
                      <h6 class="text-muted"> <?php echo $dept_division ?> (Division) </h6>
                      <h6 class="text-muted"> <?php echo $dept_name ?> (Department)</h6>
                      <h6 class="text-muted"> <?php echo $dept_subname ?> (Sub-Department)</h6>
                      <h6 class="text-muted"> <?php echo $dept_position ?> (Position)</h6>
                      <h6 class="text-muted"> <?php echo $dept_project ?> (Project)</h6>
                      <div class="staff-id">Employee ID : <?php echo $emp_nip ?> </div>
                      <div class="small doj text-muted">Date of Join : <?php echo $emp_date_entry ?> </div>
                      <!-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message </a></div> -->
                    </div>
                  </div>
                  <div class="col-md-8">
                    <ul class="personal-info">
                      <li>
                        <div class="title">Phone: </div>
                        <div class="text"><a href="#"><?php echo $emp_phone ?> </a></div>
                      </li>
                      <li>
                        <div class="title">Email: </div>
                        <div class="text"><a href="#"><?php echo $emp_email ?> </a></div>
                      </li>
                      <li>
                        <div class="title">Birthplace: </div>
                        <div class="text"><?php echo $emp_birthplace ?> </div>
                      </li>
                      <li>
                        <div class="title">Birthday: </div>
                        <div class="text"><?php echo $emp_birthdate ?> </div>
                      </li>
                      <li>
                        <div class="title">Address: </div>
                        <div class="text"><?php echo $emp_address ?></div>
                      </li>
                      <li>
                        <div class="title">Gender: </div>
                        <div class="text"><?php echo $emp_gender ?> </div>
                      </li>
                      <li>
                        <div class="title">Religion: </div>
                        <div class="text"><?php echo $emp_religion ?> </div>
                      </li>
                      <li>
                        <div class="title">Marital: </div>
                        <div class="text"><?php echo $emp_marital_status ?> </div>
                      </li>
                      <li>
                        <div class="title">Reports to: </div>
                        <div class="text">
                           <!-- <div class="avatar-box">
                            <div class="avatar avatar-xs">
                             <img src="assets/img/profiles/avatar-16.jpg" alt="" />
                            </div>
                           </div> -->
                           <div class="text-info"><?php echo $dept_manager ?></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="pro-edit">
              <?php if ($this->session->userdata('user_flag_editprofile') == 1 && $this->session->userdata('user_role') == 4 ) { ?>
                <!-- Employee Edit Personal Information -->
                <!-- <a class="edit-icon" href="<?php echo base_url().'employee/emp_profile/edit_profile/'.base64_encode($emp_nip) ?>"><i class="fa fa-pencil"></i></a> -->
                <a href="" class="edit-icon" data-toggle="modal" data-target="#profile_edit"><i class="fa fa-pencil"></i></a>
              <?php } if ($this->session->userdata('user_flag_editprofile') == 1 && $this->session->userdata('user_role') < 4 ) { ?>
                <!-- HR Edit Personal Information -->
                <a class="edit-icon" href="<?php echo base_url().'hr/hr_employee/edit_profile/'.base64_encode($emp_nip) ?>"><i class="fa fa-pencil"></i></a>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card tab-box">
      <div class="row user-tabs">
        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
          <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile </a></li>
            <!-- <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects </a></li>
            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory  <small class="text-danger">(Admin Only) </small></a></li> -->
          </ul>
        </div>
      </div>
    </div>

    <div class="tab-content">
      <!-- Profile Info Tab -->
      <div id="emp_profile" class="pro-overview tab-pane fade show active">
        <div class="row">
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">Documents
                  <?php if ($this->session->userdata('user_flag_editprofile') != 0): ?>
                  <a href="" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a>
                  <?php endif; ?>
                </h3>

                <!-- alert info upload -->
                <div class="container"><br>
                  <?php if ($this->session->userdata('user_flag_editprofile') == 1) { ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>Info! </strong>
                      <p> Format file yang dapat di upload: .jpg | .jpeg | .png | .pdf </p>
                      <p> Ukuran file maksimum: 5 MB</p>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                      </button>
                    </div>
                  <?php } ?>
                </div>
                <!-- alert info upload -->

                <div class="" style="overflow-y:auto; height:350px;">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Identity</th>
                        <th>No.</th>
                        <th>Upload</th>
                        <th>Download</th>
                      </tr>
                      <tr>
                        <td>KTP</td>
                        <td><?php echo $emp_ktp_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_ktp_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_ktp">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/ktp/".$emp_ktp_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_ktp_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_ktp/<?php echo $emp_ktp_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_ktp/<?php echo $emp_ktp_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>KK</td>
                        <td><?php echo $emp_kk_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_kk_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_kk">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/kk/".$emp_kk_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_kk_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_kk/<?php echo $emp_kk_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_kk/<?php echo $emp_kk_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>NPWP</td>
                        <td><?php echo $emp_npwp_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_npwp_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_npwp">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/npwp/".$emp_npwp_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_npwp_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_npwp/<?php echo $emp_npwp_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_npwp/<?php echo $emp_npwp_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>BPJS Kesehatan</td>
                        <td><?php echo $emp_bpjsKes_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_bpjsKes_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_bpjsKes">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/bpjsKes/".$emp_bpjsKes_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_bpjsKes_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_bpjsKes/<?php echo $emp_bpjsKes_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_bpjsKes/<?php echo $emp_bpjsKes_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>BPJS Ketenagakerjaan</td>
                        <td><?php echo $emp_bpjsTkj_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_bpjsTkj_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_bpjsTkj">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/bpjsTkj/".$emp_bpjsTkj_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_bpjsTkj_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_bpjsTkj/<?php echo $emp_bpjsTkj_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_bpjsTkj/<?php echo $emp_bpjsTkj_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>SIM A</td>
                        <td><?php echo $emp_simA_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_simA_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_simA">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/simA/".$emp_simA_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_simA_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_simA/<?php echo $emp_simA_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_simA/<?php echo $emp_simA_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>SIM B</td>
                        <td><?php echo $emp_simB_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_simB_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_simB">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/simB/".$emp_simB_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_simB_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_simB/<?php echo $emp_simB_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_simB/<?php echo $emp_simB_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>SIM C</td>
                        <td><?php echo $emp_simC_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_simC_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_simC">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/simC/".$emp_simC_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_simC_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_simC/<?php echo $emp_simC_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_simC/<?php echo $emp_simC_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Ijazah Terakhir</td>
                        <td><?php echo $emp_ijazah_num ?></td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <?php if (empty($emp_ijazah_img)) { ?>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#upload_ijazah">Upload &nbsp;<i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo base_url()."employee/emp_profile/unlinkFile/ijazah/".$emp_ijazah_img."/".$emp_nip ?>" class="btn btn-danger">Remove &nbsp;<i class="fa fa-trash"></i></a>
                            <?php } ?>
                          <?php } else { echo '<p class="text-danger"> Not Available </p>'; }?>
                        </td>
                        <td>
                          <?php if (!empty($emp_ijazah_img)) { ?>
                          <a href="<?php echo base_url() ?>assets/uploads/emp_ijazah/<?php echo $emp_ijazah_img ?>" target="_blank">
                            <img class="img img-responsive" width="150px" height="75px" src="<?php echo base_url() ?>assets/uploads/emp_ijazah/<?php echo $emp_ijazah_img ?>" alt="">
                          </a>
                        <?php } else { ?>
                          <p class="text-danger"> Document not found.</p>
                        <?php } ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">Bank information </h3>
                <ul class="personal-info">
                  <li>
                    <div class="title">Bank Name </div>
                    <div class="text">Bank Central Asia (BCA) </div>
                  </li>
                  <li>
                    <div class="title">Bank Account No. </div>
                    <div class="text"><?php echo $emp_bank_acc ?> </div>
                  </li>
                  <li>
                    <div class="title">Bank Account Name </div>
                    <div class="text"><?php echo $emp_bank_accname ?> </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">Education Informations
                  <?php if ($this->session->userdata('user_flag_editprofile') != 0): ?>
                  <a href="" class="edit-icon" data-toggle="modal" data-target="#education_add_modal"><i class="fa fa-plus"></i></a>
                  <?php endif; ?>
                </h3>
                <?php if (!empty($education)) { ?>
                <div class="experience-box">
                  <ul class="experience-list">
                    <?php foreach ($education as $key => $value) { ?>
                    <li>
                      <div class="experience-user">
                        <div class="before-circle"></div>
                      </div>
                      <div class="experience-content">
                        <div class="timeline-content">
                          <a href="<?php echo base_url()."employee/emp_profile/form_edit_education/".$value["edu_id"]."/".base64_encode($emp_nip) ?>" class="name"><?php echo $value["edu_schoolname"].' ('.$value["edu_grade"].')' ?> </a>
                          <div><?php echo $value["edu_major"] ?> </div>
                          <div>Indeks Prestasi Kumulatif: <?php echo $value["edu_grade_point"] ?> </div>
                          <span class="time"><?php echo $value["edu_startyear"]." - ".$value["edu_endyear"] ?> </span>
                        </div>
                      </div>
                    </li>
                    <?php } // end foreach $education ?>
                  </ul>
                </div>
                <?php } else {// show nothing if $education is null ?>
                  <p class="text-center"> No Education Data Found.</p>
                  <p class="text-center"> Please update your data or ask our HR for permission to update.</p>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex">
            <div class="card profile-box flex-fill">
              <div class="card-body">
                <h3 class="card-title">Family Informations
                  <?php if ($this->session->userdata('user_flag_editprofile') != 0): ?>
                  <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_add_modal"><i class="fa fa-plus"></i></a>
                  <?php endif; ?>
                </h3>
                <?php if (!empty($family)) { ?>
                <div class="table-responsive">
                  <table class="table table-nowrap">
                    <thead>
                      <tr>
                        <th>Name </th>
                        <th>Relationship </th>
                        <th>No. KTP </th>
                        <th>Phone </th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($family as $key => $value) { ?>
                      <tr>
                        <td><?php echo $value["fam_fullname"]?> </td>
                        <td><?php echo $value["fam_relationship"]?> </td>
                        <td><?php echo $value["fam_ktp_num"]?> </td>
                        <td><?php echo $value["fam_phone_num"]?> </td>
                        <td>
                          <?php if ($this->session->userdata('user_flag_editprofile') != 0) { ?>
                            <a href="<?php echo base_url()."employee/emp_profile/form_edit_family/".$value["fam_id"]."/".base64_encode($emp_nip) ?>"> Update </a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } // end foreach $family ?>
                    </tbody>
                  </table>
                </div>
                <?php } else { ?>
                  <p class="text-center"> No Family Data Found.</p>
                  <p class="text-center"> Please update your data or ask our HR for permission to update.</p>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Profile Info Tab -->

    </div>
  </div>
  <!-- /Page Content -->

  <!-- Profile Modal -->
  <div id="profile_edit" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Profile Contact Information </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/update_profile_contact' ?>" method="post">
            <div class="row">
              <div class="col-md-12">
                <!-- <div class="profile-img-wrap edit-img">
                  <img class="inline-block" src="assets/img/profiles/avatar-02.jpg" alt="user" />
                  <div class="fileupload btn">
                    <span class="btn-text">edit </span>
                    <input class="upload" type="file" />
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email </label>
                      <input type="email" class="form-control" value="<?php echo $emp_email ?>" name="emp_email" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone </label>
                      <input type="text" class="form-control" value="<?php echo $emp_phone ?>" name="emp_phone" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address </label>
                      <input type="text" class="form-control" value="<?php echo $emp_address ?>" name="emp_address" />
                    </div>
                  </div>
                </div>
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
  <!-- /Profile Modal -->

  <!-- Personal Info Modal -->
  <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Documents Id </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/update_personal_identification' ?>" method="post">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label> No. KTP </label>
                <input type="text" class="form-control" name="emp_ktp_num" value="<?php echo $emp_ktp_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. KK </label>
                <input type="text" class="form-control" name="emp_kk_num" value="<?php echo $emp_kk_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. NPWP  </label>
                <input type="text" class="form-control" name="emp_npwp_num" value="<?php echo $emp_npwp_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. BPJS Kesehatan </label>
                <input type="text" class="form-control" name="emp_bpjsKes_num" value="<?php echo $emp_bpjsKes_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. BPJS Ketenagakerjaan </label>
                <input type="text" class="form-control" name="emp_bpjsTkj_num" value="<?php echo $emp_bpjsTkj_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. SIM A </label>
                <input type="text" class="form-control" name="emp_simA_num" value="<?php echo $emp_simA_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. SIM B </label>
                <input type="text" class="form-control" name="emp_simB_num" value="<?php echo $emp_simB_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. SIM C </label>
                <input type="text" class="form-control" name="emp_simC_num" value="<?php echo $emp_simC_num ?>"/>
              </div>
              <div class="form-group">
                <label> No. Ijazah Terakhir </label>
                <input type="text" class="form-control" name="emp_ijazah_num" value="<?php echo $emp_ijazah_num ?>"/>
              </div>

              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Personal Info Modal -->

  <!-- Upload File Personal Info Modal -->
  <!-- KTP -->
  <div id="upload_ktp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload KTP </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/ktp' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>KTP Img. </label>
                <input type="file" class="form-control" name="emp_ktp_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- KK -->
  <div id="upload_kk" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload KK </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/kk' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>KK Img. </label>
                <input type="file" class="form-control" name="emp_kk_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- NPWP -->
  <div id="upload_npwp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload NPWP </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/npwp' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>NPWP Img. </label>
                <input type="file" class="form-control" name="emp_npwp_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- BPJS Kesehatan -->
  <div id="upload_bpjsKes" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload BPJS Kesehatan </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/bpjsKes' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>BPJS Kesehatan Img. </label>
                <input type="file" class="form-control" name="emp_bpjsKes_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- BPJS Ketenagakerjaan -->
  <div id="upload_bpjsTkj" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload BPJS Ketenagakerjaan </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/bpjsTkj' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>BPJS Ketenagakerjaan Img. </label>
                <input type="file" class="form-control" name="emp_bpjsTkj_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SIM A -->
  <div id="upload_simA" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload SIM A </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/simA' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>SIM A Img. </label>
                <input type="file" class="form-control" name="emp_simA_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SIM B -->
  <div id="upload_simB" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload SIM B </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/simB' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>SIM B Img. </label>
                <input type="file" class="form-control" name="emp_simB_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SIM C -->
  <div id="upload_simC" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload SIM C </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/simC' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>SIM C Img. </label>
                <input type="file" class="form-control" name="emp_simC_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Ijazah -->
  <div id="upload_ijazah" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Ijazah Terakhir </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'employee/emp_profile/upload_document/ijazah' ?>" method="post" enctype="multipart/form-data">
            <div class="container">
              <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
              <div class="form-group">
                <label>Ijazah Img. </label>
                <input type="file" class="form-control" name="emp_ijazah_img" />
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- /Personal Info Modal -->

  <!-- Family Info Modal -->
  <div id="family_add_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> Family Informations / Emergency Contacts</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times; </span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php  echo base_url()."employee/emp_profile/save_add_family" ?>" method="post">
            <div class="form-scroll">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Family Member </h3>
                  <div class="row">
                    <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Full Name  <span class="text-danger">* </span></label>
                        <input class="form-control" type="text" name="fam_fullname" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Relationship  <span class="text-danger">* </span></label>
                        <input class="form-control" type="text" name="fam_relationship" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>No. KTP  <span class="text-danger">* </span></label>
                        <input class="form-control" type="text" name="fam_ktp_num" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone  <span class="text-danger">* </span></label>
                        <input class="form-control" type="text" name="fam_phone_num" required/>
                      </div>
                    </div>
                  </div>
                </div>
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
  <!-- /Family Info Modal -->

  <!-- Education Modal -->
  <div id="education_add_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> Add Education History </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times; </span>
            </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()."employee/emp_profile/save_add_education" ?>" method="post">
            <div class="form-scroll">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Education Informations </h3>
                  <!-- <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a> -->
                  <div class="row">
                    <input type="hidden" name="emp_nip" value="<?php echo $emp_nip ?>">
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <input type="text" value="" class="form-control floating" name="edu_schoolname" required />
                        <label class="focus-label">Institution </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <input type="text" value="" class="form-control floating" name="edu_major" placeholder="Contoh: Teknik Informatika"/>
                        <label class="focus-label">Subject / Major</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <div class="cal-icon">
                          <input type="text" value="" class="form-control floating " name="edu_startyear" placeholder="4 digit year, ex: 2000" required/>
                        </div>
                        <label class="focus-label">Starting Year </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <div class="cal-icon">
                          <input type="text" value="" class="form-control floating " name="edu_endyear" placeholder="4 digit year, ex: 2006" required/>
                        </div>
                        <label class="focus-label">Complete Year </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <select class="select form-control floating" name="edu_grade">
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
                        <label class="focus-label">Degree </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-focus focused">
                        <input type="text" value="" class="form-control floating" name="edu_grade_point"/>
                        <label class="focus-label">Grade Point / IPK </label>
                      </div>
                    </div>
                  </div>
                </div>
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
  <!-- /Education Modal -->

</div>
<!-- /Page Wrapper -->
