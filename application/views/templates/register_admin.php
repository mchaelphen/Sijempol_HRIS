<!-- Main Wrapper -->
<div class="main-wrapper">
  <div class="account-content">
    <div class="container">
      <!-- Account Logo -->
      <div class="account-logo">
        <a href="index.html"><img src="<?php echo base_url()?>assets/img/logo2.png" alt="Dreamguy's Technologies" /></a>
      </div>
      <!-- /Account Logo -->

      <div class="account-box">
        <div class="account-wrapper">
          <h3 class="account-title">Register New Admin </h3>
          <p class="account-subtitle"> </p>

          <!-- alert error -->
          <?php if (!empty($alert)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error! </strong> <p> <?php echo $alert ?> </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span>
              </button>
            </div>
          <?php } ?>
          <!-- alert error -->

          <!-- Account Form -->
          <form class="form" action="<?php echo base_url()?>admin/register_new" method="post">
            <div class="form-group">
              <label>User Role </label>
              <select class="select" name="user_role">
                <option value="3" />HR Staff
                <option value="2" />HR Supervisor
                <option value="1" />HR Manager
              </select>
              <span class="text-danger"><br> *Only registered employee can be added as admin </span>
            </div>
            <div class="form-group">
              <label>Username </label>
              <input class="form-control" type="text" name="username" placeholder="Employee's NIP" />
            </div>
            <div class="form-group">
              <label>Password </label>
              <input class="form-control" type="password" name="password" placeholder="Employee's Password"/>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-primary account-btn" type="submit">Register </button>
            </div>
          </form>
          <!-- /Account Form -->

        </div>
      </div>

    </div>
  </div>
</div>
<!-- /Main Wrapper -->
