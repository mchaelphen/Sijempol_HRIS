<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="welcome-box">
          <div class="welcome-img">
            <?php if (!empty($emp_profile_pic)) { ?>
              <img alt="" src="<?php echo base_url().'assets/uploads/emp_pic/'.$emp_profile_pic ?> " />
            <?php } else { ?>
              <img alt="" src="<?php echo base_url().'assets/img/user.jpg'?> " />
            <?php } ?>
          </div>
          <div class="welcome-det">
            <h3>Hello, <?php echo $this->session->userdata('user_fullname') ?> </h3>
            <p><?php echo $this->session->userdata('date_today') ?> </p>
            <!-- <p class="text-center">Time In Hari Ini: <?php echo $pairingTimeInToday ?> </p> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-8">

        <!-- <section class="dash-section">
          <h1 class="dash-sec-title">Today </h1>
          <div class="dash-sec-content">
            <div class="dash-info-list">
              <a href="#" class="dash-card text-danger">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-hourglass-o"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>Richard Miles is off ____ today </p>
                  </div>
                  <div class="dash-card-avatars">
                    <div class="e-avatar"><img src="assets/img/profiles/avatar-09.jpg" alt="" /></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="dash-info-list">
              <a href="#" class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>You are away today </p>
                  </div>
                  <div class="dash-card-avatars">
                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt="" /></div>
                  </div>
                </div>
              </a>
            </div>

            <div class="dash-info-list">
              <a href="#" class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-building-o"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>You are working from ____ today </p>
                  </div>
                  <div class="dash-card-avatars">
                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt="" /></div>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </section>

        <section class="dash-section">
          <h1 class="dash-sec-title">Tomorrow </h1>
          <div class="dash-sec-content">
            <div class="dash-info-list">
              <div class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>2 people will be ____ tomorrow </p>
                  </div>
                  <div class="dash-card-avatars">
                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-04.jpg" alt="" /></a>
                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-08.jpg" alt="" /></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="dash-section">
          <h1 class="dash-sec-title">Next seven days </h1>
          <div class="dash-sec-content">
            <div class="dash-info-list">
              <div class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>2 people are going __ be away </p>
                  </div>
                  <div class="dash-card-avatars">
                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-05.jpg" alt="" /></a>
                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-07.jpg" alt="" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="dash-info-list">
              <div class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-user-plus"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>Your first day is _____ to be  on ________ </p>
                  </div>
                  <div class="dash-card-avatars">
                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt="" /></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dash-info-list">
              <a href="employee-dashboard.html" class="dash-card">
                <div class="dash-card-container">
                  <div class="dash-card-icon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <div class="dash-card-content">
                    <p>It's Spring Bank Holiday  on Monday </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </section> -->
      </div>

      <div class="col-lg-4 col-md-4">
        <div class="dash-sidebar">
          <?php if ($this->session->userdata('user_flag_attendanceonline') == '1') { ?>
          <!-- Absen -->
          <section>
            <h5 class="dash-title">Attendance </h5>
            <!-- alert error -->
            <?php if (!empty($alert)) { ?>
              <?php if ($alert == 1 || $alert == 3) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hi! </strong> <p> <?php echo $message ?> </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times; </span>
                </button>
              </div>
            <?php } ?>
            <?php if ($alert == 2 || $alert == 4 || $alert == 5 || $alert == 6) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error! </strong> <p> <?php echo $message ?> </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span>
              </button>
            </div>
          <?php } ?>
            <?php } ?>
            <!-- alert error -->
            <div class="card <?php if ($alert == 6) { echo "display-hide"; } ?>">
              <?php if ($hourOver == 1) { ?>
              <div class="card-body tab-pane">
                <h5 class="text-center">Yesterday</h5>
                <br>
                <div class="time-list">
                  <div class="dash-stats-list">
                    <p>Clock In At</p>
                    <p class="text-center"><?php echo $pairingTimeIn ?> </p>
                    <br>
                    <!-- <a class="btn btn-primary" href="<?php echo base_url().'Authentication/pushInAttendance'?>">Clock In </a> -->
                  </div>
                  <div class="dash-stats-list">
                    <p>Clock Out At</p>
                    <p class="text-center"><?php echo $pairingTimeOut ?> </p>
                    <br>
                    <a class="btn btn-primary" href="<?php echo base_url().'Authentication/pushOutAttendance'?>">Clock Out </a>
                  </div>
                </div>
                <div class="request-btn">
                </div>
              </div>
              <hr>
              <?php } ?>
              <div class="card-body tab-pane">
                <h5 class="text-center">Today</h5>
                <br>
                <div class="time-list">
                  <div class="dash-stats-list">
                    <p>Clock In At</p>
                    <p class="text-center"><?php echo $pairingTimeInToday ?> </p>
                    <br>
                    <a class="btn btn-primary" href="<?php echo base_url().'Authentication/pushInAttendance'?>">Clock In </a>
                  </div>
                  <div class="dash-stats-list">
                    <p>Clock Out At</p>
                    <p class="text-center"><?php echo $pairingTimeOutToday ?> </p>
                    <br>
                    <?php if ($hourOver != 1) { ?>
                      <a class="btn btn-primary" href="<?php echo base_url().'Authentication/pushOutAttendance'?>">Clock Out </a>
                    <?php } ?>
                  </div>
                </div>
                <div class="request-btn">
                </div>
              </div>
            </div>
          </section>
          <?php } ?>

          <!-- Cuti -->
          <section>
            <h5 class="dash-title">Your Leave </h5>
            <div class="card">
              <div class="card-body">
                <div class="time-list">
                  <div class="dash-stats-list">
                    <h4><?php echo $emp_taken_leave ?> </h4>
                    <p>Leave Taken </p>
                  </div>
                  <div class="dash-stats-list">
                    <h4><?php echo $emp_paid_leave ?> </h4>
                    <p>Remaining </p>
                  </div>
                </div>
                <div class="request-btn">
                  <a class="btn btn-primary" href="<?php echo base_url().'employee/Emp_attendance_leave/leave'?>">Apply Leave </a>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

    </div>
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
